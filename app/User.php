<?php

namespace App;

use App\Models\CanvasElement;
use App\Models\Chair;
use App\Models\Table;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'canvas_element_id', 'table_id', 'family_group_id', 'confirmation', 'phone', 'password', 'roles' , 'file' 
    ];

    protected $casts = [
        'confirmation' => 'boolean',
      ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function chair() {
        return $this->hasOne(Chair::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function canvasElement()
    {
        return $this->belongsTo(CanvasElement::class);
    }

    public function familyGroup()
    {
        return $this->belongsTo(FamilyGroup::class);
    }
}
