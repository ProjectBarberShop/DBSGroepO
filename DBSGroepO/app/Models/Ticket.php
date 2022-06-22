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
        'email',
        'total_price',
    ];

    public function agendaItem() {
        return $this->belongsTo(Agendapunt::class);
    }
}
