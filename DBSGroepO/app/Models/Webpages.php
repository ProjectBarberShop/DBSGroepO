<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webpages extends Model
{
    use HasFactory;
    protected $table= 'webpage';
    protected $primaryKey = 'id';

    protected $fillable = [
        'main_text',
        'template_id',
        'slug'
    ];

    public function ColomContext() {
        return $this->belongsToMany(colom_context::class, 'colloms_webpage');
    }

    public function cardImage() {
        return $this->belongsToMany(card_images::class, 'card_webpage');
    }

    public function Youtube() {
        return $this->belongsToMany(Youtube::class, 'youtube_webpage');
    }

    public function newsletter() {
        return $this->belongsToMany(Newsletter::class, 'newsletter_webpage');
    }
}
