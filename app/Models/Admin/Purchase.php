<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
  
    protected $table = "purchase";
    public function Vendor() {
        return $this->belongsTo('App\Models\Admin\Vendor', 'id_vendor');
    }
     public function Purchase_detail() {
        return $this->hasMany('App\Models\Admin\Purchase_detail', 'id_purchase');
    }
}
