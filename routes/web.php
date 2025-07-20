<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\customer\VerifyController;
use App\Http\Controllers\index\IndexController;
use App\Http\Controllers\IpaymuController;
use App\Http\Controllers\restaurant\RestaurantController;
use App\Models\Migrasi\userMigrasi;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

Route::middleware(['guest'])->get('/', function () { return redirect()->route("index"); });

Route::get('/logout', [IndexController::class,'logout']);

Route::prefix('/')->group(function () {
    /*
        Index Route :
        1. index : consist login & register form
        2. checkLogin : login algrorithm
        3. checkRegister : register algorithm
    */
    Route::middleware(['guest'])->get('index', [IndexController::class,'masterIndex'])->name("index");
    Route::post('checkLogin', [IndexController::class,'checkLogin']);
    Route::post('checkRegister', [IndexController::class,'checkRegister']);
});

Route::prefix('admin')->middleware(['CheckUser:Admin'])->group(function () {
    /*
        Admin Route :
        1. dashboard : summary of sales, order, growth, top 10 restaurant and user activity
        2. customer :  customer list, ban/unban
        3. restaurant : restaurant list, ban/unban
        4. settings : developer post/notification -> will be shown at users notification page
    */

    Route::get('dashboard', [AdminController::class,"masterDashboard"])->name("admin_dashboard");

    Route::prefix('customer')->group(function () {
        Route::get('/', [AdminController::class,"masterCustomer"])->name('admin_customerlist');
        Route::get('banUser/{id}', [AdminController::class,"banUser"]);
        Route::post('search',[AdminController::class,"searchCustomer"]);
    });

    Route::prefix('restaurant')->group(function () {
        Route::get('/', [AdminController::class,"masterRestaurant"])->name('admin_restaurantlist');
        Route::get('banRestaurant/{id}', [AdminController::class,"banRestaurant"]);
        Route::post('search',[AdminController::class,"searchRestaurant"]);
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [AdminController::class,"masterSettings"]);
        Route::get('/deletePost/{id}', [AdminController::class,"deletePost"]);
        Route::post('addPost',[AdminController::class,"addPost"]);
    });

    Route::prefix('analytics')->group(function () {
        Route::get('/', [AdminController::class,"masterAnalytics"]);
    });
});

Route::prefix('customer')->middleware(['CheckUser:Customer'])->group(function () {
    /*
        Customer Route :
        1. home : showcase
        2. explore :  restaurants catalog
        3. favorite : liked restaurants
        4. history : customer's transactions history
        5. profile : customer's profile detail
        6. notification : PorTable notification system
    */
    Route::get('home', [CustomerController::class,"masterHome"])->name("customer_home");
    Route::get('explore', [CustomerController::class,"masterExplore"])->name("customer_search");
    Route::get('favorite', [CustomerController::class,"masterFavorite"])->name("customer_favorite");
    Route::get('history', [CustomerController::class,"masterHistory"])->name("customer_history");
    Route::get('profile', [CustomerController::class,"masterProfile"])->name("customer_profile");
    Route::get('notification', [CustomerController::class,"masterNotification"])->name("customer_notification");

    // PROFILE ROUTES
    // 1. editProfile
    Route::post('editProfile', [CustomerController::class,"editProfile"]);

    // HOME ROUTES
    // 1. checkAvailability
    Route::post('checkAvailability', [CustomerController::class,"checkAvailability"]);
    // 2. register_restaurant
    Route::get('/register_restaurant', [CustomerController::class,"masterRegister"])->name("register_restaurant");
    Route::post('/register_restaurant/do_register', [CustomerController::class,"registerRestaurant"]);

    // EXPLORE ROUTES
    // 1. restaurant detail
    Route::get('restaurant/{restaurant_name}', [CustomerController::class,"masterRestaurant"])->name("customer_restaurant");
    // 2. searchRestaurant
    Route::post('searchRestaurant', [CustomerController::class,"searchRestaurant"]);
    // 3. filterRestaurant
    Route::post('filterRestaurant', [CustomerController::class,"filterRestaurant"]);
    // AJAX IN EXPLORE ROUTES
    // 4. generatePopUp
    Route::get('generateMap', [CustomerController::class,"generateMap"]);
    Route::get('generateForm', [CustomerController::class,"generateForm"]);
    // 5. bookTable
    Route::post('bookTable/{restaurant_id}', [CustomerController::class,"bookTable"]);
    // 6. like_dislike
    Route::get('like_dislike', [CustomerController::class,"like_dislike"]);

    // FAVORITE ROUTES
    Route::post('favorite/searchRestaurant', [CustomerController::class,"favoriteSearch"]);

    // AJAX IN history
    Route::get('cancelTransaction', [CustomerController::class,"cancelTransaction"]);
    Route::get('cancelClosestUpcomingTransaction', [CustomerController::class,"cancelClosestUpcomingTransaction"]);

    // Review Manipulation
    Route::post("/editReview/{restaurantId}", [CustomerController::class, "editReview"]);
    Route::post("/addReview/{restaurantId}", [CustomerController::class, "addReview"]);
});

Route::prefix('restaurant')->middleware(['CheckUser:Restaurant'])->controller(RestaurantController::class)->group(function() {
    Route::get('home', 'getHomePage')->name("restaurant_home");
    Route::get('history', 'getHistoryPage');
    Route::get('statistic', 'getStatisticPage');

    // Interact with reservation orders
    Route::get('getReservations', 'getReservations');
    Route::get('confirm/{id}', 'confirmReservation');
    Route::get('reject/{id}', 'rejectReservation');

    // Interact with available restaurant tables
    Route::get('getTables', 'getRestaurantTables');

    // Interact with reservation histories
    Route::get('getReservationHistory', 'getReservationHistory');
    Route::get('getAllRestaurantHistory', 'getAllRestaurantHistory');
    Route::get('getReservationPagination', 'getReservationPagination');

    // Interact with restaurant statistics
    Route::get('revenue', 'getRestaurantRevenue');
    Route::get('totalRevenue', 'getTotalRevenue');
    Route::get('totalOrder', 'getTotalOrder');
    Route::get('audienceGrowth', 'getAudienceGrowth');

    // Update the restaurant settings
    Route::post('/updateRestaurant', 'updateRestaurant');
});

Route::get('/verify/{token}',[VerifyController::class,'verify'])->name('verify');
