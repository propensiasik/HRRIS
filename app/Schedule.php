<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $timestamps = false;
    
	public $table = "interview, involved_interview, users, applicant";
    //protected $table ='interview, involved_interview, users';

    //protected $fillable = ['id_applicant', 'nama_applicant', 'email_applicant', 'alamat', 'gender' , 'no_hp', 
    //						'universitas', 'jurusan', 'ipk', 'thn_lulus', 'CV'];
}
