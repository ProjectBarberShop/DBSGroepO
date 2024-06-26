<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavbarItem extends Model
{
    use HasFactory;

    protected $table = 'navbaritems';
    protected $fillable = [
        'name',
        'link',
        'number',
    ];

    public function dropdownItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DropdownItem::class);
    }
}
