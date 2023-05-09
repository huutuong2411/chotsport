<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Vendor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "vendor";
    public function Purchase() {
        return $this->hasMany('App\Models\Admin\Purchase', 'id_vendor');
    }
}
