<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\DeliveryIndex;
use App\Services\DeliveryItemsService;

class DeliveryController extends Controller
{
    private DeliveryItemsService $deliveryItems;

    public function __construct(DeliveryItemsService $deliveryItems) {
        $this->deliveryItems = $deliveryItems;
    }

    public function index() {
        $model = new DeliveryIndex();
        return view('deliveries.index', compact('model'));
    }

    public function create(Request $request) {
        $this->authorize('delivery.write');
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
        $this->authorize('delivery.write');
        $request->validate([
            'vendor' => 'required|integer',
            'warehouse' => 'required|integer',
        ]);
        $model = new Delivery();
        $model->created_by = $request->user()->id;
        $model->vendor_id = $request->input('vendor');
        $model->warehouse_id = $request->input('warehouse');
        $model->external_reference = $request->input('external_reference');
        $model->invoice_number = $request->input('invoice_number');
        $model->delivery_date = $request->input('delivery_date');
        $model->notes = $request->input('notes');
        $model->save();

        $items = $request->input('delivery_items');
        if ($items) {
            $this->deliveryItems->update($model, $items);
        }

        return redirect()->route('deliveries.index')->with('success', 'Delivery created.');
    }

    public function edit(string $id) {
        $this->authorize('delivery.write');
        $model = Delivery::findOrFail($id);
        return view('deliveries.edit', compact('model'));
    }

    public function update(Request $request, string $id) {
        $this->authorize('delivery.write');
        $model = Delivery::findOrFail($id);
        $model->updated_by = $request->user()->id;
        $model->external_reference = $request->input('external_reference');
        $model->invoice_number = $request->input('invoice_number');
        $model->delivery_date = $request->input('delivery_date');
        $model->notes = $request->input('notes');
        $model->save();

        $items = $request->input('delivery_items');
        if ($items) {
            $this->deliveryItems->update($model, $items);
        }

        return redirect()->route('deliveries.index')->with('success', 'Delivery updated.');
    }
}
