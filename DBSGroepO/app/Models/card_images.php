<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class card_images extends Model
{
    use HasFactory;
    protected $table = 'card_image';
    protected $primaryKey = 'id';

    protected $fillable =  [
        'title_card',
        'photo',
    ];
    public function Webpages() {
        return $this->belongsToMany(Webpages::class, 'card_webpage');
    }
}
