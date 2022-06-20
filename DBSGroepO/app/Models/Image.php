<?php

namespace App\Models;

use App\Models\LearnToSing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class image extends Model
{
    use HasFactory;
    protected $table = 'image';
    protected $primaryKey = 'id';

    public $fillable = [
        'title',
        'photo',
        'discription',
        'useInSlider'
    ];

    public function newsletters() {
        return $this->belongsToMany(Newsletter::class);
    }
    public function Webpages() {
        return $this->belongsToMany(Webpages::class);
    }

    public function courses() {
        return $this->belongsToMany(LearnToSing::class);
    }
    
}
