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
}
