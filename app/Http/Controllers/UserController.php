<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
  public function process(Request $request)
  {	
    session_start();	
    $user= DB::table('users')->where([['email_users','=',$request->email],['password','=',$request->password]])->first();
    $nama= DB::table('users')->where('email_users','=',$request->email)->value('nama_users');
    if($user===null){
      $_SESSION['loginError'] = 'Invalid login please try again';
      return view('\login');
    }
    else
    {
      $tempUser= \App\Users::where('email_users','=',$request->email)->first();
      $tempDivisi= \App\Divisi::where('id_divisi','=',$tempUser->id_divisi)->first();
      $role= $tempUser->role;
      $_SESSION["email"] = $user->email_users;
      $_SESSION["role"] = $role;
      $_SESSION["username"] = $nama;
     // dd($role);
      if($role === 'hr'){
        $_SESSION["booleanRole"] = '0';
        //return view('\hr',array('page'=>'hr'));
        return Redirect::to('/Home');
      }
      else if($tempUser->is_admin === 1){
        $_SESSION["booleanRole"] = '1';
        return Redirect::to('/Home');
      }
      else{
        $_SESSION["booleanRole"] = '2';
        return Redirect::to('/Home');
      }
    }
  }

  public function index()
  {   
   return view('\login');
 }
 public function quit(){
   session_unset();
   return Redirect::to('/');
        //return view('\login');
 }

}
