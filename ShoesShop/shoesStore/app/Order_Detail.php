<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    //
    protected $table='order_details';

    protected $primaryKey='id';
    protected $fillable=['order_id','product_id','quantity'];

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
