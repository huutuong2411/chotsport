<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $table = "ward";
    public $timestamp = false;
   
    public function Address() {
        return $this->hasMany('App\Models\Address', 'id_ward');
    }
    public function District() {
        return $this->belongsTo('App\Models\District', 'id_district');
    }
}
