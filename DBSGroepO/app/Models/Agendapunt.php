<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendapunt extends Model
{
    use HasFactory;
    protected $table = 'Agenda';
    protected $primaryKey = 'Id';

    protected $fillable =  [
        'title',
        'description',
        'start',
        'end'
    ];
}
