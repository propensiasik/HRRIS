<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model {
		public $timestamps = false;
		protected $table = 'applicant';
		
		protected $fillable = ['id_applicant', 'nama_applicant', 'email_applicant', 'alamat', 'gender' , 'no_hp', 
    						'universitas', 'jurusan', 'ipk', 'thn_lulus', 'CV'];

	public function status_applicant(){
		return $this->hasMany('App\status_applicant');
	}	
	
	public function report(){
		return $this->hasMany('App\report');
	}	

	public function interview(){
		return $this->hasMany('App\interview');
	}	

	public function work_experience(){
		return $this->hasMany('App\work_experience');
	}	

	public function apply(){
		return $this->hasMany('App\apply');
	}	
}
