<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{

    protected $fillable = ['code', 'name', 'coment','category_id', 'status', 'description', 'file'];

    public function cat()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
