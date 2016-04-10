<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model {
	
		protected $table = 'users';

	public function involved_interview(){
		return $this->hasMany('App\involved_interview');
	}	
	
	public function involved_job_vacant(){
		return $this->hasMany('App\involved_job_vacant');
	}	

	public function available_schedule(){
		return $this->hasMany('App\available_schedule');
	}	

	public function report(){
		return $this->hasMany('App\report');
	}	

	public function divisi(){
		return $this->belongsTo('App\divisi');
	}	
}
