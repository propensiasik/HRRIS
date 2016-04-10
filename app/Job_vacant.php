<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_vacant extends Model {
	
		public $timestamps = false;
		protected $table ='job_vacant';

		protected $fillable = ['capacity', 'Requirement'];

	public function apply(){
		return $this->hasMany('App\apply', 'id_job_vacant');
	}	
	
	public function involved_job_vacant(){
		return $this->hasMany('App\involved_job_vacant', 'id_job_vacant');
	}	

	public function report_form(){
		return $this->hasOne('App\report_form', 'id_job_vacant');
	}	

	public function available_schedule(){
		return $this->hasMany('App\available_schedule', 'id_job_vacant');
	}	

	public function status_applicant(){
		return $this->hasMany('App\status_applicant', 'id_job_vacant');
	}	

	public function divisi(){
		return $this->belongsTo('App\divisi', 'id_divisi');
	}	
}
