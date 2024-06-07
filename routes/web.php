<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AuthManagerController;
use App\Http\Controllers\LeaselineController;

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

Route::get('/',function(){
    return view('auth.login');
});

Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/registration', [LoginController::class, 'registration'])->name('registration.view');


Route::post('/registration', [LoginController::class, 'registrationPost'])->name('registration.post');

Route::get('/home', [HomeController::class, 'home_view'])->name('home.view');

Route::get('/home', [HomeController::class, 'show_user'])->name('show_user');


Route::get('/link',[LinkController::class, 'link_view'])->name('link.view');

Route::get('/link_fetch', [LinkController::class, 'link_fetch'])->name('link_fetch');// getting the data to display in the table

Route::post('link_store', [LinkController::class, 'link_store'])->name('link_store'); //storing the link data to the database

Route::get('/network', [NetworkController::class, 'network_view'])->name('network.view');

Route::get('/network_fetch', [NetworkController::class, 'network_fetch'])->name('network_fetch');//fetching the data to display to the table

Route::post('/network_store', [NetworkController::class, 'network_store'])->name('network_store');//storing the data in the network table

Route::get('/fetch_link_type', [NetworkController::class, 'fetch_link_type'])->name('fetch_link_type');//drop down for link type in network blade for modal

Route::get('/fetch_lease_line', [NetworkController::class, 'fetch_lease_line'])->name('fetch_lease_line');//drop down for lease line provider in network blade

Route::get('/fetch_link_type_modal', [NetworkController::class, 'fetch_link_type_modal'])->name('fetch_link_type_modal');//drop down for link type in network blade

Route::get('/fetch_lease_line_modal', [NetworkController::class, 'fetch_lease_line_modal'])->name('fetch_lease_line_modal');//drop down for lease line provider in network blade for modal

Route::get('delete_link',[LinkController::class, 'delete_link'])->name('delete_link');

Route::get('delete_network',[NetworkController::class, 'delete_network'])->name('delete_network');

Route::put('/update_link',[LinkController::class, 'update_link'])->name('update_link');

Route::get('/edit_network',[NetworkController::class, 'edit_network'])->name('edit_network');

Route::post('/update_network',[NetworkController::class, 'update_network'])->name('update_network');

Route::get('/get_location',[NetworkController::class, 'get_location'])->name('get_location');

Route::get('/get_geojson',[NetworkController::class, 'get_geojson'])->name('get_geojson');

Route::get('/get_network_info', [NetworkController::class, 'get_network_info'])->name('get_network_info');

Route::get('/view_network_form', [NetworkController::class, 'view_network_form'])->name('view_network_form');

Route::get('/view_network',[NetworkController::class, 'view_network'])->name('view_network');

// ---------------------For Lease Line------------------------

Route::get('/lease_line_provider_view',[LeaselineController::class, 'lease_line_provider_view'])->name('lease_line_provider_view');

Route::get('/get_lease_line',[LeaselineController::class, 'get_lease_line'])->name('get_lease_line');

Route::post('/lease_line_store', [LeaselineController::class, 'lease_line_store'])->name('lease_line_store');//This is for adding new lease line to the database

Route::get('/delete_lease_line', [LeaselineController::class, 'delete_lease_line'])->name('delete_lease_line');

Route::get('/edit_lease_line', [LeaselineController::class, 'edit_lease_line'])->name('edit_lease_line');

Route::post('/update_lease_line', [LeaselineController::class, 'update_lease_line'])->name('update_lease_line');

Route::get('/website_index', [WebsiteController::class, 'website_index'])->name('website_index');