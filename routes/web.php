<?php

use App\Http\Controllers\AuthController;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    $products = Product::all();
    $categorys = Category::all();
    return view('welcome', ['products' => $products, 'categorys' => $categorys]);
})->name('home');

Route::get('/cart', function () {
    $cartUser = [];
    if(Auth::check()){
        $cartUser = Cart::where('user_id', Auth()->user()->id)->get();
    }
    return view('cart', ['cartUser' => $cartUser]);
})->name('cart_shop');

Route::get('/registr', function () {
    return view('registr');
})->name('registr');

Route::post('/registr', [AuthController::class, 'registr'])->name('registr_user');

Route::post('/auth_user', [AuthController::class, 'authUser'])->name('user_auth');

Route::get('/auth_user', function () {
    return view('auth_user');
})->name('auth_user');

Route::get('/logout', function(){
    Session::flush();
    Auth::logout();
    return redirect()->route('home');
})->name('logout_user')->middleware('auth');

Route::get('/product/{id}', function($id){
    $product = Product::find($id)->first();
    return view('detail', ['product' => $product]);
})->name('desc_product');

 Route::get('/cart/add/{id}', function($id){
    $product = Product::find($id);
    if ($productExist = Cart::where('product_name', $product->name)->where('user_id', Auth()->user()->id)->first()){
        $productExist->quantity += 1;
        $productExist->save();
    } else {
        $cart = new Cart();
        $cart->user_id = Auth()->user()->id;
        $cart->product_name = $product->name;
        $cart->quantity = 1;
        $cart->sum_product = $product->amount;
        $cart->save();
    }

    return redirect()->route('home');
 })->name('cart_user_add');

 Route::post('/cart/edit', function(Request $request) {
    $editCart = Cart::where('user_id', Auth()->user()->id)->where('id', $request->id)->first();
    $editCart->quantity = $request->quantity;
    $editCart->save();
    
 });

Route::post('/cart/delete/{id}', function($id){
   $deleteProduct = Cart::where('user_id', Auth()->user()->id)->where('id', $id);
   $deleteProduct->delete();
    return redirect()->route('cart_shop');
})->name('delete_cart_product');

Route::get('product/categorys/{id}', function($id){
    $categorys = Category::all();
    $productCategories = Category::find($id)->products()->get();
    return view('welcome', ['products' => $productCategories, 'categorys' => $categorys]);
})->name('product_filtr');

Route::post('/search', function(Request $request){
    $search = $request->search;

    $searchProduct = DB::table('products')->where('name', 'like', "%$search%")->get();
    return view('search', ['searchProduct' => $searchProduct]);
})->name('search_product');



// $searchProduct = DB::table('products')->where(function($query) use ($search){
//     $query->where('name', 'like', "%$search%")
//     ->orWhere('desc', 'like', "%$search%");
// })
// ->orWhereHas('quantity', function($query) use ($search){
//     $query->where('amount', 'like', "%$search%");
// })->get();
// dd($searchProduct);