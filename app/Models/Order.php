<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice',
        'customer_id',
        'sub_total',
        'status_paid',
        'status_shipment'
    ];
     protected $table = 'orders';
}
