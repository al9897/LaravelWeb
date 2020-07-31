<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;

class PromotionController extends Controller
{
    //
    public function getPromotionImages(){
        $images=Promotion::all();
    }
}
