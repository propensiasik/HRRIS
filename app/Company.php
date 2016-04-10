<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
	
		protected $table = 'company';

	public function divisi(){
		return $this->hasMany('App\divisi');
	}	
}
