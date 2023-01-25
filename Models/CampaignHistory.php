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
class CampaignHistory extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'campaign_history';


    public $fillable = [
        'campaign_id','contact_id', 'msg_type', 'message', 'option_id'
    ];

    /**
     * @param Builder $query
     * @param $value
     * @return Builder
     */
    // public function getCreatedAtAttribute($date)
    // {
    //     return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    // }

    public function contacts(){
         return $this->belongsTo(Contact::class);
    }
    
}
