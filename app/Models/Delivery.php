<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'vendor_id',
        'warehouse_id',
        'external_reference',
        'invoice_number',
        'delivery_date',
        'notes',
    ];
    
    public function vendor(): BelongsTo {
        return $this->belongsTo(Vendor::class);
    }

    public function warehouse(): BelongsTo {
        return $this->belongsTo(Warehouse::class);
    }

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function items() {
        return $this->hasMany(DeliveryItem::class);
    }

    public function products() {
        return Product
                    ::whereVendorId($this->vendor_id)
                    // ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                    ->get()->toJSON();
    }
    public function units() {
        return UnitOfMeasure
                    // ::join('dimensions', 'unit_of_measures.dimension_id', '=', 'dimensions.id')
                    ::get()->toJSON();
    }
}
