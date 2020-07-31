<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\User;
use App\Sale;
use App\Brand;
use Auth;
use Intervention\Image\Image;
use DB;
use PDF;
class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index() //index links to orders page
    {
        $title='Orders Management';
        $orders=Order::where('deleted_at',null)->where('isDone',0)->get();
        $rejectOrders=Order::onlyTrashed()->get();
        $sum=0;
        foreach ($orders as $order){
            foreach ($order->order_detail as $item){
                $sum+=$item->product->price*$item->product->sale->sale_percent*$item->quantity;
            }
        }

        return view('orders',compact('title','orders','sum','rejectOrders'));
    }

    public function products(){

        $title='Products Management';
        $products=Product::all();
        $brands=Brand::all();
        $sales=Sale::all();
        return view('products',compact('title','products','brands','sales'));
    }
    public function productsForPDF(){
        $products=Product::all();
       return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf',['products'=>$products])->stream();
    }
    public function users(){

        $title='Users Management';
        $users=User::where('id','!=',Auth::user()->id)->get();
        
        return view('users',compact('title','users'));
    }

    public function add_product(Request $request){
        $this->validate($request,[
            'newProductName' => 'required|max:35',
            'newProductDescription' =>'required',
            'newProductBrandID' => 'required',
            'newProductTargetClientID'=>'required',
            'newProductPrice' =>'required',
            'newProductStock' =>'required',
            'newProductSaleID' =>'required',
        ],[
            'newProductName.required' => ' The name of product field is required.',
            'newProductDescription.required'=> ' The description of product field is required.',
            'newProductBrandID.required' => ' The brand of product field is required.',
            'newProductTargetClientID.required'=> ' The target client of product field is required.',
            'newProductPrice.required' => ' The price of product field is required.',
            'newProductStock.required'=> ' The numbers of product in the stock field is required.',
            'newProductSaleID.required' => ' The sale id of product field is required.',

        ]);
        $newProduct=Product::where('name',$request->get('newProductName'))->get();
      
        if(count($newProduct)==0){
            $path='image/sample_product.jpg';
            $pixel_path="";
            if($request ->hasFile('product')){
                $productImage =$request -> file('product');
                $filename =time().'.'.$productImage->getClientOriginalExtension();
                //$productImage->move(public_path("/upload/products"),$filename);

                $path="upload/products"."/".$filename;
                $img=\Intervention\Image\Facades\Image::make($productImage->getRealPath());
                $img->resize(200,350,function ($constraint) {
                    $constraint->aspectRatio();
                })->insert(public_path('image/logo_50px.png'), 'bottom-right', 5, 5)->save($path);

                $img=\Intervention\Image\Facades\Image::make($productImage->getRealPath());
                $pixel_path= "upload/products/pixelate"."/".$filename;
                $img->pixelate(20)->save($pixel_path);

            }

          
            $newProduct=new Product;

          $newProduct->name=$request->get('newProductName');
          $newProduct->description=$request->get('newProductDescription');
          $newProduct->brand_id=$request->get('newProductBrandID');
          $newProduct->target_client_id=$request->get('newProductTargetClientID');
          $newProduct->price=$request->get('newProductPrice');
          $newProduct->image_path=$path;
          $newProduct->pixelate_img=$pixel_path;
          $newProduct->stock=$request->get('newProductStock');
          $newProduct->sale_id=$request->get('newProductSaleID');
          $newProduct->viewed_number=0;
          $newProduct->bought_number=0;
          $newProduct->save();
        }
    
        return redirect('/products');
    }

    public function change_product_image(Request $request,$id){
        $product=Product::find($id);
        if($product!=null){
            $path='image/sample_product.jpg';
            $pixel_path="";
            if($request ->hasFile('product')){
                $productImage =$request -> file('product');
                $filename =time().'.'.$productImage->getClientOriginalExtension();
                //$productImage->move(public_path("/upload/products"),$filename);

                $path="upload/products"."/".$filename;
                $img=\Intervention\Image\Facades\Image::make($productImage->getRealPath());
                $img->resize(200,350,function ($constraint) {
                    $constraint->aspectRatio();
                })->insert(public_path('image/logo_50px.png'), 'bottom-right', 5, 5)->save($path);

                $img=\Intervention\Image\Facades\Image::make($productImage->getRealPath());
                $pixel_path= "upload/products/pixelate"."/".$filename;
                $img->pixelate(20)->save($pixel_path);

            }

            $product->image_path=$path;
            $product->pixelate_img=$pixel_path;
            $product->save();
        }
        return redirect('/products');
    }

    public function deleteUser(Request $request){
        $id=$request->get('deleteUserID');
        $user=User::find($id);
        $user->delete();
        return redirect('/users');
    }
    public function lock_admin($id){

        $user= User::find($id);
        $user->isAdmin=0;
        $user->save();
        return redirect('/users');
    }

    public function unlock_admin($id){

        $user= User::find($id);
        $user->isAdmin=1;
        $user->save();
        return redirect('/users');
    }

    public function delete_product(Request $request){
        Product::destroy($request->get('deleteProductID'));
        return redirect('/products');
    }

    public function add_sale(Request $request){
        $this->validate($request,[
            'newSaleDescription' => 'required|max:35',
            'newSalePercent' =>'required'
        ],[
            'newSaleDescription.required' => ' The sale description field is required.',
            'newSalePercent.required'=> ' The percentage of sale field is required.',
        ]);
        $newSale=new Sale;
        $newSale->description=$request->get('newSaleDescription');
        $newSale->sale_percent=$request->get('newSalePercent');
        $newSale->save();

        return redirect('/products');
    }

    public function delete_sale(Request $request){
        Sale::destroy($request->get('deleteSaleID'));

        return redirect('/products');
    }

    public function add_brand(Request $request){
        $this->validate($request,[
            'newBrandName' => 'required|min:5|max:35',
        ],[
            'newBrandName.required' => ' The brand name field is required.',
        ]);

        $newBrand=$request->get('newBrandName');
        $brand=Brand::where('name',$newBrand)->get();
        if(count($brand)==0){
            $brand=new Brand;
            $brand->name=$newBrand;
            $brand->save();
        }

        return redirect('/products');
    }

    public function delete_brand(Request $request){
        Brand::destroy($request->get('deleteBrandID'));

        return redirect('/products');
    }

    

    public function deliverOrder(Request $request){
        $orderNo=$request->get('deliverOrderNumber');
        $order=Order::find($orderNo);
        if($order!=null){
            $order->isDone=1;
            $order->save();
        }

        return redirect('/admin');
    }

    public function rejectOrder(Request $request){
        $orderNo=$request->get('rejectOrderNumber');
        Order::destroy($orderNo);

        return redirect('/admin');
    }

    public function restoreOrder(Request $request){
        $orderNo=$request->get('restoreOrderNumber');
        Order::withTrashed()->where('id',$orderNo)->restore();

        return redirect('/admin');
    }

    public function cancelOrder(Request $request){
        $orderNo=$request->get('cancelOrderNumber');
        Order::withTrashed()->where('id',$orderNo)->forceDelete();

        return redirect('/admin');
    }
    public function profile()
    {
        $title='Profile';
        return view('profile',compact('title'), array('user' => Auth::user()));
    }
    public function update_avatar(Request $request,$id)
    {
        
        $title='Profile';
       
        // if($request ->hasFile('avatar')){
           
            $avatar = $request -> file('avatar');
            $allowedFileTypes = config('app.allowedFileTypes');
            $maxFileSize = config('app.maxFileSize');
            $rules = [
                'avatar'=>'required|mimes:jpg,jpeg,png|max:1000'
            ];
            $this->validate($request,$rules);
            $filename =time().'.'.$avatar->getClientOriginalExtension();
            $avatar->move(public_path("/upload/avatars"),$filename);
            $path='/upload/avatars/'.$filename;

            $user = Auth::user();
            $user->avatar=$path;
            $user->save();
      //  }
        return view('profile',compact('title'), array('user' => Auth::user()));
    }
   

  
}
