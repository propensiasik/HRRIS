<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableSchedule extends Model
{
    protected $table = 'available_schedule';

	public function involved_interview(){
		return $this->belongsTo('App\Involved_Interview');
	}
	public function users(){
		return $this->belongsTo('App\Users');
	}
}
