<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Purchase_receipt extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "purchase_receipt";
}
