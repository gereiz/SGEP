<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UF;
use DB;

class Cidade extends Model
{
    public $timestamps = false;
    protected $table = 'cidades';

    public static function exists($nome, $uf)
    {
       return DB::select(
           'select c.id from cidade as c
           join uf on uf.id = c.uf_id
           where c.nome = ? and
           uf.id = ?',[$nome,$uf]
       );
    }

    public function uf()
    {
        return $this->belongsTo(UF::class, 'uf_id');
    }
}