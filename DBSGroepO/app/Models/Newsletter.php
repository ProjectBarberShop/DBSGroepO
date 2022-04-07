<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $table = 'newsletter';
    protected $primaryKey = 'id';

    protected $fillable = [
        'imagepath',
        'title',
        'message',
        'is_published'
    ];

    public function newsletterpost() {
        return $this->belongsToMany(Webpages::class, 'newsletter_webpage');
    }
}
