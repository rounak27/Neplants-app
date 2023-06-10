<?php
use App\Http\Controllers\CartControler;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Faker\Provider\Payment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
    dd("Welcome");//debug 
    return view('welcome');
});
Route::get('/login',[LoginController::class,'authenticate']);
Route::get('/category',[CategoryController::class,'getAction']);

Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/products',[ProductController::class,'index']);
Route::get('/product/{slugs}',[ProductController::class,'show']);

Route::get('/about',function(){
    // dd("Login Page");
    return view('about');
});
Route::post('/cart',[CartControler::class,'add']);
Route::get('/cart',[CartControler::class,'show']);
 Route::delete('/cart/remove',[CartControler::class,'delete']);
Route::post('/cart/update',[CartControler::class,'update']);
Route::get('/checkout',[CheckOutController::class,'checkout']);
Route::post('/checkout',[CheckOutController::class,'store'])->name('checkout.store');
Route::get('/payment/{paymentgateway}',[PaymentController::class,'show'])->name('payment.show');
Route::get('/thankyou',[PaymentController::class,'thankyou'])->name('thankyou');