<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobvacant extends Model
{
    public $timestamps = false;
    protected $table ='job_vacant';

    protected $fillable = ['id_job_vacant', 'posisi_ditawarkan', 'jml_kebutuhan','requirement', 'id_divisi' ];
}
