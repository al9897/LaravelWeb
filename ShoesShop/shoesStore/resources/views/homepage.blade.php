@extends('layouts.master')

@section('title',$title)

@section('promotion')
@if($images!=null)
    <div class="w-100">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($images as $image)
                    <div class="carousel-item {{$image->id==$firstImage?'active':''}}">
                        <img src="{{asset($image->image_path)}}" class="d-block w-100" alt="...">
                    </div>
                @endforeach

            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
@endif
@endsection


@section('content')

            <!--Main content code to be written here -->
    @if(count($products->where('stock','>',0))!=0)
    <div class="row mb-5">
        <div class="col-md-12 col-sm-12">
            <h2 class="h3 font-weight-bold text-center"> THE MOST VIEWED</h2>
        </div>
        @foreach($products->sortBy('viewed_number',false)->take(8) as $product)
        <div class="col-md-3 col-sm-6 my-3">
            <div class="card" >
                <img src='{{asset($product->image_path)}}' onmouseover="this.src='{{asset($product->pixelate_img)}}'" onmouseout="this.src='{{asset($product->image_path)}}'" class="card-img-top mb-1" width="200px" height="350px" alt="...">
                <div class="card-body">
                    <h5 class="mb-0">{{$product->name}}</h5>
                    <h6 class="text-muted mb-0">Brand: {{$product->brand->name}}</h6>
                    <h6 class="text-muted mb-0">Target clients: {{$product->target_client->for_client}}</h6>
                    <p class="mb-0">Price: <i class="fas fa-euro-sign"></i> {{$product->price}}</p>
                    <a href="{{url('/order/'.$product->id.'/1')}}" class="btn btn-primary">Buy</a>
                </div>
            </div>
        </div>
            @endforeach
            @endif
    </div>
    @if(count($products->where('stock','>',0))!=0)
            <div class="row mb-5">
                <div class="col-md-12 col-sm-12">
                    <h2 class="h2 font-weight-bold text-center"> THE MOST CHOSEN</h2>
                </div>
                @foreach($products->sortBy('bought_number',false)->take(8) as $product)
                    <div class="col-md-3 col-sm-6 my-3">
                        <div class="card" >
                            <img src='{{asset($product->image_path)}}' onmouseover="this.src='{{asset($product->pixelate_img)}}'" onmouseout="this.src='{{asset($product->image_path)}}'" class="card-img-top mb-1" width="200px" height="350px" alt="...">
                            <div class="card-body">
                                <h5 class="mb-0">{{$product->name}}</h5>
                                <h6 class="text-muted mb-0">Brand: {{$product->brand->name}}</h6>
                                <h6 class="text-muted mb-0">Target clients: {{$product->target_client->for_client}}</h6>
                                <p class="mb-0">Price: <i class="fas fa-euro-sign"></i> {{$product->price}}</p>
                                <a href="{{url('/order/'.$product->id.'/1')}}" class="btn btn-primary">Buy</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>

        @if(count($products->where('sale_id','>',1))!=0)
            <div class="row mb-5">
                <div class="col-md-12 col-sm-12">
                    <h2 class="h2 font-weight-bold text-center"> THE MOST SALES</h2>
                </div>
                @foreach($products->where('sale_id','>',1)->sortBy('sale_id',false)->take(8) as $product)
                    <div class="col-md-3 col-sm-6 my-3">
                        <div class="card" >
                            <img src='{{asset($product->image_path)}}' onmouseover="this.src='{{asset($product->pixelate_img)}}'" onmouseout="this.src='{{asset($product->image_path)}}'" class="card-img-top mb-1" width="200px" height="350px" alt="...">
                            <div class="card-body">
                                <h5 class="mb-0 font-weight-bold">{{$product->name}} </h5>
                                <h5 class="mb-0 font-weight-bold"><em>NOW {{$product->sale->description}}</em></h5>
                                <h6 class="text-muted mb-0">Brand: {{$product->brand->name}}</h6>
                                <h6 class="text-muted mb-0">Target clients: {{$product->target_client->for_client}}</h6>
                                <p class="mb-0">Price: <del><i class="fas fa-euro-sign"></i> {{$product->price}}</del>
                                     <i class="fas fa-euro-sign"></i>{{($product->price)*($product->sale->sale_percent)}}</p>
                                <a href="{{url('/order/'.$product->id.'/1')}}" class="btn btn-primary">Buy</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
@endsection
