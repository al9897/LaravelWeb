@extends('layouts.master')

@section('title',$title)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>FROM X-SHOP</h5>
        </div>
        <div class="card-body">
            <h3>We know you have a lot of choice! Thank you for choosing us today!</h3>

            <div class="card">
                <div class="card-header">
                    <h5 class="font-weight-bolder float-left">
                        Your order number: {{$newOrder->id}}
                    </h5>

                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($newOrder->order_detail as $order_detail)
                            <li class="list-group-item">
                                <div class="float-left">
                                    <h6 class="font-weight-bolder">{{$order_detail->product->name}}
                                        (Price: <i class="fas fa-euro-sign"></i>
                                        {{($order_detail->product->sale->sale_percent)*($order_detail->product->price)}}
                                         x Quantity: {{$order_detail->quantity}})
                                    </h6>
                                </div>
                                <div class="float-right">
                                    <h6 class="font-weight-bolder">
                                        <i class="fas fa-euro-sign"></i>
                                        {{($order_detail->quantity)*(($order_detail->product->sale->sale_percent)*($order_detail->product->price))}}
                                    </h6>
                                </div>
                            </li>

                            @endforeach
                    </ul>
                </div>
                <div class="card-header">
                    <h5 class="font-weight-bolder float-right">
                        TOTAL: <i class="fas fa-euro-sign"></i>{{$sum}}
                    </h5>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
