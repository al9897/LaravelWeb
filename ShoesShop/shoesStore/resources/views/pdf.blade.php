
    <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12">
                    <table class="table" align="center" width=75%  style="border:1px solid black;border-collapse:collapse;">
                        <thead class="thead text-white bg-primary font-weight-bold">
                        <tr >
                            <th scope="col" style="border:1px solid black;">ID</th>
                            <th scope="col" style="border:1px solid black;" >Name</th>
                            <th scope="col" style="border:1px solid black;">Brand</th>
                            <th scope="col" style="border:1px solid black;">Target Clients</th>
                            <th scope="col" style="border:1px solid black;">Price</th>
                            <th scope="col" style="border:1px solid black;">Stock</th>
                            <th scope="col" style="border:1px solid black;">Sale Description</th>
                            <th scope="col" style="border:1px solid black;">Image Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td style="border:1px solid black;" align="center">{{$product->name}}</td>
                            <td style="border:1px solid black;" align="center">{{$product->brand->name}}</td>
                            <td style="border:1px solid black;" align="center">{{$product->target_client->for_client}}</td>
                            <td style="border:1px solid black;" align="center">{{$product->price}}</td>
                            <td style="border:1px solid black;" align="center">{{$product->stock}}</td>
                            <td style="border:1px solid black;" align="center">{{$product->sale->description}}</td>
                            <td style="border:1px solid black;" align="center"> <img src="./././upload/products/{{$product->image_path}}" class="card-img-top mb-1" alt="..."></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
    </div>   
            