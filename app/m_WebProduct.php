<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_WebProduct extends Model
{
    protected $table = 'web_products';
    protected $fillable = ['url','judul','gambar','content'];
}
