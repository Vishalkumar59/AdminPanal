<?php

namespace Modules\Qrcode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\CRM\Models\CustomerContact;
use Modules\CRM\Models\CostomerAddress;


class Qrcode extends Model
{
    use HasFactory;
    protected $primaryKey = 'customer_id';

    protected $table = 'crm_customer';

    protected $fillable = ['customer_id'];

   
    
}
