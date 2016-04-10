<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {
	
	
		protected $table = 'status';

	public function status_applicant(){
		return $this->hasMany('App\status_applicant');
	}	
}
