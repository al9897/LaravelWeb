@extends('layouts.master')

@section('title',$title)

@section('content')
    <div class="container">
        @if(Auth::user()->isAdmin==1)
        <div class="row justify-content-center">
            <div class="col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="font-weight-bolder">New Orders</h5>
                    </div>
                    <div class="card-body">
                        @if($orders!=null)
                        <ol  id="accordion" class="">

                            @foreach($orders as $index=>$order)
                                <div class="panel">
                                    <li class="">
                                        <a class="" data-toggle="collapse" href="#collapse-{{$index}}" role="button" aria-expanded="false" aria-controls="collapse-{{$index}}" data-parent="#accordion">
                                            Order number: {{$order->id}} -
                                            @if($order->user!=null)
                                            Customer: {{$order->user->name}}
                                                @else
                                                Customer: Non-Existed
                                                @endif
                                        </a>
                                        <span class="badge badge-secondary badge-pill">{{count($order->order_detail)}}</span>
                                    </li>
                                    <div class="collapse" id="collapse-{{$index}}" >
                                        <div class="card card-body">

                                            <ul>
                                                <p hidden>{{$subSum=0}}</p>
                                                @foreach($order->order_detail as $item)
                                                    <li>
                                                        <div class="float-left">
                                                            Product: {{$item->product->name}},
                                                            Price: <i class="fas fa-euro-sign"></i>
                                                            {{($item->product->sale->sale_percent)*($item->product->price)}},
                                                            Quantity: {{$item->quantity}}
                                                        </div>
                                                        <div class="float-right">
                                                            <i class="fas fa-euro-sign"></i>
                                                            {{($item->quantity)*(($item->product->sale->sale_percent)*($item->product->price))}}
                                                        </div>
                                                    </li>
                                                    <p hidden>{{$subSum=$subSum+(($item->quantity)*(($item->product->sale->sale_percent)*($item->product->price)))}}</p>
                                                @endforeach

                                            </ul>
                                            <div class="mt-2 text-right font-weight-bolder">Total: <i class="fas fa-euro-sign"></i>{{$subSum}}</div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                        </ol>
                        @else
                            <h4>No new order</h4>
                        @endif
                    </div>
                    <div class="card-header">
                        <h5 class="font-weight-bolder float-right">
                            TOTAL: <i class="fas fa-euro-sign"></i>{{$sum}}
                        </h5>

                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        <h5 class="font-weight-bolder">Postponed Orders</h5>
                    </div>
                    <div class="card-body">

                        <ol  id="accordion" class="">

                            @foreach($rejectOrders as $index=>$order)
                                <div class="panel">
                                    <li class="">
                                        <a class="" data-toggle="collapse" href="#collapse-{{$index}}" role="button" aria-expanded="false" aria-controls="collapse-{{$index}}" data-parent="#accordion">
                                            Order number: {{$order->id}} - Customer: {{$order->user->name}}
                                        </a>
                                        <span class="badge badge-secondary badge-pill">{{count($order->order_detail)}}</span>
                                    </li>
                                    <div class="collapse" id="collapse-{{$index}}" >
                                        <div class="card card-body">

                                            <ul>
                                                <p hidden>{{$subSum=0}}</p>
                                                @foreach($order->order_detail as $item)
                                                    <li>
                                                        <div class="float-left">
                                                            Product: {{$item->product->name}},
                                                            Price: <i class="fas fa-euro-sign"></i>
                                                            {{($item->product->sale->sale_percent)*($item->product->price)}},
                                                            Quantity: {{$item->quantity}}
                                                        </div>
                                                        <div class="float-right">
                                                            <i class="fas fa-euro-sign"></i>
                                                            {{($item->quantity)*(($item->product->sale->sale_percent)*($item->product->price))}}
                                                        </div>
                                                    </li>
                                                    <p hidden>{{$subSum=$subSum+(($item->quantity)*(($item->product->sale->sale_percent)*($item->product->price)))}}</p>
                                                @endforeach

                                            </ul>
                                            <div class="mt-2 text-right font-weight-bolder">Total: <i class="fas fa-euro-sign"></i>{{$subSum}}</div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </ol>


                    </div>

                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                Deliver Order
                            </div>
                            <div class="card-body">
                                <form method="get" action="{{url('/deliverOrder')}}">
                                    <div class="form-group">
                                        <label for="orderNumber">Order Number</label>
                                        <input type="number" class="form-control" name="deliverOrderNumber"  placeholder="Enter Order#">
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Deliver</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card ml-1">
                            <div class="card-header font-weight-bold">
                                Postpone Order
                            </div>
                            <div class="card-body">
                                <form method="get" action="{{url('/rejectOrder')}}">
                                    <div class="form-group">
                                        <label for="orderNumber">Order Number</label>
                                        <input type="number" class="form-control" name="rejectOrderNumber"  placeholder="Enter Order#">
                                    </div>

                                    <button type="submit" class="btn btn-danger float-right">Postpone</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                Continue Order
                            </div>
                            <div class="card-body">
                                <form method="get" action="{{url('/restoreOrder')}}">
                                    <div class="form-group">
                                        <label for="orderNumber">Order Number</label>
                                        <input type="number" class="form-control" name="restoreOrderNumber"  placeholder="Enter Order#">
                                    </div>

                                    <button type="submit" class="btn btn-primary float-right">Continue</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card ml-1">
                            <div class="card-header font-weight-bold">
                                Cancel Order
                            </div>
                            <div class="card-body">
                                <form method="get" action="{{url('/cancelOrder')}}">
                                    <div class="form-group">
                                        <label for="orderNumber">Order Number</label>
                                        <input type="number" class="form-control" name="cancelOrderNumber"  placeholder="Enter Order#">
                                    </div>

                                    <button type="submit" class="btn btn-danger float-right">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

            @endif
    </div>

@endsection
