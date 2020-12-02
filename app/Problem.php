<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected  $fillable=['gauge_id','date','time','problem'];
}
