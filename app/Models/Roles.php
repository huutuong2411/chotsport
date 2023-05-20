<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table = "roles";
    public $timestamps = false;
   
    public function User() {
        return $this->hasMany('App\Models\User', 'id_role');
    }
}
