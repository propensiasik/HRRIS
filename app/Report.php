<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';
    public function users(){
		return $this->belongsTo('App\Users');
	}
	public function report_form(){
		return $this->belongsTo('App\Report_Form');
	}
	public function applicant(){
		return $this->belongsTo('App\Applicant');
	}
}
