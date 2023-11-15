<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $_COOKIE = [
        'name',
        'vendor_id',
        'phone',
        'email',
        'notes',
    ];

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function vendorDropdown(): DropdownModel {
        $vendors = Vendor::get()->pluck('name', 'id');
        $vendors->prepend('', '');
        return new DropdownModel($this->vendor_id, $vendors);
    }
}
