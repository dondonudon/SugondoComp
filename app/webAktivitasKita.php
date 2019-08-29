<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class webAktivitasKita extends Model
{
    protected $table = 'web_aktivitas_kita';
    protected $fillable = ['judul','image','content','username','status'];
}
