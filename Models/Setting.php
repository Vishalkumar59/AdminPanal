<?php

namespace Modules\Qrcode\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 *
 * @mixin Builder
 * @package App
 */
class Setting extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var bool
     */
    public $timestamps = false;
}
