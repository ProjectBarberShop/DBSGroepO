<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropdownItem extends Model
{
    use HasFactory;

    protected $table = 'dropdownitems';
    protected $fillable = [
        'name',
        'link',
        'navbar_item_id',
    ];

    public function navbarItem(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(NavbarItem::class);
    }
}
