<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = "city";
    public $timestamp = false;

    public function District() {
        return $this->hasMany('App\Models\District', 'id_city');
    }
}
