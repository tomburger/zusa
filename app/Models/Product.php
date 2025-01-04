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
        'external_reference',
        'product_category_id',
        'vendor_id',
    ];

    public function parentCategory() {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function categoryDropdown(): DropdownModel {
        $categories = ProductCategory::get()->pluck('name', 'id');
        $categories->prepend('', '');
        return new DropdownModel($this->product_category_id, $categories);
    }

    public function vendorDropdown(): DropdownModel {
        $vendors = Vendor::get()->pluck('name', 'id');
        $vendors->prepend('', '');
        return new DropdownModel($this->vendor_id, $vendors);
    }

    public function latestPrice() {
        return $this->hasMany(DeliveryItem::class, 'product_id')
                    ->join('deliveries', 'delivery_items.delivery_id', '=', 'deliveries.id')
                    ->orderBy('delivery_date', 'desc')
                    ->first();
    }
}