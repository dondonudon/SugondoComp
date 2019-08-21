<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class webGeneralInfo extends Model
{
    protected $table = 'web_general_info';
    protected $fillable = ['section','area','type','data'];
}
