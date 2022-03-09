<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Form extends Model
{
    use HasFactory;
    public $fillable = [
        'firstname', 
        'preprosition',
        'lastname',
        'email', 
        'phonenumber', 
        'title', 
        'message'
    ];
}