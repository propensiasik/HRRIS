<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
	protected $table = 'interview';

	public function involved_interview(){
		return $this->hasMany('App\Involved_Interview');
	}
	public function applicant(){
		return $this->belongsTo('App\Applicant');
	}
}

