<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'imageTag';
    protected $primaryKey = 'id';

    protected $fillable = [
        'image_id',
        'title'
    ];
}
