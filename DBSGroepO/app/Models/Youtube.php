<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    use HasFactory;
    protected $table= 'Youtube';
    protected $primaryKey = 'id';

    protected $fillable = [
        'youtube_video_key',
    ];

    public function WebPageYoutubeLink() {
        return $this->belongsToMany(Webpages::class, 'Youtube_webpage');
    }
}
