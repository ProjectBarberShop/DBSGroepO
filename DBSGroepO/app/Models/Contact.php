<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $table = 'contacts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'firstname',
        'preposition',
        'lastname',
        'email',
        'phonenumber',
        'is_published'
    ];

}
