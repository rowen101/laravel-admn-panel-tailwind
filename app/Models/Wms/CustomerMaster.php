<?php

namespace App\Models\Wms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMaster extends Model
{

    protected $table ='wm_customer_masters';
    protected $fillable = [
        'id',
        'cuscode',
        'cusname',
        'leadtime',
        'stockfreshness',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
