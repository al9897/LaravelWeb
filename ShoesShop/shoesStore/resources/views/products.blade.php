@extends('layouts.master')

@section('title',$title)

@section('content')
    <div class="container">
    @if(count($errors))
		                                	<div class="alert alert-danger">
		                            		<strong>Whoops!</strong> There were some problems with your input.
                                            <br/>
	                            			<ul>
	                         				@foreach($errors->all() as $error)
		                        			<li>{{ $error }}</li>
	                        				@endforeach
	                            			</ul>
	                                		</div>
                                		@endif
        @if(Auth::user()->isAdmin==1)
            <div class="row">
            
                <h3 class="font-weight-bold ml-3">Products Table
                </h3>
                <a href="#addNewProductModal" class="ml-3 h3 text-primary" data-toggle="modal" data-target="#addNewProductModal"><i class="fas fa-plus-circle"></i></a>
                <div class="modal fade" id="addNewProductModal" tabindex="-1" role="dialog" aria-labelledby="addNewProductModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addNewProductModal">Add a new product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form enctype="multipart/form-data"action="{{url('/products/add')}}" method="POST" >
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="newProductName">Product Name</label>
                                        <input class="form-control" type="text" name="newProductName">
                                    </div>
                                    <div class="form-group">
                                        <label for="newProductDescription">Description</label>
                                        <textarea class="form-control" name="newProductDescription" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="newProductBrandID">Brand ID</label>
                                        <input class="form-control" type="text" name="newProductBrandID" placeholder="Choose a ID from the brand table">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="newProductTargetClientID">Target Client ID</label>
                                        <input class="form-control" type="text" name="newProductTargetClientID" placeholder="1 for Male, 2 for Female, 3 for Unisex, 4 for Kids">
                                    </div>
                                  
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="newProductPrice">Price</label>
                                        <input class="form-control" type="text" name="newProductPrice">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="newProductStock">Stock</label>
                                        <input class="form-control" type="text" name="newProductStock">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="newProductSaleID">Sale ID</label>
                                        <input class="form-control" type="text" name="newProductSaleID" placeholder="Choose a ID from the sale table">
                                    </div>
                                    <div class="form-group">
                                      <label> Update Profile Image </label>                             
                                       <input type="file" name="product">
                                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                <a href="#deleteProductModal" class="ml-3 h3 text-danger" data-toggle="modal" data-target="#deleteProductModal"><i class="fas fa-minus-circle"></i></a>
                <div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteProductModal">Delete a product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="get" action="{{url('/products/delete')}}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="deleteProductID">Product ID</label>
                                        <input class="form-control" type="text" name="deleteProductID" placeholder="ID of product to delete">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12">
                    <table class="table">
                        <thead class="thead text-white bg-primary font-weight-bold">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Target Clients</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Sale Description</th>
                            <th scope="col">Image Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->brand->name}}</td>
                            <td>{{$product->target_client->for_client}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->sale->description}}</td>
                            <td>{{$product->image_path}}
                                <a style="color:green" href="#changeProductImageModal" data-toggle="modal" data-target="#changeProductImageModal"><i class="fas fa-cloud-upload-alt"></i></a>
                                <div class="modal fade" id="changeProductImageModal" tabindex="-1" role="dialog" aria-labelledby="changeProductImageModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="changeProductImageModal">Upload new image</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form enctype="multipart/form-data" method="post" action="{{url('/products/changeImage/'.$product->id)}}" class="p-3">
                                                <input type="file" name="product">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="pull-right btn btn-sm btn-primary" value="Upload">
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <th><a href=" {{url('/pdf')}}" class="btn btn-danger ">Export all products to a pdf file</a>  </th>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <table class="table">
                                <thead class="thead text-white bg-primary font-weight-bold">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Brand</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $brand)
                                    <tr>
                                        <th scope="row">{{$brand->id}}</th>
                                        <td>{{$brand->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger float-left mr-1" data-toggle="modal" data-target="#deleteBrandModal">
                                Delete brand
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog" aria-labelledby="deleteBrandModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteBrandModal">Delete a brand</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="get" action="{{url('/brands/delete')}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="deleteBrandID">Brand ID</label>
                                                    <input class="form-control" type="text" name="deleteBrandID" placeholder="ID of brand to delete">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#addNewBrandModal">
                                Add new brand
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="addNewBrandModal" tabindex="-1" role="dialog" aria-labelledby="addNewBrandModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewBrandModal">Add a new brand</h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="get" action="{{url('/brands/add')}}">
                                    
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="newBrandName">Brand</label>
                                                    <input class="form-control" type="text" name="newBrandName">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">
                                <thead class="thead text-white bg-primary font-weight-bold">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Sale Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <th scope="row">{{$sale->id}}</th>
                                        <td>{{$sale->description}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger float-left mr-1" data-toggle="modal" data-target="#deleteSaleModal">
                                Delete sale
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteSaleModal" tabindex="-1" role="dialog" aria-labelledby="deleteSaleModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteSaleModal">Delete a sale program</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="get" action="{{url('/sales/delete')}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="deleteSaleID">Sale ID</label>
                                                    <input class="form-control" type="text" name="deleteSaleID" placeholder="ID of sale to delete">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addNewSaleModal">
                                Add new sale
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="addNewSaleModal" tabindex="-1" role="dialog" aria-labelledby="addNewSaleModal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewSaleModal">Add a new sale program</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="get" action="{{url('/sales/add')}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="newSaleDescription">Description</label>
                                                    <input class="form-control" type="text" name="newSaleDescription">
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold" for="newSalePercent">Percent</label>
                                                    <input class="form-control" type="text" name="newSalePercent" placeholder="Percent left after discount (Discount 20% -> Percent 0.8)">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>
@endsection
