<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnToSingCat extends Model
{
    use HasFactory;
    protected $table = 'learntosing_categorie';
    protected $primaryKey = 'id';

    protected $fillable =  [
        'title'
    ];
}
