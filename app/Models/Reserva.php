<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bisemana;
use App\Models\Cliente;
use App\Models\Outdoor;



class Reserva extends Model
{

    public $timestamps = false;
    protected $table = 'reservas';

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function painel()
    {
        return $this->belongsTo(Outdoor::class, 'outdoor_id', 'id');
    }

    public function bisemana()
    {
        return $this->belongsTo(Bisemana::class, 'bisemana_id', 'id');
    }
}

