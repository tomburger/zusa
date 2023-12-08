<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('vendor_id');
            $table->integer('warehouse_id');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Permission::create(['name' => 'delivery.read']);
        Permission::create(['name' => 'delivery.write']);

        Role::create(['name' => 'contributor'])
            ->givePermissionTo(['user.read', 'product.read', 'vendor.read', 'warehouse.read', 'dimension.read', 'delivery.read', 'delivery.write']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
