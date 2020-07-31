<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table='products';
    protected $primaryKey='id';
    protected $fillable=['name','description','price','stock','brand_id','target_client_id','image_path','sale_id','viewed_number','bought_number','pixelate_img'];

    public function brand(){
        return $this->belongsTo('App\Brand');
    }

    public function target_client(){
        return $this->belongsTo('App\TargetClient');
    }

    public function sale(){
        return $this->belongsTo('App\Sale');
    }


}
