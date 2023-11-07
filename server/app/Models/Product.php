<?php

namespace App\Models;

use App\Models\DropdownModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_category_id',
        'vendor_id',
        'dimension_id',
    ];

    public function productCategory() {
        return $this->belongsTo(ProductCategory::class);
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function dimension() {
        return $this->belongsTo(Dimension::class);
    }
}