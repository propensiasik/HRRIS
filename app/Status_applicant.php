<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_applicant extends Model {
	
		protected $table = 'status_applicant';

	public function applicant(){
		return $this->belongsTo('App\applicant');
	}	

	public function status(){
		return $this->belongsTo('App\status');
	}	

	public function sla(){
		return $this->belongsTo('App\sla');
	}

	public function job_vacant(){
		return $this->belongsTo('App\job_vacant');
	}		
}
