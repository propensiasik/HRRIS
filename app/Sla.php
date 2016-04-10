<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sla extends Model {
	
		protected $table = 'sla';

	public function status_applicant(){
		return $this->hasMany('App\status_applicant');
	}	
}
