<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home.index');
Route::post('/susbcribe', 'NewsletterController@add')->name('newsletter.add');

Route::get('/dashboard', 'AdminController@index')->name('admin.index')->middleware(['auth','admin']);
Route::patch('/dashboard', 'AdminController@updatereminder')->name('admin.reminder')->middleware(['auth','admin']);

Route::get('/order', 'AdminController@order')->name('admin.order')->middleware(['auth','admin']);
Route::post('/order', 'AdminController@update_order')->name('admin.updateorder')->middleware(['auth','admin']);
Route::post('/order/bulkupdate', 'AdminController@update_order_bulk')->name('admin.updateorderbulk')->middleware(['auth','admin']);
Route::get('/order/{id}', 'AdminController@show_order')->name('admin.showorder')->middleware(['auth','admin']);

Route::get('/users', 'AdminController@user')->name('admin.user')->middleware(['auth','admin']);

Route::get('/admin-categories', 'CategoryController@treeView')->name('admin.categories')->middleware(['auth','admin']);
Route::post('/admin-categories/add', 'CategoryController@create')->name('category.create')->middleware(['auth','admin']);
Route::post('/admin-categories/editInfo', 'CategoryController@editForm')->name('category.editForm')->middleware(['auth','admin']);
Route::post('/admin-categories/edit', 'CategoryController@edit')->name('category.edit')->middleware(['auth','admin']);
Route::post('/admin-categories/remove', 'CategoryController@remove')->name('category.remove')->middleware(['auth','admin']);
Route::get('/admin-categories/remove/{id}', 'CategoryController@removeImg')->name('category.removeImg')->middleware(['auth','admin']);

Route::post('/admin-tags/editTag', 'TagController@editTag')->name('admin-tag.editTag')->middleware(['auth','admin']);
Route::resource('admin-tags', 'TagController');

Route::post('/admin-brands/editBrand', 'BrandController@editBrand')->name('admin-brand.editBrand')->middleware(['auth','admin']);
Route::resource('admin-brands', 'BrandController');

Route::get('/admin-transactions', 'ProductController@lisTransactions')->name('admin.transactions')->middleware(['auth','admin']);

Route::get('/admin-product', 'ProductController@listProducts')->name('admin.product')->middleware(['auth','admin']);
Route::get('/admin-product/add', 'ProductController@form')->name('admin.addform')->middleware(['auth','admin']);
Route::post('/admin-product/add', 'ProductController@create')->name('product.create')->middleware(['auth','admin']);
Route::get('/admin-product/edit/{id}', 'ProductController@editform')->name('product.editform')->middleware(['auth','admin']);
Route::patch('/admin-product/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware(['auth','admin']);
Route::get('/admin-product/remove/{id}', 'ProductController@remove')->name('product.remove')->middleware(['auth','admin']);
Route::post('/admin-product/bulkRemove', 'ProductController@bulkRemove')->name('product.bulkRemove')->middleware(['auth','admin']);
Route::post('/admin-product/status', 'ProductController@status')->name('product.status')->middleware(['auth','admin']);
Route::post('/admin-product/bulkStatus', 'ProductController@bulkStatus')->name('product.bulkStatus')->middleware(['auth','admin']);


Route::get('/product','ProductController@index')->name('product.index');
Route::get('/product/filter','ProductController@filter')->name('product.filter');
Route::get('/product/getAttributeDetailsList','ProductController@getAttributeDetailsList')->name('product.getAttributeDetailsList');
Route::get('/product/getProductImageDeleted','ProductController@getProductImageDeleted')->name('product.getProductImageDeleted');
Route::get('/product/getProductAttributeDeleted','ProductController@getProductAttributeDeleted')->name('product.getProductAttributeDeleted');

Route::get('/product/{product}','ProductController@show')->name('product.show');

/*--Attribute--*/
Route::get('/admin-attribute', 'AttributeController@index')->name('admin.attribute')->middleware(['auth','admin']);
Route::get('/admin-attribute/add', 'AttributeController@create')->name('admin.addattribute')->middleware(['auth','admin']);
Route::post('/admin-attribute/add', 'AttributeController@store')->name('attribute.store')->middleware(['auth','admin']);
Route::get('/admin-attribute/edit/{id}', 'AttributeController@edit')->name('attribute.editform')->middleware(['auth','admin']);
Route::patch('/admin-attribute/edit/{id}', 'AttributeController@update')->name('attribute.update')->middleware(['auth','admin']);
Route::get('/admin-attribute/remove/{id}', 'AttributeController@destroy')->name('attribute.remove')->middleware(['auth','admin']);
Route::get('/admin-attribute/getAttributeDeleted', 'AttributeController@getAttributeDeleted')->name('attribute.getAttributeDeleted')->middleware(['auth','admin']);
Route::post('/admin-attribute/bulkRemove', 'AttributeController@bulkRemove')->name('attribute.bulkRemove')->middleware(['auth','admin']);
Route::post('/admin-attribute/status', 'AttributeController@status')->name('attribute.status')->middleware(['auth','admin']);
Route::post('/admin-attribute/bulkStatus', 'AttributeController@bulkStatus')->name('attribute.bulkStatus')->middleware(['auth','admin']);



Route::get('/cart','CartController@index')->name('cart.index');
Route::get('/cart/add/{product}','CartController@add')->name('cart.add');
Route::get('/cart/remove/{id}','CartController@remove')->name('cart.remove');

Route::get('/checkout','CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout','CheckoutController@checkout')->name('checkout')->middleware('auth');

Route::get('/user/order','OrderController@show')->name('order.show')->middleware('auth');

Route::get('/profile/{user}/edit','ProfileController@edit')->name('profile.edit')->middleware('auth');
Route::patch('/profile/{user}','ProfileController@update')->name('profile.update')->middleware('auth');

Auth::routes();

