<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    protected $table='promotions';
    protected $primaryKey='id';

    public function getImagePath(){
        return $this->imagePath;
    }
}
