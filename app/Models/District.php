<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = "district";
    public $timestamp = false;
   
    public function Ward() {
        return $this->hasMany('App\Models\Ward', 'id_district');
    }
    public function City() {
        return $this->belongsTo('App\Models\City', 'id_city');
    }
}
