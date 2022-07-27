<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level_Access extends Model
{
    protected $table = 'user_level_access';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
 