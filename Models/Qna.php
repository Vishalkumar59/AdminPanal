<?php

namespace Modules\Qrcode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qna extends Model
{
    use HasFactory;

    protected $table = 'qna';
    
    protected $fillable = [
        'question',
        'whatsapp_code',
        'answer',
        'status',
    ];
}
