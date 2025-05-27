<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\OrderController; 
use App\Http\Controllers\berandaController;
use App\Http\Controllers\ProdukController; 
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController; 
use App\Http\Controllers\RajaOngkirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () { 
    // return view('welcome'); 
    return redirect()->route('beranda');
}); 

Route::get('backend/beranda', [berandaController::class, 'berandaBackend'])->name('backend.beranda');
Route::get('backend/login', [loginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [loginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [loginController::class, 'logoutBackend'])->name('backend.logout');
Route::resource('backend/user', userController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend'])->middleware('auth'); 
Route::resource('backend/produk', ProdukController::class, ['as' => 'backend'])->middleware('auth'); 
Route::post('foto-produk/store', [ProdukController::class, 'storeFoto'])->name('backend.foto_produk.store')->middleware('auth');
Route::delete('foto-produk/{id}', [ProdukController::class, 'destroyFoto'])->name('backend.foto_produk.destroy')->middleware('auth');
Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser')->middleware('auth'); 
Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser')->middleware('auth');
Route::get('backend/laporan/formproduk', [ProdukController::class, 'formProduk'])->name('backend.laporan.formproduk')->middleware('auth'); 
Route::post('backend/laporan/cetakproduk', [ProdukController::class, 'cetakProduk'])->name('backend.laporan.cetakproduk')->middleware('auth'); 
Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda'); 
Route::get('/produk/kategori/{id}', [ProdukController::class, 'produkKategori'])->name('produk.kategori');
Route::get('/produk/all', [ProdukController::class, 'produkAll'])->name('produk.all');  

//API Google 
Route::get('/auth/redirect', [CustomerController::class, 'redirect'])->name('auth.redirect'); 
Route::get('/auth/google/callback', [CustomerController::class, 'callback'])->name('auth.callback'); 
// Logout 
Route::post('/customer/logout', [CustomerController::class, 'logout'])->name('customer.logout'); 
// Route untuk Customer 
Route::resource('backend/customer', CustomerController::class, ['as' => 'backend'])->middleware('auth');

// Group route untuk customer 
Route::middleware('is.customer')->group(function () { 
    // Route untuk menampilkan halaman akun customer 
    Route::get('/customer/akun/{id}', [CustomerController::class, 'akun']) 
        ->name('customer.akun'); 
 
    // Route untuk mengupdate data akun customer 
    Route::put('/customer/updateakun/{id}', [CustomerController::class, 'updateAkun']) 
        ->name('customer.updateakun'); 
 
    // Route keranjang belanja 
    Route::post('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('order.addToCart'); 
    Route::get('cart', [OrderController::class, 'viewCart'])->name('order.cart'); 
    Route::post('cart/update/{id}', [OrderController::class, 'updateCart'])->name('order.updateCart'); 
    Route::post('remove/{id}', [OrderController::class, 'removeFromCart'])->name('order.remove'); 

    // Ongkir 
    Route::post('select-shipping', [OrderController::class, 'selectShipping'])->name('order.selectShipping'); 
    Route::get('select-payment', [OrderController::class, 'selectPayment'])->name('order.selectpayment'); // <-- ADD THIS
    Route::get('provinces', [OrderController::class, 'getProvinces']); 
    Route::get('cities', [OrderController::class, 'getCities']); 
    Route::post('cost', [OrderController::class, 'getCost']); 
    Route::post('updateongkir', [OrderController::class, 'updateongkir'])->name('order.updateongkir'); 
}); 
Route::get('/list-ongkir', function () { 
    $response = Http::withHeaders([ 
    'key' => 'e86e8d1bab75ac940a77cc3a45d84b4f' 
    ])->get('https://api.rajaongkir.com/starter/province');  //ganti 'province' atau 'city' 
    dd($response->json()); 
    }); 
Route::get('/cek-ongkir', function () { 
        return view('v_ongkir.ongkir'); 
    }); 
Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']); 
Route::get('/cities', [RajaOngkirController::class, 'getCities']); 
Route::post('/cost', [RajaOngkirController::class, 'getCost']);

