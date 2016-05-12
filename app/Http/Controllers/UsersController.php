<?php

namespace App\Http\Controllers;

use Request;

use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;

use Validator;

use App\Users;

use App\Divisi;

use App\Company;

use DB;

class UsersController extends Controller
{
    public function getListofUser(){
    	
    	$users = Users::where('is_active','=',1)->orderBy('created_at', 'desc');
    	$users = $users->paginate(10);
    	return view('listOfUser')->with('users',$users);
    }

    public function createUser(){
    	// $divisi = collect(['' => 'Please Select'] + Divisi::lists('DivisiCompany', 'id_divisi')->toArray());
    	$divisi = DB::table('divisi as d')->join('company as c', 'c.id_company', '=', 'd.id_company')->selectRaw('CONCAT(d.nama_divisi, " - ", c.nama_company) as concatname, d.id_divisi')->lists('concatname', 'd.id_divisi');
    	$divisi = array('' => 'Please Select') + $divisi;

    	//$company = Company::lists('nama_company', 'id_company');
		//$divisi = Divisi::where('id_company','=',$company)->get();
    	//return $subcategories;

    	return view('createUser')->with('divisi',$divisi);

    	//return view('createUser',['company' => $company, 'divisi' => $divisi]);
    }

    public function storeUser()
	{
   		$user=Request::all();

   		$rules = array(
			'email_users' => 'required|unique:users|email',
			'nama_users' => 'required|min:3',
			'posisi' => 'required',
			'id_divisi' => 'required',
			'role' => 'required'
		);
 
		$validator = Validator::make($user, $rules);
 
		if($validator->fails()) {
			return Redirect::to('/Users/Create')->withErrors($validator)->withInput();
		}

   		Users::create($user);
   		return Redirect::to('Users');
	}

	public function editUser($email_users)
   	{
      	$user = Users::where('email_users', '=', $email_users)->first();
      	//$divisi = collect(['' => 'Please Select'] + Divisi::lists('nama_divisi', 'id_divisi')->toArray());
      	$divisi = DB::table('divisi as d')->join('company as c', 'c.id_company', '=', 'd.id_company')->selectRaw('CONCAT(d.nama_divisi, " - ", c.nama_company) as concatname, d.id_divisi')->lists('concatname', 'd.id_divisi');
    	$divisi = array('' => 'Please Select') + $divisi;
   		return view('updateUser',['user' => $user, 'divisi' => $divisi]);
   	}
 
   	public function updateUser($email_users)
   	{
      	$userUpdate=Request::except('_method', '_token');
      	$rules = array(
			'email_users' => 'required|email|unique:users,email_users,'.$email_users.',email_users',
			'nama_users' => 'required|min:3',
			'posisi' => 'required',
			'id_divisi' => 'required',
			'role' => 'required'
		);
 
		$validator = Validator::make($userUpdate, $rules);
 
		if($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

   		$user=Users::where('email_users', '=', $email_users);
   		$user->update($userUpdate);
   		return Redirect::to('Users');
   	}

    public function deleteUser($email_users)
    {
    	Users::where('email_users', '=', $email_users)->update(['is_active' => 0]);
   		return Redirect::to('Users');
    }

}
