<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comment";
    protected $fillable = ['id_user','id_order','id_product', 'message'];
    public function User() {
        return $this->belongsTo('App\Models\Users', 'id_user');
    }
    public function Product() {
        return $this->belongsTo('App\Models\Admin\Product', 'id_product');
    }
}
