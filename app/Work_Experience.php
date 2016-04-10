<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $table = 'work_experience';

	public function applicant(){
		return $this->belongsTo('App\Applicant');
	}
}
