<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Purchase_detail extends Model
{
    use HasFactory;

    protected $table = "purchase_details";
    protected $fillable = ['id_product_detail', 'id_purchase', 'qty', 'price', 'sum_money'];
    public function Product_detail() {
        return $this->belongsTo('App\Models\Admin\Product_detail', 'id_product_detail');
    }
    public function Purchase() {
        return $this->belongsTo('App\Models\Admin\Purchase', 'id_purchase');
    }
}
