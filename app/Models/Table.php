<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{

    protected $fillable = ['name', 'code', 'pos_x', 'pos_y'];

    public function chairs()
    {
        return $this->hasMany(Chair::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }   
}


