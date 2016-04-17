<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    //
	protected $table = 'applicant';

	public function interview(){
		return $this->hasMany('\App\interview');
	}	
	public $timestamps = false;
}
