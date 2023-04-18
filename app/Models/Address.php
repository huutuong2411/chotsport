<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = "address";
    public $timestamps = false;
   
    public function User() {
        return $this->hasMany('App\Models\User', 'id_address');
    }
    public function Ward() {
        return $this->belongsTo('App\Models\Ward', 'id_ward');
    }
}
