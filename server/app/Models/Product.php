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

class ProductUi {
    public int $id;
    public string $name;
    public DropdownModel $product_category_id;
    public DropdownModel $vendor_id;
    public DropdownModel $dimension_id;

    public function __construct(Product $product = null)
    {
        if ($product) {
            $this->id = $product->id;
            $this->name = $product->name;
            $this->product_category_id = new DropdownModel($product->product_category_id, ProductCategory::get());
            $this->vendor_id = new DropdownModel($product->vendor_id, Vendor::get());
            $this->dimension_id = new DropdownModel($product->dimension_id, Dimension::get());
        }
        else {
            $this->product_category_id = new DropdownModel(null, ProductCategory::get());
            $this->vendor_id = new DropdownModel(null, Vendor::get());
            $this->dimension_id = new DropdownModel(null, Dimension::get());
        }
    }
}
