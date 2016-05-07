<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'company';
	
	public function divisi(){
    	return $this->hasMany('\App\Divisi', 'id_company', 'id_company');
    }
}
