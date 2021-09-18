<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AccountController;


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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $services = DB::table('services')->get();
    $images = DB::table('multipics')->get();
    return view('home', compact('brands', 'abouts', 'services', 'images'));
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	// $users = User::all();
    return view('admin.index');
})->name('dashboard');

//......User Logout Route.......//
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

//......Category Route......//
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('category/update/{id}', [CategoryController::class, 'Update']);
Route::get('category/softDelete/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('category/remove/{id}', [CategoryController::class, 'Remove']);


//......Brand Route........//
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
Route::get('brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('brand/update/{id}', [BrandController::class, 'Update']);
Route::get('brand/delete/{id}', [BrandController::class, 'Delete']);


//......Multi Image Route.......//
Route::get('/multi/image', [BrandController::class, 'MultiPic'])->name('multi.image');
Route::post('/multi/store', [BrandController::class, 'StoreImage'])->name('store.image');

//......Slider All Roure.........//
Route::get('/slider/all', [HomeController::class, 'AllSlider'])->name('all.slider');
Route::get('/slider/create', [HomeController::class, 'CreateSlider'])->name('add.slider');
Route::post('/slider/add', [HomeController::class, 'AddSlider'])->name('store.slider');
Route::get('slider/edit/{id}', [HomeController::class, 'Edit']);
Route::post('slider/update/{id}', [HomeController::class, 'Update']);
Route::get('slider/delete/{id}', [HomeController::class, 'Delete']);

//.......Home About All Route.......//
Route::get('/about/all', [AboutController::class, 'AllAbout'])->name('all.about');
Route::get('/about/create', [AboutController::class, 'CreateAbout'])->name('add.about');
Route::post('/about/add', [AboutController::class, 'AddAbout'])->name('store.about');
Route::get('about/edit/{id}', [AboutController::class, 'Edit']);
Route::post('about/update/{id}', [AboutController::class, 'Update']);
Route::get('about/delete/{id}', [AboutController::class, 'Delete']);

//......Services All Route........//
Route::get('/service/all', [ServiceController::class, 'AllService'])->name('all.service');
Route::post('/service/add', [ServiceController::class, 'AddService'])->name('store.service');
Route::get('service/edit/{id}', [ServiceController::class, 'Edit']);
Route::post('service/update/{id}', [ServiceController::class, 'Update']);
Route::get('service/delete/{id}', [ServiceController::class, 'Delete']);

//......Home Portfolio Page All Route........//
Route::get('/portfolio', [PortfolioController::class, 'Portfolio'])->name('portfolio');

//......Contact All Route.........//
Route::get('/admin/contact', [ContactController::class, 'AllContact'])->name('all.contact');
Route::post('/contact/add', [ContactController::class, 'AddContact'])->name('store.contact');
Route::get('contact/edit/{id}', [ContactController::class, 'Edit']);
Route::post('contact/update/{id}', [ContactController::class, 'Update']);
Route::get('contact/delete/{id}', [ContactController::class, 'Delete']);
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
Route::get('message/delete/{id}', [ContactController::class, 'DeleteMessage']);

//......Home Contact Page All Route........//
Route::get('/contact', [PortfolioController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [PortfolioController::class, 'ContactForm'])->name('contact.form');

//.......Admin All Route.........//
Route::get('/admin/account', [AccountController::class, 'AdminAccount'])->name('admin.account');
Route::post('/update/password', [AccountController::class, 'UpdatePassword'])->name('update.password');
Route::get('/admin/profile', [AccountController::class, 'AdminProfile'])->name('admin.profile');
Route::post('/update/profile', [AccountController::class, 'UpdateProfile'])->name('update.profile');
Route::post('/update/photo', [AccountController::class, 'UpdatePhoto'])->name('update.photo');
Route::get('user/delete/{id}', [AccountController::class, 'DeletePhoto']);