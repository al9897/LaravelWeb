<?php
use App\Promotion;
use App\Product;
use App\OrderItem;
use App\Exports\UsersExport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::get('/', function () {
    $title='Home';
    $images=Promotion::all();
    $firstImage=1;
    $products=Product::all();

    return view('homepage',compact('title','images','firstImage','products'));

});

Route::get('/men', function () {
    $title='Men';
    $images=null;
    $products=Product::whereIn('target_client_id',[1,3])->get();
    return view('homepage',compact('title','images','products'));

});

Route::get('/women', function () {
    $title='Women';
    $images=null;
    $products=Product::whereIn('target_client_id',[2,3])->get();
    return view('homepage',compact('title','images','products'));

});

Route::get('/kids', function () {
    $title='Kids';
    $images=null;
    $products=Product::whereIn('target_client_id',[4])->get();
    return view('homepage',compact('title','images','products'));

});

Route::get('/changecart/{itemID}/{newQuan}',function($itemID,$newQuan){
    $orders=session()->pull('order');
    foreach($orders as $order)
    {
        if($order['product_id']==$itemID){
            session()->push('order',['product_id'=>$itemID,'quantity'=>$newQuan]);
        }
        else
            session()->push('order',['product_id'=>$order['product_id'],'quantity'=>$order['quantity']]);
    }
    return redirect('/user_carts');
});

Route::get('/order/{product_id}/{quantity}',function($product_id,$quantity){
    session()->push('order',['product_id'=>$product_id,'quantity'=>$quantity]);
    session()->save();
    return redirect('/');
});

Route::get('/download',function(){

    Excel::store(new UsersExport, 'users.xlsx');
    return Excel::download(new UsersExport, 'users.xlsx');
});


Route::get('/user_carts',function(){
    if(\Illuminate\Support\Facades\Auth::user()==null){
        return redirect('login');
    }
    $title='Your carts';
    $orders=session()->get('order');
    $carts=array();
    if($orders!=null){
        for($i=0;$i<count($orders);$i++){
            $product=Product::find($orders[$i]['product_id']);
            if($product!=null){
                $item=new OrderItem([$product,$orders[$i]['quantity']]);
                $carts[count($carts)]=$item;
            }
        }
    }
    return view('user',compact('carts','title'));

});


Auth::routes();

Route::get('/pdf','AdminController@productsForPDF');
Route::get('/admin','AdminController@index');
Route::get('/products','AdminController@products');
Route::post('/products/add','AdminController@add_product');
Route::get('/products/delete','AdminController@delete_product');
Route::get('/users/lockAdmin/{id}','AdminController@lock_admin');
Route::get('/users/unlockAdmin/{id}','AdminController@unlock_admin');
Route::get('/users/deleteuser','AdminController@deleteUser');
Route::get('/sales/add','AdminController@add_sale');
Route::get('/sales/delete','AdminController@delete_sale');
Route::get('/brands/add','AdminController@add_brand');
Route::get('/brands/delete','AdminController@delete_brand');
Route::get('/users','AdminController@users');
Route::get('/deliverOrder','AdminController@deliverOrder');
Route::get('/rejectOrder','AdminController@rejectOrder');
Route::get('/restoreOrder','AdminController@restoreOrder');
Route::get('/cancelOrder','AdminController@cancelOrder');
Route::get('/{userID}/checkout','CartController@checkout');
Route::get('/profile','AdminController@profile')->name('profile');
Route::post('/profile/{id}/avatarUpload','AdminController@update_avatar');
Route::post('/products/changeImage/{id}','AdminController@change_product_image');


