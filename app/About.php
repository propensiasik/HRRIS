<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
	public $timestamps = false;
    protected $table ='ngetes';

    protected $fillable = ['capacity', 'Requirement'];

}
