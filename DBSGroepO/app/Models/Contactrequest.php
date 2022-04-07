<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Contactrequest extends Model
{
    use HasFactory;
    protected $table= 'contact-requests';

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
