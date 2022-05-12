<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reserva;

class Bisemana extends Model
{
    protected $table = 'bisemanas';

    public function reservas()
    {
        return $this->hasMany(Comment::class, 'bisemana_id', 'id');
    }
}
