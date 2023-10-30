<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dimension extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function units(): HasMany {
        return $this->hasMany(UnitOfMeasure::class);
    }

    public function getUnits() {
        return $this->units->map(fn ($uom) => $uom->name)->join(', ');
    }
}
