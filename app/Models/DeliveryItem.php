<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryItem extends Model {

    use HasFactory;

    protected $fillable = [
        'delivery_id',
        'product_id',
        'quantity',
        'unit_id',
        'price',
    ];

    public function delivery() {
        return $this->belongsTo(Delivery::class);
    }
}