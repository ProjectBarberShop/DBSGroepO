<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colomn_context extends Model
{
    use HasFactory;
    protected $table = 'collomn_context';
    protected $primaryKey = 'id';

    protected $fillable =  [
        'colom_title_text',
        'colomn_text',
    ];
    public function Webpages() {
        return $this->belongsToMany(Webpages::class, 'colloms_webpage');
    }
}
