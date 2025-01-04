<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DeliveryModel {
    public int $id; 

    public int $vendor_id;
    public int $warehouse_id;

    public string $external_reference;
    public string $invoice_number;
    public string $delivery_date;

    public string $notes;

    public string $delivery_items;

    public function __construct() {
        $this->id = 0;
        
        $this->vendor_id = 0;
        $this->warehouse_id = 0;

        $this->external_reference = '';
        $this->invoice_number = '';
        $this->delivery_date = '';

        $this->notes = '';

        $this->delivery_items = '[]';
    }

    public function vendorName() {
        return Vendor::find($this->vendor_id)->name;
    }

    public function warehouseName() {
        return Warehouse::find($this->warehouse_id)->name;
    }

    public function products() {
        return Product
                    ::whereVendorId($this->vendor_id)
                    // ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                    ->select('products.id', 'products.name', 'products.external_reference', DB::raw('(SELECT di.price FROM delivery_items di JOIN deliveries d ON di.delivery_id = d.id WHERE di.product_id = products.id ORDER BY d.delivery_date DESC LIMIT 1) as latest_price'))
                    ->get()->toJSON();
    }

    public function units() {
        return UnitOfMeasure
                    // ::join('dimensions', 'unit_of_measures.dimension_id', '=', 'dimensions.id')
                    ::get()->toJSON();
    }
}