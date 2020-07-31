@extends('layouts.master')

@section('title',$title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Your carts:
                    </div>

                        @if($carts==null)
                            <h5>It is empty!</h5>
                        @else
                        <form class="p-4" action="{{url('/'.Auth::user()->id.'/checkout')}}" method="get">
                        <div class="card-body">

                                <ul class="list-group">
                                    @foreach($carts as $item)
                                        <li class="list-group-item">
                                            <img src="{{$item->product->image_path}}" class="rounded float-left mr-2" style="width: 10%;height: 10%;" alt="...">
                                            <div class="float-left">
                                                <h5 class="font-weight-bolder">{{$item->product->name}}</h5>
                                                <p class="font-weight-lighter">Price: <i class="fas fa-euro-sign"></i>{{($item->product->sale->sale_percent)*($item->product->price)}}</p>
                                            </div>
                                            <div class="float-right">
                                                <h5 class="font-weight-bolder float-right"><i class="fas fa-euro-sign"></i>{{($item->quantity)*(($item->product->sale->sale_percent)*($item->product->price))}}</h5>
                                                <select class="form-control" name="{{'item'.$item->product->id}}" onchange="{{URL::to('/')}}">

                                                    @for($i=0;$i<=10;$i++)
                                                        <option value="{{$i}}"{{($i==$item->quantity)?'selected':''}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>

                                        </li>
                                    @endforeach
                                </ul>
                                <button class="btn btn-primary float-right mt-3" type="submit" >Check Out</button>


                        </div>
                        </form>
                        @endif



                </div>
            </div>
        </div>
    </div>
@endsection
