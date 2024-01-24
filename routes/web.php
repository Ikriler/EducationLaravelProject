<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\BasketPositionsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagesController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';
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

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contacts', [PagesController::class, 'contacts'])->name('contacts');
Route::get('/for_clients', [PagesController::class, 'for_clients'])->name('for_clients');
Route::get('/terms_of_sales', [PagesController::class, 'terms_of_sales'])->name('terms_of_sales');
Route::get('/fin_department', [PagesController::class, 'fin_department'])->name('fin_department');
Route::get('/catalog/{slug?}', [PagesController::class, 'catalog'])->name('catalog');

Route::get('/articles', [PagesController::class, 'articles'])->name('articles');
Route::get('/articles/{article}', [ArticlesController::class, 'show'])->name('article');

Route::get('/product/{car}', [CarsController::class, 'show'])->name('car');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function(Router $router) {
    $router->get('/', [AdminController::class, 'admin'])->name('admin');
    $router->resource('articles', ArticlesController::class);
    $router->resource('cars', CarsController::class);
});

Route::get('/salons', [PagesController::class, 'salons'])->name('salons');

Route::middleware('auth')->get('/account', [PagesController::class, 'account'])->name('account');


Route::middleware('auth')->group(function (Router $router) {
    $router->resource('/basketPositions', BasketPositionsController::class);
    $router->get('/basket', [PagesController::class, 'basket'])->name('basket');
    $router->post('/orders', [OrdersController::class, 'store'])->name('orders.store');
});
