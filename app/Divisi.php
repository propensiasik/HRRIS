<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model {
	
		protected $table = 'divisi';

	public function job_vacant(){
		return $this->hasMany('App\job_vacant');
	}	

	public function users(){
		return $this->hasMany('App\users');
	}	

	public function company(){
		return $this->belongsTo('App\company');
	}	
}
