<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TargetClient extends Model
{
    //
    protected $table='target_clients';
    protected $primaryKey='id';
    protected $fillable=['for_client'];

    public function products(){
        return $this->hasMany('App\Product','target_client_id');
    }
}
