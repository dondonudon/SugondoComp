<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class msMarketer extends Model
{
    protected $table = 'ms_marketer';
    protected $fillable = ['fullname','photo'];
}
