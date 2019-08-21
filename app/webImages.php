<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class webImages extends Model
{
    protected $table = 'web_image';
    protected $fillable = ['section','area','filename','info'];
}
