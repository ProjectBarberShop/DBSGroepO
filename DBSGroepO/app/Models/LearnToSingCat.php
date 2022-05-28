<?php

namespace App\Models;

use App\Models\LearnToSing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LearnToSingCat extends Model
{
    use HasFactory;
    protected $table = 'learntosing_categorie';
    protected $primaryKey = 'id';

    protected $fillable =  [
        'title'
    ];

    public function courses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LearnToSing::class);
    }
}
