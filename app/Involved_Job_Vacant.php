<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Involved_Job_Vacant extends Model
{
    protected $table = 'involved_job_vacant';
    public function job_vacant(){
		return $this->belongsTo('App\Job_Vacant');
	}
	public function users(){
		return $this->belongsTo('App\Users');
	}
}
