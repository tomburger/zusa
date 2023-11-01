<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent',
    ];

    public function parent(): BelongsTo {
        return $this->belongsTo(ProductCategory::class, 'parent');
    }   

    public function categories(): HasMany {
        return $this->hasMany(ProductCategory::class, 'parent');
    }

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }
}

class ProductCategoryUi {
    public int $id;
    public string $name;
    public DropDownModel $parent;
    public Collection $categories;
    public Collection $products;

    public function __construct(ProductCategory $productCategory = null)
    {
        if ($productCategory) {
            $this->id = $productCategory->id;
            $this->name = $productCategory->name;
            $this->categories = $productCategory->categories()->get();
            $this->products = $productCategory->products()->get();
            //$this->parent = new DropdownModel($productCategory->parent, ProductCategory::get());
        }
        else {
            //$this->parent = new DropdownModel(null, ProductCategory::get());
        }
    }
}
