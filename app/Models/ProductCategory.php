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

    public function parentCategory(): BelongsTo {
        return $this->belongsTo(ProductCategory::class, 'parent');
    }   

    public function categories(): HasMany {
        return $this->hasMany(ProductCategory::class, 'parent');
    }

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }

    public function parentDropdown(): DropdownModel {
        $categories = ProductCategory::get()->pluck('name', 'id');
        $categories->prepend('', '');
        return new DropdownModel($this->parent, $categories);
    }
}