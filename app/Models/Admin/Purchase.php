<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "purchase";
    public function Vendor() {
        return $this->belongsTo('App\Models\Admin\Vendor', 'id_vendor');
    }
     public function Purchase_detail() {
        return $this->hasMany('App\Models\Admin\Purchase_detail', 'id_purchase');
    }
}
