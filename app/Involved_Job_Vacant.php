<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Involved_Job_Vacant extends Model
{
    //
    protected $table = 'involved_job_vacant';
    public $timestamps = false;
    protected $fillable = ['id_job_vacant', 'email_users' ];
}
