<?php

namespace App\Services;

use App\Models\Delivery;
use App\Models\Product;

class DeliveryItemsService {
    public function update(Delivery $model, string $input) {
        $items = json_decode($input);

        foreach ($items as $item) {
            if (isset($item->product_id)) {
                $model->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_id' => $item->unit_id,
                    'price' => $item->price,
                    'delivery_id' => $model->id,
                ]);
            }
            else {
                $product = new Product([
                    'vendor_id' => $model->vendor_id,
                    'name' => $item->product_name,
                    'external_reference' => $item->external_reference,
                ]);
                $product->save();

                $model->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'unit_id' => $item->unit_id,
                    'price' => $item->price,
                    'delivery_id' => $model->id,
                ]);
            }
        }
    }   
}