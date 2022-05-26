<?php

namespace App\Models;

use App\Models\Image;
use App\Models\LearnToSingCat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LearnToSing extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category'];

    public function image() {
        return $this->belongsTo(Image::class, 'image_id');
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LearnToSingCat::class);
    }
}
