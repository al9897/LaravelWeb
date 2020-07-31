<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    use SoftDeletes;

    protected $dates=['deleted_at'];
    protected $table='orders';
    protected $primaryKey='id';


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function order_detail(){
        return $this->hasMany('App\Order_Detail');
    }
}
