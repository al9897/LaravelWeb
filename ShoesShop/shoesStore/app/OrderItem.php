<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    public $product;
    public $quantity;

    public function __construct(array $attributes = [])
    {
        $this->product=$attributes[0];
        $this->quantity=$attributes[1];
    }
}
