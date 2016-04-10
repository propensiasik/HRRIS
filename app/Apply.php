<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $table = 'apply';

	public function job_vacant(){
		return $this->belongsTo('App\Job_Vacant');
	}
	public function report_form(){
		return $this->belongTo('App\Report_Form');
	}
}
