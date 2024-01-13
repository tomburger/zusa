<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Delivery;
use App\Models\Product;
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
        $this->model = new Delivery([
            'vendor_id' => 1,
            'warehouse_id' => 1,
            'external_reference' => '123',
            'invoice_number' => '123',
            'delivery_date' => '2021-01-01',
            'notes' => '123',
            'created_by' => 1,
        ]);
        $this->model->save();

        (new Product([
            'vendor_id' => 1,
            'product_category_id' => 1,
            'name' => 'Product 1',
            'external_reference' => 'P-001',
        ]))->save();
        (new Product([
            'vendor_id' => 1,
            'product_category_id' => 1,
            'name' => 'Product 2',
            'external_reference' => 'P-002',
        ]))->save();
    }

    public function test_delivery_items_empty_array() {
        $this->service->update($this->model, '[]');
        $this->assertDatabaseCount('delivery_items', 0);
        $this->assertDatabaseCount('products', 2);
    }

    public function test_delivery_items_with_one_known_product() {
        $this->service->update($this->model, '[{"product_id":1,"quantity":1,"unit_id":1,"price":1}]');
        $this->assertDatabaseCount('delivery_items', 1);
        $this->assertDatabaseCount('products', 2);
    }

    public function test_delivery_items_with_one_unknown_product() {
        $this->service->update($this->model, '[{"product_name":"new product","external_reference":"P-ABC","quantity":1,"unit_id":1,"price":1}]');
        $this->assertDatabaseCount('delivery_items', 1);
        $this->assertDatabaseCount('products', 3);
    }
}