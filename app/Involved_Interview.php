<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvolvedInterview extends Model
{
    protected $table = 'involved_interview';

	public function involved_interview(){
		return $this->belongsTo('App\Interview');
	}
	public function applicant(){
		return $this->belongsTo('App\Users');
	}
}
