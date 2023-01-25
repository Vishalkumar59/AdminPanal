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
class CampaignStats extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'campaign_stat';


    public $fillable = [
        'campaign_id','no_of_user','msg_send', 'msg_received', 'total_msg'
    ];

    /**
     * @param Builder $query
     * @param $value
     * @return Builder
     */
   
    
}
