<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colloms_webpage extends Model
{
    use HasFactory;
    protected $table = 'colloms_webpage';

    protected $fillable =  [
        'webpage_id',
        'collomn_context_id',
    ];
}
