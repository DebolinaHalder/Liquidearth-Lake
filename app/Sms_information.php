<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms_information extends Model
{
     protected $fillable=['msg_service_id','msg_id','msg_from','body','msg_status','error_code','from_city','from_state','from_zip','is_format_valid','date','time'];
     protected $table='sms_informations';
}
