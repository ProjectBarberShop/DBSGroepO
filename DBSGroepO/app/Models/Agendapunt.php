<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendapunt extends Model
{
    use HasFactory;
    protected $table = 'agenda';
    protected $primaryKey = 'id';

    protected $fillable =  [
        'title',
        'description',
        'start',
        'end',
        'location',
        'locationURL',
        'color',
        'isArchived'
    ];

    public function Category() {
        return $this->belongsToMany(Category::class , 'agendapunt_category', 'agendapunt_id', 'category_id');
    }

    public function tickets() {
        return $this->belongsToMany(Ticket::class);
    }
}
