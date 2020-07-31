<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_Detail;
use App\User;

class CartController extends Controller
{
    //



    public function checkout(Request $request,$userID){

        $orders=session()->pull('order');
        $user=User::find($userID);
        $newOrder=new Order;
        $sum=0;
        if($user!=null){

            $newOrder->user_id=$user->id;
            $newOrder->special_discount=1;


            foreach ($orders as $o){
                $newQuan=$request->get('item'.$o['product_id']);
                if($newQuan!=0){
                    $newOrder->save();
                    $order_detail=new Order_Detail;
                    $order_detail->order_id=$newOrder->id;
                    $order_detail->product_id=$o['product_id'];
                    $order_detail->quantity=$newQuan;
                    $order_detail->save();
                    $order_detail->product->bought_number=$order_detail->product->bought_number+$order_detail->quantity;
                    $order_detail->product->stock=$order_detail->product->stock-$order_detail->quantity;
                    $order_detail->product->save();
                    $sum+=$order_detail->product->price*$order_detail->product->sale->sale_percent*$order_detail->quantity;

                }
            }
        }

        $title='Thanks!';

        return view('thanks',compact('newOrder','title','sum'));
    }
}
