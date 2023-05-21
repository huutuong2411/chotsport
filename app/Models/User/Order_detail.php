<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $table = "order_details";
    protected $fillable = ['id_order', 'id_product_detail', 'price','qty','sum_money'];

    public function Order() {
        return $this->belongsTo('App\Models\User\Order', 'id_order');
    }
    public function Product_detail() {
        return $this->belongsTo('App\Models\Admin\Product_detail', 'id_product_detail');
    }
}
