<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model {
	
		protected $table = 'competency';

	public function competency_used(){
		return $this->hasMany('App\competency_used');
	}	
}
