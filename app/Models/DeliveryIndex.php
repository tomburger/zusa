<?php 

namespace App\Models;

use App\Models\DropdownModel;
use App\Models\Delivery;
use App\Models\Vendor;
use App\Models\Warehouse;

class DeliveryIndex {
    public function vendors(): DropdownModel {
        $vendors = Vendor::get()->pluck('name', 'id');
        $vendors->prepend(__('=== select vendor ==='), '');
        return new DropdownModel(null, $vendors);
    }

    public function warehouses(): DropdownModel {
        $warehouses = Warehouse::get()->pluck('name', 'id');
        $warehouses->prepend(__('=== select warehouse ==='), '');
        return new DropdownModel(null, $warehouses);
    }

    public function deliveries() {
        return Delivery::latest()->take(5)->with(['vendor', 'warehouse', 'createdBy', 'updatedBy'])->get();
    }
}
