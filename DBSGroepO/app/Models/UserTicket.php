<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTicket extends Model
{
    use HasFactory;

    protected $table = 'user_ticket';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'ticket_id',
        'address',
        'postalcode',
        'place',
        'phonenumber',
        'email',
        'amount_of_tickets',
    ];

    public function ticket() {
        return $this->hasOne(Agendapunt::class);
    }
}
