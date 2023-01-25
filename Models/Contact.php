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
class Contact extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'contacts';

    protected $primaryKey = 'id';
    
    public $fillable = [
        'contact_number'
    ];

    /**
     * @param Builder $query
     * @param $value
     * @return Builder
     */
    public function campaignHistory(){

       return $this->hasMany(CampaignHistory::class);
    }
    
    
}
