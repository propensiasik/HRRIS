<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    //
    protected $table = 'divisi';

    public function job_vacant(){
    	return $this->hasMany('\App\Job_Vacant');
    }
	
	public function users(){
    	return $this->hasMany('\App\Users', 'id_divisi', 'id_divisi');
    }

    public function company()
    {
        return $this->belongsTo('App\Company', 'id_company', 'id_company');
    }
}
