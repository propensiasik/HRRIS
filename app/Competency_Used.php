<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competency_Used extends Model
{
    protected $table = 'competency_used';

	public function competency(){
		return $this->belongsTo('App\Competency');
	}
	public function report_form(){
		return $this->belongTo('App\Report_Form');
	}
}
