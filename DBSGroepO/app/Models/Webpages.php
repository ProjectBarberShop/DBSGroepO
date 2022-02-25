<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webpages extends Model
{
    use HasFactory;
    protected $table= 'webpages';
    protected $primaryKey = 'id';
}
