<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $table='sales';
    protected $primaryKey='id';
    protected $fillable=['description','sale_percent'];

    public function products(){
        return $this->hasMany('App\Product','sale_id');
    }
}
