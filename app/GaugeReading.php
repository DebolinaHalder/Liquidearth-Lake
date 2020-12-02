<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaugeReading extends Model
{
    protected $table="gauge_readings";
    protected $fillable = ['gauge_inc_id','height','precipi','date','time','is_bubble_level_okay','notes','entry_type','account_id','phone_no'];
    public $primaryKey ='id';
    public $timestamps= true;
}
