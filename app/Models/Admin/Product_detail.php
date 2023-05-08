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
}
