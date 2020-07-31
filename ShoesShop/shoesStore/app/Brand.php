<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $table='brands';
    protected $primaryKey='id';
    protected $fillable=['name'];

    public function products(){
        return $this->hasMany('App\Product','brand_id');
    }



}
