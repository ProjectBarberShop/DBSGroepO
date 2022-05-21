<?php

namespace App\Models;

use App\Models\LearnToSingCat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LearnToSing extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LearnToSingCat::class);
    }
}
