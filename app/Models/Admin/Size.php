<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "size";
    public function Brand() {
        return $this->belongsTo('App\Models\Admin\Brand', 'id_brand');
    }
}
