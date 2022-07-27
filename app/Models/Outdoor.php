<?php

namespace App\Models;
use App\Models\Bairro;
use App\Models\Cidade;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Outdoor extends Model
{
    use HasFactory; 

    protected $table = 'outdoors';


    public function bairro()
    {
        return $this->belongsTo(Bairro::class, 'bairro_id');
    }

}
