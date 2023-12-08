<?php

namespace App\Http\Controllers;

use App\Models\DropdownModel;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Vendor;
use App\Models\Warehouse;

class DeliveryIndexModel {
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

class DeliveryController extends Controller
{
    public function index() {
        $model = new DeliveryIndexModel();
        return view('deliveries.index', compact('model'));
    }

    public function create(Request $request) {
        $this->authorize('deliveries.write');
        $vendor = $request->input('vendor');
        $warehouse = $request->input('warehouse');
        if (!$vendor || !$warehouse) {
            return redirect()->route('deliveries.index')->with('error', 'Please select a vendor and a warehouse.');
        }
        $model = new Delivery();
        $model->vendor_id = $vendor;
        $model->warehouse_id = $warehouse;
        return view('deliveries.create', compact('model'));
    }

    public function store(Request $request) {
        $this->authorize('deliveries.write');
        $request->validate([
            'vendor' => 'required|integer',
            'warehouse' => 'required|integer',
        ]);
        $model = new Delivery();
        $model->vendor_id = $request->input('vendor');
        $model->warehouse_id = $request->input('warehouse');
        $model->created_by = $request->user()->id;
        $model->notes = $request->input('notes');
        $model->save();
        return redirect()->route('deliveries.index')->with('success', 'Delivery created.');
    }
}
