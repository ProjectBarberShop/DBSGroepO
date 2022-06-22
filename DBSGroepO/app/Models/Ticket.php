<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'ticket';
    protected $primaryKey = 'id';

    protected $fillable = [
        'agenda_id',
        'amount_of_tickets',
        'price',
        'is_published',
    ];

    public function agendaItem() {
        return $this->hasOne(Agendapunt::class);
    }

    public function userTickets() {
        return $this->belongsToMany(userTicket::class);
    }
}
