<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Delivery;
use App\Models\DeliveryItem;
use App\Models\Product;
use App\Models\UnitOfMeasure;
use App\Services\DeliveryItemsService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryItemsTest extends TestCase
{
    use RefreshDatabase;

    private DeliveryItemsService $service;

    private Delivery $model;

    public function setUp(): void {
        parent::setUp();

        $this->service = new DeliveryItemsService();
        $this->model = Delivery::create([
            'vendor_id' => 1,
            'warehouse_id' => 1,
            'external_reference' => '123',
            'invoice_number' => '123',
            'delivery_date' => '2021-01-01',
            'notes' => '123',
            'created_by' => 1,
        ]);

        Product::create([
            'vendor_id' => 1,
            'product_category_id' => 1,
            'name' => 'Product 1',
            'external_reference' => 'P-001',
        ]);
        Product::create([
            'vendor_id' => 1,
            'product_category_id' => 1,
            'name' => 'Product 2',
            'external_reference' => 'P-002',
        ]);

        UnitOfMeasure::create([
            'name' => 'pc',
            'dimension_id' => 1,
        ]);
    }

    public function test_delivery_items_empty_array() {
        $this->service->update($this->model, '[]');
        $this->assertDatabaseCount('delivery_items', 0);
        $this->assertDatabaseCount('products', 2);
        $this->assertDatabaseCount('unit_of_measures', 1);
    }

    public function test_delivery_items_with_one_known_product() {
        $this->service->update($this->model, '[{"product_id":1,"quantity":1,"unit":"pc","price":1}]');
        $this->assertDatabaseCount('delivery_items', 1);
        $this->assertDatabaseCount('products', 2);
        $this->assertDatabaseCount('unit_of_measures', 1);
    }

    public function test_delivery_items_with_unknown_unit() {
        $this->service->update($this->model, '[{"product_id":1,"quantity":1,"unit":"kg","price":1}]');
        $this->assertDatabaseCount('delivery_items', 1);
        $this->assertDatabaseCount('products', 2);
        $this->assertDatabaseCount('unit_of_measures', 2);
    }

    public function test_delivery_items_with_one_unknown_product() {
        $this->service->update($this->model, '[{"product_id":0,"product_name":"new product","external_reference":"P-ABC","quantity":1,"unit":"pc","price":1}]');
        $this->assertDatabaseCount('delivery_items', 1);
        $this->assertDatabaseCount('products', 3);
        $this->assertDatabaseCount('unit_of_measures', 1);
    }

    public function test_delivery_items_update_quantity_on_existing_product() {
        DeliveryItem::create([
            'delivery_id' => $this->model->id,
            'product_id' => 1,
            'quantity' => 1,
            'unit_id' => 1,
            'price' => 1,
        ]);
        $this->assertEquals(1, DeliveryItem::find(1)->quantity);
        $this->service->update($this->model, '[{"product_id":1,"quantity":2,"unit":"pc","price":1,"deleted":false}]');
        $this->assertDatabaseCount('delivery_items', 1);
        $this->assertDatabaseCount('products', 2);
        $this->assertDatabaseCount('unit_of_measures', 1);
        $this->assertEquals(2, DeliveryItem::find(1)->quantity);
    }

    public function test_delivery_items_delete_entry() {
        DeliveryItem::create([
            'delivery_id' => $this->model->id,
            'product_id' => 1,
            'quantity' => 1,
            'unit_id' => 1,
            'price' => 1,
        ]);
        DeliveryItem::create([
            'delivery_id' => $this->model->id,
            'product_id' => 2,
            'quantity' => 2,
            'unit_id' => 2,
            'price' => 2,
        ]);
        $this->assertDatabaseCount('delivery_items', 2);
        $this->service->update($this->model, '[{"product_id":1,"quantity":2,"unit":"pc","price":1,"deleted":true}]');
        $this->assertDatabaseCount('delivery_items', 1);
        $this->assertDatabaseCount('products', 2);
        $this->assertDatabaseCount('unit_of_measures', 1);
    }
}