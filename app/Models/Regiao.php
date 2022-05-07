<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cidade;
use DB;

class Regiao extends Model
{
    public $timestamps = false;
    protected $table = 'regioes';

    public static function exists($cidade, $uf, $regiao)
    {
        return DB::select('
        select r.id from regiao as r
        join cidade c on c.id = r.cidade_id
        join uf on uf.id = c.uf_id
        where c.id = ? and
        uf.id = ? and b.nome = ?',[$cidade,$uf, $regiao]);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

}