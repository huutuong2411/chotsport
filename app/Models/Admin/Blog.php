<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = "blog";


    public function getCreatedAtAttribute($date)
	{
	    return \Carbon\Carbon::parse($date)->format('d-m-Y');
	}

	public function getUpdatedAtAttribute($date)
	{
	    return \Carbon\Carbon::parse($date)->format('d-m-Y');
	}
    
}
