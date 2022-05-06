<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CanvasElement extends Model
{

    protected $casts = [
        'chairs' => 'array'
    ];

    protected $fillable = ['name', 'code', 'catalogue_id', 'pos_x', 'pos_y'];    

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }   
    
}
