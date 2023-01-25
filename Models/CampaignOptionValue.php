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
class CampaignOptionValue extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'campaign_option_values';

    public $fillable = [
        'value_id','option_id', 'name'
    ];

    public $timestamps = false;

    /**
     * @param Builder $query
     * @param $value
     * @return Builder
     */

    
    
}
