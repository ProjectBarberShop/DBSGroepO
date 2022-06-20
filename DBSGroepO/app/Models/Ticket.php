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
        'email',
    ];

    public function agendaItem() {
        return $this->belongsTo(Agendapunt::class);
    }
}
