<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class webRumahDijual extends Model
{
    protected $table = 'web_rumah_dijual';
    protected $fillable = ['id_lister','status','nama_rumah','lokasi','detail','harga','gambar'];
}
