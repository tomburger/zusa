<?php

namespace App\Services;

use App\Models\Delivery;
use App\Models\DeliveryItem;
use App\Models\Product;
use App\Models\UnitOfMeasure;

class DeliveryItemsService {

    public function get(int $deliveryId) {
        $items = DeliveryItem::whereDeliveryId($deliveryId)->get();

        $result = [];

        foreach ($items as $item) {
            $result[] = [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'external_reference' => $item->product->external_reference,
                'quantity' => $item->quantity,
                'unit' => $item->unit->name,
                'price' => $item->price,
                'deleted' => false,
            ];
        }

        return json_encode($result);
    }

    public function update(Delivery $model, string $input) {
        $items = json_decode($input);

        foreach ($items as $item) {
            $unit = $this->findOrCreateUnit($item->unit);
            if (isset($item->product_id) && $item->product_id > 0) {
                $existing = DeliveryItem::whereDeliveryId($model->id)->whereProductId($item->product_id)->first();
                if ($existing) {
                    if ($item->deleted) {
                        $existing->delete();
                    }
                    else {
                        $existing->update([
                            'quantity' => $item->quantity,
                            'unit_id' => $unit,
                            'price' => $item->price,
                        ]);
                    }
                }
                else {
                    $model->items()->create([
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'unit_id' => $unit,
                        'price' => $item->price,
                        'delivery_id' => $model->id,
                    ]);
                }
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
                    'unit_id' => $unit,
                    'price' => $item->price,
                    'delivery_id' => $model->id,
                ]);
            }
        }
    }   
    private function findOrCreateUnit(string $unit) {
        $found = UnitOfMeasure::whereName($unit)->first();
        if (!$found) {
            $found = new UnitOfMeasure([
                'name' => $unit,
                'dimension_id' => 0,
            ]);
            $found->save();
        }
        return $found->id;
    }
}