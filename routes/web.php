<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
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


// ---------------------Frontend------------------------------------- //

// Frontend
Route::get("/", [FrontendController::class, "frontend"])->name("frontend");
Route::get("/product/details/{slug}", [FrontendController::class, "product_details"])->name("product.details");
Route::post("/getSize", [FrontendController::class, "getSize"]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Cart
Route::post("/cart/store", [CartController::class, "cart_store"])->name("cart.store");
Route::get("/cart/remove/{cart_id}", [CartController::class, "cart_remove"])->name("cart.remove");
Route::get("/cart/clear", [CartController::class, "cart_clear"])->name("cart.clear");
Route::get("/cart", [CartController::class, "cart"])->name("cart");
Route::post("/cart/update", [CartController::class, "cart_update"])->name("cart.update");


// Wishlist
Route::get("/wishlist", [WishlistController::class, "wishlist"])->name("wishlist");
Route::get("/wishlist/remove/{wishlist_id}", [WishlistController::class, "wishlist_remove"])->name("wishlist.remove");

// Coupon
Route::get("/coupon", [CouponController::class, "coupon"])->name("coupon");
Route::post("/coupon/store", [CouponController::class, "coupon_store"])->name("coupon.store");
Route::get("/coupon/delete/{coupon_id}", [CouponController::class, "coupon_delete"])->name("coupon.delete");

// Checkout
Route::get("/checkout", [CheckoutController::class, "checkout"])->name("checkout");
Route::post("/getCity", [CheckoutController::class, "getCity"]);
Route::post("/order/store", [CheckoutController::class, "order_store"])->name("order.store");

Route::get("/order/complete", [CheckoutController::class, "order_complete"])->name("order.complete");


// Custom Login/Registration
Route::get("/customer/register", [CustomerRegisterController::class, "customer_register"])->name("customer.register");
Route::get("/customer/login", [CustomerRegisterController::class, "customer_login"])->name("customer.login");
Route::get("/customer/logout", [CustomerRegisterController::class, "customer_logout"])->name("customer.logout");


Route::post("/customer/register/store", [CustomerRegisterController::class, "register_store"])->name("register.store");
Route::post("/customer/login/store", [CustomerRegisterController::class, "login_store"])->name("login.store");


Route::get("/customer/profile", [CustomerController::class, "customer_profile"])->name("customer.profile");
Route::post("/customer/profile/update", [CustomerController::class, "profile_update"])->name("profile.update");

Route::get("customer/order", [CustomerController::class, "customer_order"])->name("customer.order");


// ----------------------------End Frontend-------------------------- //

// ----------------------------Backend------------------------------- //

// User
Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/edit/profile', [UserController::class, 'edit_profile'])->name('edit.profile');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete');
Route::post('/update/profile', [UserController::class, 'update_profile'])->name('update.profile');
Route::post('/update/profile/image', [UserController::class, 'update_profile_image'])->name('update.profile.image');
Route::get("/trash/list", [UserController::class, 'trash_list'])->name('trash.list');

Route::post("/check/delete", [UserController::class, "check_delete"])->name("delete.check");
Route::get("/trash/delete/{user_id}", [UserController::class, 'trash_delete'])->name("trash.delete");
Route::get("/trash/restore-trash/{user_id}", [UserController::class, 'trash_restore'])->name("trash.restore");

Route::post("/check/trash", [UserController::class, 'check_trash'])->name("check.trash");


// Category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');

Route::get('/edit/category/{category_id}', [CategoryController::class, 'category_edit'])->name('edit.category');
Route::get('/delete/category/{category_id}', [CategoryController::class, 'category_delete'])->name('delete.category');

Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');

Route::get("/trash/category", [CategoryController::class, "trash_category"])->name('trash.category');

Route::get("/category/trash/restore/{category_id}", [CategoryController::class, "category_trash_restore"])->name("category.trash.restore");
Route::get("/category/trash/delete/{category_id}", [CategoryController::class, "category_trash_delete"])->name("category.trash.delete");

// Subcategory
Route::get("/sub/category", [CategoryController::class, "sub_category"])->name("sub.category");
Route::post("/sub/category/store", [CategoryController::class, "sub_category_store"])->name("sub.category.store");

// Route::post("/getsubcategory", [CategoryController::class, "getsubcategory"]);

Route::get("/edit/subcategory/{subcategory_id}", [CategoryController::class, "edit_subcategory"])->name("edit.subcategory");
Route::post("/subcategory/update", [CategoryController::class, "subcategory_update"])->name("subcategory.update");
Route::get("/del/subcategory/{subcategory_id}", [CategoryController::class, "del_subcategory"])->name("del.subcategory");

// Product
Route::get("/product", [ProductController::class, "product"])->name("product");
Route::post("/getsubcategory", [ProductController::class, "getsubcategory"]);

Route::post("/product/store", [ProductController::class, "product_store"])->name("product.store");
Route::get("/product/list", [ProductController::class, "product_list"])->name("product.list");

Route::get("/product/delete/{product_id}", [ProductController::class, "product_delete"])->name("product.delete");

// Product Inventory
Route::get("/product/inventory/{product_id}", [ProductController::class, "product_inventory"])->name("inventory");
Route::post("/inventory/store", [ProductController::class, "inventory_store"])->name("inventory.store");
Route::get("/del/inventory/{inventory_id}", [ProductController::class, "del_inventory"])->name("del.inventory");


// Product Variation
Route::get("/product/variation", [ProductController::class, "product_variation"])->name("product.variation");
Route::post("/color/store", [ProductController::class, "color_store"])->name("color.store");
Route::post("/size/store", [ProductController::class, "size_store"])->name("size.store");

Route::get("/color/delete/{color_id}", [ProductController::class, "color_delete"])->name("color.delete");
Route::get("/size/delete/{size_id}", [ProductController::class, "size_delete"])->name("size.delete");


// Orders
Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
Route::post('/order/status', [OrderController::class, 'order_status'])->name('order.status');
Route::get('/invoice/download/{id}', [OrderController::class, 'invoice_download'])->name('invoice.download');



// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
