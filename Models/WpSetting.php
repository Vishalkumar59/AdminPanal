<?php

namespace  Modules\Qrcode\Models;

use Illuminate\Database\Eloquent\Model;

class WpSetting extends Model
{
    //

    protected $table = 'wp_settings';

    protected $fillable = ['sender_number','wa_token','status'];
}
