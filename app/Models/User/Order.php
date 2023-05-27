<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "order";
    protected $fillable = ['id_user', 'id_address', 'name','email','note','phone','sum_money','status','payment_status'];

    public function Address() {
        return $this->belongsTo('App\Models\Address', 'id_address');
    }
    public function Order_detail() {
        return $this->hasMany('App\Models\User\Order_detail', 'id_order');
    }

    public function User() {
        return $this->belongsTo('App\Models\Users', 'id_user');
    }
    public function getCreatedAtAttribute($date)
	{
	    return \Carbon\Carbon::parse($date)->format('d-m-Y');
	}

	public function getUpdatedAtAttribute($date)
	{
	    return \Carbon\Carbon::parse($date)->format('d-m-Y');
	}

}

