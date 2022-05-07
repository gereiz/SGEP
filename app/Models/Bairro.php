<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Regiao;
use DB;

class Bairro extends Model
{
    public $timestamps = false;
    protected $table = 'bairros';

    public static function exists($regiao, $uf, $cidade, $bairro)
    {
        return DB::select('
        select b.id from bairro as b
        join regiao r on r.id = b.regiao_id
        join cidade c on c.id = r.cidade_id
        join uf on uf.id = c.uf_id
        where r.id = ? and
        uf.id = ? and c.id = ? and b.nome = ?',[$regiao,$uf, $cidade, $bairro]);
    }

    public function regiao()
    {
        return $this->belongsTo(Regiao::class, 'regiao_id');
    }

}