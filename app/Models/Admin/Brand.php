<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "brand";
    public function Size() {
        return $this->hasMany('App\Models\Admin\Size', 'id_brand');
    }
}