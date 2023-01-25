<?php

namespace  Modules\Qrcode\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 *
 * @mixin Builder
 * @package App
 */
class Campaign extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'campaign';

    public $fillable = [
        'name', 'trigger_message', 'whatsup_url', 'shorturl_id','qr_code'
    ];

    /**
     * @param Builder $query
     * @param $value
     * @return Builder
     */

     public function showShortURL()
    {
        return $this->belongsTo(Link::class,'shorturl_id','id');
        
    } 
    
}
