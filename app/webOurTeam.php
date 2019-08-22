<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class webOurTeam extends Model
{
    protected $table = 'web_our_team';
    protected $fillable = ['nama','jabatan','foto'];
}
