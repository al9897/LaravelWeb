<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
class ProductController extends Controller
{
    //
    public function product()
    {
      $products = Products::all();
      return view('productest', compact('products'));
    }
}
