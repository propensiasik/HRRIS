<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model {
	
		protected $table = 'applicant';

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
