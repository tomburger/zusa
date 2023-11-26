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
        Permission::create(['name' => 'user.read']);
        Permission::create(['name' => 'user.write']);

        Permission::create(['name' => 'dimension.read']);
        Permission::create(['name' => 'dimension.write']);
        
        Permission::create(['name' => 'vendor.read']);
        Permission::create(['name' => 'vendor.write']);
        
        Permission::create(['name' => 'warehouse.read']);
        Permission::create(['name' => 'warehouse.write']);
        
        Permission::create(['name' => 'product.read']);
        Permission::create(['name' => 'product.write']);

        Role::create(['name' => 'admin'])
            ->givePermissionTo(['user.read', 'user.write', 'dimension.read', 'dimension.write']);
        Role::create(['name' => 'configurator'])
            ->givePermissionTo(['vendor.read', 'vendor.write', 'warehouse.read', 'warehouse.write', 'product.read', 'product.write']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
