<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'restaurant_name',
        'invoice_no',
        'date',
        'name',
        'mobile_nu',
        'items',
        'price',
        'qty',
        'total',
        'note',
        'subtotal',
        'gst',
        'discount',
        'gTotal'
    ];
}
