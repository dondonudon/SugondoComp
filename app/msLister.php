<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class msLister extends Model
{
    protected $table = 'ms_lister';
    protected $fillable = ['fullname','photo'];
}
