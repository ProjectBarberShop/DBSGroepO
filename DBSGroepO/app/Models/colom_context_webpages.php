<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colom_context_webpages extends Model
{
    use HasFactory;
    protected $table = 'colom_context_webpages';

    protected $fillable =  [
        'webpages_id',
        'colom_context_id',
    ];
}
