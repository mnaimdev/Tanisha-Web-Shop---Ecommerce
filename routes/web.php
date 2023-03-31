<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
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

// Password Reset
Route::get('/forget/password', [CustomerController::class, 'forget_password'])->name('forget.password');
Route::post('/customer/pass/reset/req', [CustomerController::class, 'customer_pass_reset_req'])->name('customer.pass.reset.req');

Route::get('/customer/pass/reset/form/{token}', [CustomerController::class, 'customer_pass_reset_form']);
Route::post('/customer/pass/reset', [CustomerController::class, 'customer_pass_reset'])->name('customer.pass.reset');


// Email Verify
Route::get('/customer/email/verify/{token}', [CustomerController::class, 'customer_email_verify']);

// Social Login
Route::get('/github/redirect', [GithubController::class, 'github_redirect'])->name('github.redirect');
Route::get('/github/callback', [GithubController::class, 'github_callback'])->name('github.callback');

Route::get('/google/redirect', [GoogleController::class, 'google_redirect'])->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'google_callback'])->name('google.callback');


// Review
Route::post('/review/store', [ReviewController::class, 'review_store'])->name('review.store');


// Search
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/category/product/{category_id}', [FrontendController::class, 'category_product'])->name('category.product');


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

Route::post('/add/user', [UserController::class, 'add_user'])->name('add.user');


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


// Brand
Route::get('/brand', [ProductController::class, 'brand'])->name('brand');
Route::post('/brand/store', [ProductController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/remove/{brand_id}', [ProductController::class, 'brand_remove'])->name('brand.remove');


// Orders
Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
Route::post('/order/status', [OrderController::class, 'order_status'])->name('order.status');
Route::get('/invoice/download/{id}', [OrderController::class, 'invoice_download'])->name('invoice.download');


// Role Management
// Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');

Route::get('/role', [RoleController::class, 'role'])->name('role');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
Route::get('/edit/role/{role_id}', [RoleController::class, 'edit_role'])->name('edit.role');
Route::get('/remove/role/{role_id}', [RoleController::class, 'remove_role'])->name('remove.role');
Route::post('/role/update', [RoleController::class, 'role_update'])->name('role.update');

Route::get('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
Route::post('/user/assign/role', [RoleController::class, 'user_assign_role'])->name('user.assign.role');

Route::get('/remove/user/role/{user_id}', [RoleController::class, 'remove_user_role'])->name('remove.user.role');
Route::get('/user/edit/permission/{user_id}', [RoleController::class, 'user_edit_permission'])->name('user.edit.permission');
Route::post('/update/user/permission', [RoleController::class, 'update_user_permission'])->name('update.user.permission');


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


// Stripe

Route::get('/stripe', [StripePaymentController::class, 'stripe'])->name('stripe');
Route::post('/stripe/post', [StripePaymentController::class, 'stripe_post'])->name('stripe.post');
