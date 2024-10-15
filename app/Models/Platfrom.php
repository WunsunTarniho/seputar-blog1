<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Platfrom extends Model
{
    use HasFactory;

    public function medsos(){
        return $this->hasMany(Medsos::class);
    }
}
