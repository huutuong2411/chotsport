<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_detail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "product_details";
    protected $fillable = ['id_product', 'id_size', 'size_qty'];

    public function Product() {
        return $this->belongsTo('App\Models\Admin\Product', 'id_product');
    }
    public function Purchase_detail() {
        return $this->hasMany('App\Models\Admin\Purchase_detail', 'id_size');
    }

}
