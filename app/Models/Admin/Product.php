<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "products";
    public function Product_detail() {
        return $this->hasMany('App\Models\Admin\Product_detail', 'id_product');
    }
    public function Category() {
        return $this->belongsTo('App\Models\Admin\Category', 'id_category');
    }
    public function Brand() {
        return $this->belongsTo('App\Models\Admin\Brand', 'id_brand');
    }
}
