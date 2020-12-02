<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gauge extends Model
{
    protected $fillable = ['gauge_id','name','city','latitude','longitude','timezone','unit','min_height','max_height','installation_date','initial_reading','notes'];
    protected $table='gauges';
    public $primaryKey ='id';
    public $timestamps= true;

}
