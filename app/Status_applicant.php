<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_applicant extends Model {
	
	public $timestamps = false;
    protected $table ='status_applicant';

    protected $fillable = ['id_sla', 'id_status', 'id_applicant', 'id_job_vacant' ];
}
