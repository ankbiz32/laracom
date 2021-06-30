<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/product','ProductController@index')->name('product.index');
    Route::get('/product/{product}/{slug}','ProductController@show')->name('product.show');
    Route::get('/product/filter','ProductController@filter')->name('product.filter');
    Route::post('/product/quickView', 'ProductController@quickView')->name('product.quickView');

    Route::get('/tags/{tag}','HomeController@tag')->name('tag.list');
    Route::get('/tag/filter','HomeController@filter')->name('tag.filter');
    Route::get('/category/{category}/{slug}','HomeController@category')->name('category.list');
    Route::get('/category/filter','HomeController@categoryFilter')->name('category.filter');

    Route::get('/cart','CartController@index')->name('cart.index');
    Route::get('/cart/add/{product}','CartController@add')->name('cart.add');
    Route::get('/cart/remove/{id}','CartController@remove')->name('cart.remove');
    Route::post('/cart/update', 'CartController@update')->name('cart.update');

    Route::get('/checkout','CheckoutController@index')->name('checkout.index');
    Route::post('/checkout','CheckoutController@checkout')->name('checkout');
    Route::post('/hdfcCheckoutInit','PaymentController@hdfcCheckoutInit')->name('hdfcCheckoutInit');
    Route::post('/hdfcCheckoutResponse','PaymentController@hdfcCheckout')->name('hdfcCheckoutResponse');
    Route::post('/orderResponse', function () {return dd($_POST);});
    Route::get('/checkout/success','CheckoutController@success')->name('checkout.success');
    
    Route::post('paysuccess', 'PaymentController@paysuccess');
    Route::get('thank-you', 'PaymentController@thankYou');

    Route::post('/user/order','OrderController@show')->name('order.show')->middleware('auth');

    Route::get('/profile/{user}','ProfileController@edit')->name('profile.edit')->middleware('auth');
    Route::patch('/profile/{user}','ProfileController@update')->name('profile.update')->middleware('auth');
    Route::patch('/profile/{user}/password','ProfileController@password')->name('profile.password')->middleware('auth');
    Route::post('/product/quickView', 'ProductController@quickView')->name('order.view')->middleware('auth');
    
    Route::get('/wishlist','WishlistController@index')->name('wishlist.index')->middleware('auth');
    Route::get('/wishlist/add/{id}','WishlistController@add')->name('wishlist.add')->middleware('auth');
    Route::get('/wishlist/remove/{id}','WishlistController@remove')->name('wishlist.remove')->middleware('auth');
    Route::get('/wishlist/update/{id}', 'WishlistController@update')->name('wishlist.update')->middleware('auth');


    Route::post('/susbcribe', 'NewsletterController@add')->name('newsletter.add');
});


/*-- Admin Dashboard --*/
Route::get('/dashboard', 'AdminController@index')->name('admin.index')->middleware(['auth', 'backend']);
Route::patch('/dashboard', 'AdminController@updatereminder')->name('admin.reminder')->middleware(['auth','admin']);

/*-- Admin Order --*/
Route::get('/order', 'AdminController@order')->name('admin.order')->middleware(['auth','sales']);
Route::post('/order', 'AdminController@update_order')->name('admin.updateorder')->middleware(['auth','sales']);
Route::post('/order/bulkupdate', 'AdminController@update_order_bulk')->name('admin.updateorderbulk')->middleware(['auth','sales']);
Route::get('/order/{id}', 'AdminController@show_order')->name('admin.showorder')->middleware(['auth','sales']);

/*-- Admin Txns --*/
Route::get('/transactions', 'AdminController@transactions')->name('admin.txn')->middleware(['auth','sales']);
Route::get('txn_status', function () {
    return view('admin.statusApi');
});

/*-- Admin Users --*/
Route::get('/users', 'AdminController@user')->name('admin.user')->middleware(['auth','admin']);
Route::get('/users/add', 'AdminController@userCreate')->name('user.create')->middleware(['auth','admin']);
Route::post('/users/add', 'AdminController@userStore')->name('user.store')->middleware(['auth','admin']);
Route::get('/users/edit/{id}', 'AdminController@userEdit')->name('user.edit')->middleware(['auth','admin']);
Route::patch('/users/edit/{id}', 'AdminController@userUpdate')->name('user.update')->middleware(['auth','admin']);
Route::post('/users/status', 'AdminController@userStatus')->name('user.status')->middleware(['auth','admin']);
Route::post('/users/bulk-status', 'AdminController@userBulkStatus')->name('user.bulkStatus')->middleware(['auth','admin']);
Route::post('/users/role', 'AdminController@userSingleRole')->name('user.role')->middleware(['auth','admin']);
Route::post('/users/bulk-role', 'AdminController@userBulkRole')->name('user.updateRoleBulk')->middleware(['auth','admin']);
Route::get('/user-roles', 'AdminController@userRoles')->name('admin.role')->middleware(['auth','admin']);

/*-- Admin Categories --*/
Route::get('/admin-categories', 'CategoryController@treeView')->name('admin.categories')->middleware(['auth','inventory']);
Route::post('/admin-categories/add', 'CategoryController@create')->name('category.create')->middleware(['auth','inventory']);
Route::post('/admin-categories/editInfo', 'CategoryController@editForm')->name('category.editForm')->middleware(['auth','inventory']);
Route::post('/admin-categories/edit', 'CategoryController@edit')->name('category.edit')->middleware(['auth','inventory']);
Route::post('/admin-categories/remove', 'CategoryController@remove')->name('category.remove')->middleware(['auth','inventory']);
Route::get('/admin-categories/remove/{id}', 'CategoryController@removeImg')->name('category.removeImg')->middleware(['auth','inventory']);

/*-- Admin Tags --*/
Route::post('/admin-tags/editTag', 'TagController@editTag')->name('admin-tag.editTag')->middleware(['auth','inventory']);
Route::resource('admin-tags', 'TagController')->middleware(['auth', 'inventory']);

/*-- Admin Brands --*/
Route::post('/admin-brands/editBrand', 'BrandController@editBrand')->name('admin-brand.editBrand')->middleware(['auth','inventory']);
Route::resource('admin-brands', 'BrandController');

/*-- Admin Products --*/
Route::get('/admin-product', 'ProductController@listProducts')->name('admin.product')->middleware(['auth','inventory']);
Route::get('/admin-product/add', 'ProductController@form')->name('admin.addform')->middleware(['auth','inventory']);
Route::post('/admin-product/add', 'ProductController@create')->name('product.create')->middleware(['auth','inventory']);
Route::get('/admin-product/edit/{id}', 'ProductController@editform')->name('product.editform')->middleware(['auth','inventory']);
Route::patch('/admin-product/edit/{id}', 'ProductController@edit')->name('product.edit')->middleware(['auth','inventory']);
Route::get('/admin-product/remove/{id}', 'ProductController@remove')->name('product.remove')->middleware(['auth','inventory']);
Route::post('/admin-product/bulkRemove', 'ProductController@bulkRemove')->name('product.bulkRemove')->middleware(['auth','inventory']);
Route::post('/admin-product/status', 'ProductController@status')->name('product.status')->middleware(['auth','inventory']);
Route::post('/admin-product/bulkStatus', 'ProductController@bulkStatus')->name('product.bulkStatus')->middleware(['auth','inventory']);

/*-- Admin Attributes --*/
Route::get('/product/getAttributeDetailsList','ProductController@getAttributeDetailsList')->name('product.getAttributeDetailsList')->middleware(['auth','inventory']);
Route::get('/product/getProductImageDeleted','ProductController@getProductImageDeleted')->name('product.getProductImageDeleted')->middleware(['auth','inventory']);
Route::get('/product/getProductAttributeDeleted','ProductController@getProductAttributeDeleted')->name('product.getProductAttributeDeleted')->middleware(['auth','inventory']);

/*--Attribute--*/
Route::get('/admin-attribute', 'AttributeController@index')->name('admin.attribute')->middleware(['auth','inventory']);
Route::get('/admin-attribute/add', 'AttributeController@create')->name('admin.addattribute')->middleware(['auth','inventory']);
Route::post('/admin-attribute/add', 'AttributeController@store')->name('attribute.store')->middleware(['auth','inventory']);
Route::get('/admin-attribute/edit/{id}', 'AttributeController@edit')->name('attribute.editform')->middleware(['auth','inventory']);
Route::patch('/admin-attribute/edit/{id}', 'AttributeController@update')->name('attribute.update')->middleware(['auth','inventory']);
Route::get('/admin-attribute/remove/{id}', 'AttributeController@destroy')->name('attribute.remove')->middleware(['auth','inventory']);
Route::get('/admin-attribute/getAttributeDeleted', 'AttributeController@getAttributeDeleted')->name('attribute.getAttributeDeleted')->middleware(['auth','inventory']);
Route::post('/admin-attribute/bulkRemove', 'AttributeController@bulkRemove')->name('attribute.bulkRemove')->middleware(['auth','inventory']);
Route::post('/admin-attribute/status', 'AttributeController@status')->name('attribute.status')->middleware(['auth','inventory']);
Route::post('/admin-attribute/bulkStatus', 'AttributeController@bulkStatus')->name('attribute.bulkStatus')->middleware(['auth','inventory']);

/*--Admin Country--*/
Route::get('/admin-country', 'CountryController@index')->name('admin.country')->middleware(['auth','admin']);
Route::get('/admin-country/add', 'CountryController@create')->name('admin.addcountry')->middleware(['auth','admin']);
Route::post('/admin-country/add', 'CountryController@store')->name('country.store')->middleware(['auth','admin']);
Route::get('/admin-country/edit/{id}', 'CountryController@edit')->name('country.editform')->middleware(['auth','admin']);
Route::patch('/admin-country/edit/{id}', 'CountryController@update')->name('country.update')->middleware(['auth','admin']);
Route::get('/admin-country/remove/{id}', 'CountryController@destroy')->name('country.remove')->middleware(['auth','admin']);

Route::get('/admin-enquiries', 'AdminController@enquiries')->name('admin.enquiries')->middleware(['auth','backend']);
Route::get('/admin-enquiries/remove/{id}', 'AdminController@delEnq')->name('admin.delEnq')->middleware(['auth','admin']);
Route::post('/admin-enquiries/remove', 'AdminController@delEnqBatch')->name('admin.delEnqBatch')->middleware(['auth','admin']);

Route::get('/admin-wishlist','AdminController@wishlist')->name('admin.wishlist')->middleware(['auth','backend']);
Route::get('txn/{pid}', 'PaymentController@info')->name('txn.info')->middleware(['auth','admin']);

/*--Admin Reports--*/
Route::get('/admin-reports', 'adminController@reports')->name('admin.reports')->middleware(['auth','admin']);

Route::get('/about', 'HomeController@about')->name('home.about');
Route::get('/contact', 'HomeController@contact')->name('home.contact');
Route::post('/contact', 'HomeController@contactSubmit')->name('home.enquire');

Auth::routes();

