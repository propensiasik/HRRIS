<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report_Form extends Model
{
    protected $table = 'Report_Form';
    public $timestamps = false;

	public function competency_used(){
		return $this->hasMany('App\Competency_Used');
	}
	public function report(){
		return $this->hasMany('App\Report');
	}
	public function Job_Vacant(){
		return $this->belongsTo('App\Job_Vacant');
	}
}
