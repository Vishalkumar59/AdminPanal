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
class CampaignOption extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'campaign_options';

    protected $primaryKey = 'option_id';

    public $fillable = [
        'option_id','campaign_id','option_name', 'option_message', 'wa_template_code', 'parent_id','value_id','sort_order','status','type'
    ];

    /**
     * @param Builder $query
     * @param $value
     * @return Builder
     */
    public function campaignOptionValue()
    {
        return $this->belongsTo(CampaignOptionValue::class,'option_id','option_id');
        
    } 
    
}
