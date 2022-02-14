<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class FamilyGroup extends Model
{    
    protected $fillable = ['name', 'detail'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}