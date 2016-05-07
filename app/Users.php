<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    protected $fillable=[
        'nama_users',
        'email_users',
        'posisi',
        'id_divisi',
        'password',
        'role'
    ];

    public function divisi()
    {
        return $this->belongsTo('App\Divisi', 'id_divisi', 'id_divisi');
    }
}
