<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{

    protected $fillable = ['table_id', 'user_id', 'name', 'code'];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
