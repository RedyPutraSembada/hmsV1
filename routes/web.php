<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IventoryController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomViewController;
use App\Http\Controllers\StayViewController;
use App\Http\Controllers\BreakfastController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccupationController;
use App\Http\Controllers\StatusRoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TravelAgentController;
use App\Http\Controllers\PriceRateTypeController;
use App\Http\Controllers\ProductBuyingController;
use App\Http\Controllers\AdditionalItemController;
use App\Http\Controllers\StatusRateTypeController;
use App\Http\Controllers\TransactionPosController;
use App\Http\Controllers\PastTransactionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\TransactionRoomController;
use App\Http\Controllers\SourceTravelAgentController;



Route::resource('master-data/status-rate-type', StatusRateTypeController::class);
Route::group(['namespace' => 'App\Http\Controllers'], function()
{

    Route::group(['middleware' => ['guest']], function() {
        Route::get('/', function () {
        return view('pages.login.index', ['title' => 'Login']);
        });
        Route::get('auth/login', [LoginController::class, 'index'])->name('login');
        Route::post('auth/authenticate', [LoginController::class, 'login']);

    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/dashboard', [DashboardController::class, 'index']);
        //master data
        Route::resource('master-data/status-room', StatusRoomController::class)->middleware(['can:master.status.room']);
        Route::resource('master-data/breakfast', BreakfastController::class)->middleware(['can:master.breakfest']);
        Route::resource('master-data/role', RoleController::class)->middleware(['can:master.user.role']);
        Route::resource('master-data/room-type', RoomTypeController::class)->middleware(['can:master.type.room']);
        Route::resource('master-data/floor', FloorController::class)->middleware(['can:master.floor']);
        Route::resource('master-data/price-rate-type', PriceRateTypeController::class)->middleware(['can:master.price']);
        Route::resource('master-data/travel-agent', TravelAgentController::class)->middleware(['can:master.travel.agent']);
        Route::resource('master-data/source-travel-agent', SourceTravelAgentController::class)->middleware(['can:master.source.travel.agent']);
        Route::resource('master-data/additional-item', AdditionalItemController::class)->middleware(['can:master.additional.item']);
        Route::resource('master-data/rooms', RoomController::class)->middleware(['can:master.room']);
        Route::resource('master-data/room', RoomController::class)->middleware(['can:master.room']);
        Route::resource('master-data/occupation', AccupationController::class)->middleware(['can:master.occupation']);
        Route::resource('master-data/guest', GuestController::class)->middleware(['can:master.guest']);
        Route::resource('front-office/room-view', RoomViewController::class)->middleware(['can:Front.room.view']);
        Route::resource('front-office/stay-view', StayViewController::class)->middleware(['can:Front.room.view']);
        Route::resource('front-office/Transaction', TransactionRoomController::class)->middleware(['can:Front.room.view']);
        Route::resource('front-office/past-Transaction', PastTransactionController::class)->middleware(['can:Front.room.view']);
        Route::resource('front-office/reservation', ReservationController::class)->middleware(['can:Front.reservation']);
        Route::resource('master-data/users', UserController::class)->middleware(['can:master.user']);
        // Route::get('master-data/guest', [GuestController::class, 'index']);

        //inventory
        Route::resource('iventory', IventoryController::class)->middleware(['can:inventory']);
        Route::post('/iventory/update/{id}', [IventoryController::class, 'update'])->name('iventory.update')->middleware(['can:inventory']);


        //front ofice
        Route::get('front-office/get-stay-view', [StayViewController::class, 'getStayView'])->middleware(['can:Front.stay.view']);
        Route::get('front-office/Transaction/get-total-payment/{id}', [TransactionRoomController::class, 'getTotalPayment'])->middleware(['can:Front.transaction']);

        //pdf
        Route::get('front-office/Transaction/MasterBill/{id}', [PdfController::class, 'MasterBill'])->middleware(['can:Front.transaction']);
        Route::get('front-office/Transaction/Receipt/{id}', [PdfController::class, 'Receipt'])->middleware(['can:Front.transaction']);
        Route::get('front-office/Transaction/Bill/{id}', [PdfController::class, 'Bill'])->middleware(['can:Front.transaction']);
        Route::get('front-office/Transaction/DownloadMasterBill/{id}', [PdfController::class, 'MakePdfMasterBill'])->middleware(['can:Front.transaction']);
        Route::get('front-office/Transaction/DownloadReceipt/{id}', [PdfController::class, 'MakePdfReceipt'])->middleware(['can:Front.transaction']);
        Route::get('front-office/Transaction/DownloadBill/{id}', [PdfController::class, 'MakePdfBill'])->middleware(['can:Front.transaction']);
        Route::get('/past-transaction/download', [PastTransactionController::class, 'downloadReportPDF'])->name('past-transaction.download')->middleware(['can:Front.transaction']);

        Route::get('front-office/reservation/getDataWhereRoom/{id}', [ReservationController::class, 'getDataWhereRoom'])->middleware(['can:Front.reservation']);
        Route::get('front-office/reservation/getDataWhereTypeRoom/{id}', [ReservationController::class, 'getDataWhereTypeRoom'])->middleware(['can:Front.reservation']);
        Route::post('front-office/reservation/pay-transaction/{id}', [ReservationController::class, 'PayTransaction'])->middleware(['can:Front.reservation']);

        Route::get('front-office/room-view/checkin_booking/{id}', [TransactionRoomController::class, 'checkin_booking'])->name('checkin_booking')->middleware(['can:Front.room.view']);
        Route::get('front-office/room-view/booking/{id}', [BookingController::class, 'booking'])->name('booking')->middleware(['can:Front.room.view']);
        Route::post('front-office/room-view/store', [RoomViewController::class, 'store'])->middleware(['can:Front.room.view']);
        Route::get('front-office/room-view/check-in/{id}', [RoomViewController::class, 'checkIn'])->name('check-in')->middleware(['can:Front.room.view']);
        Route::post('front-office/room-view/hitung', [RoomViewController::class, 'hitung'])->name('hitung')->middleware(['can:Front.room.view']);
        Route::get('front-office/room-view/getTravelAgent/{id}', [RoomViewController::class, 'getTravelAgent'])->name('getTravelAgent')->middleware(['can:Front.room.view']);
        Route::get('/get-room-amenities/{id}', [ReservationController::class, 'getRoomAmenities'])->middleware(['can:Front.room.view']);

        Route::post('front-office/booking/store', [BookingController::class, 'store'])->middleware(['can:Front.room.view']);
        Route::post('front-office/booking/hitung', [BookingController::class, 'hitung'])->name('hitung')->middleware(['can:Front.room.view']);
        Route::get('front-office/booking/getTravelAgent/{id}', [BookingController::class, 'getTravelAgent'])->name('getTravelAgent')->middleware(['can:Front.room.view']);


        //chechin/checkout
        Route::post('/checkout/{id}', [TransactionRoomController::class, 'checkout'])->name('checkout')->middleware(['can:Front.room.view']);
        Route::get('checkin/{id}', [TransactionRoomController::class, 'show'])->name('checkin.booking')->middleware(['can:Front.room.view']);
        Route::get('checkin-booking/{id}', [TransactionRoomController::class, 'checkinbooking'])->name('booking.pay')->middleware(['can:Front.room.view']);
        Route::get('detail-transaksi/{id}', [TransactionRoomController::class, 'detail'])->name('detail.transaction')->middleware(['can:Front.transaction']);



        //! POS
        Route::resource('pos/product', ProductController::class)->middleware(['can:pos']);
        Route::resource('pos/product-category', ProductCategoryController::class)->middleware(['can:pos']);
        Route::resource('pos/product-for-buying', ProductBuyingController::class)->middleware(['can:pos']);
        Route::resource('pos/Transaction', TransactionPosController::class)->middleware(['can:pos']);
        Route::get('/menu', [ProductBuyingController::class, 'menu'])->middleware(['can:pos']);
        Route::get('/menu/{id}', [ProductBuyingController::class, 'menuAdd'])->middleware(['can:pos']);
        Route::get('/menuRemove/{id}', [ProductBuyingController::class, 'menuRemove'])->middleware(['can:pos']);
        Route::get('/transaction', [ProductBuyingController::class, 'transaction'])->middleware(['can:pos']);
        Route::post('/transaction', [ProductBuyingController::class, 'transactionPos'])->middleware(['can:pos']);

        // logout
        Route::post('/logout', [LogoutController::class, 'perform']);
    });
});
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
    return view('pages.login.index', ['title' => 'Login']);
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('master-data/status-room', StatusRoomController::class);
Route::resource('master-data/breakfast', BreakfastController::class);
Route::resource('master-data/role', RoleController::class);
Route::resource('master-data/room-type', RoomTypeController::class);
Route::resource('master-data/floor', FloorController::class);
Route::resource('master-data/price-rate-type', PriceRateTypeController::class);
Route::resource('master-data/travel-agent', TravelAgentController::class);
Route::resource('master-data/source-travel-agent', SourceTravelAgentController::class);
Route::resource('master-data/additional-item', AdditionalItemController::class);
Route::resource('master-data/room', RoomController::class);
Route::resource('master-data/occupation', AccupationController::class);
Route::resource('master-data/guest', GuestController::class);
Route::resource('master-data/users', UserController::class);
// Route::get('master-data/guest', [GuestController::class, 'index']);

Route::resource('front-office/room-view', RoomViewController::class);

Route::resource('front-office/stay-view', StayViewController::class);
Route::get('front-office/get-stay-view', [StayViewController::class, 'getStayView']);
Route::resource('front-office/Transaction', TransactionRoomController::class);
Route::get('front-office/Transaction/get-total-payment/{id}', [TransactionRoomController::class, 'getTotalPayment']);
Route::post('/checkout/{id}', [TransactionRoomController::class, 'checkout'])->name('checkout');
Route::get('front-office/room-view/checkin_booking/{id}', [TransactionRoomController::class, 'checkin_booking'])->name('checkin_booking');
Route::get('checkin/{id}', [TransactionRoomController::class, 'show'])->name('checkin.booking');
Route::get('checkin-booking/{id}', [TransactionRoomController::class, 'checkinbooking'])->name('booking.pay');
Route::get('detail-transaksi/{id}', [TransactionRoomController::class, 'detail'])->name('detail.transaction');
Route::get('/get-room-amenities/{id}', [ReservationController::class, 'getRoomAmenities']);

Route::resource('front-office/reservation', ReservationController::class);
Route::get('front-office/reservation/cancel/{id}', [ReservationController::class, 'cancel']);
Route::get('front-office/reservation/getDataWhereRoom/{id}', [ReservationController::class, 'getDataWhereRoom']);
Route::post('front-office/reservation/pay-transaction/{id}', [ReservationController::class, 'PayTransaction']);
//? Registrasi
Route::put('front-office/registrasion/{id}', [ReservationController::class, 'registrasion'])->name('registrasion.submit');
Route::get('front-office/registrasion', [ReservationController::class, 'RegistrasionIndex'])->name('registrasion.index');
Route::get('front-office/departure', [ReservationController::class, 'Departure'])->name('departure.index');

Route::get('front-office/room-view/booking/{id}', [BookingController::class, 'booking'])->name('booking');
Route::post('front-office/booking/store', [BookingController::class, 'store']);
Route::post('front-office/booking/hitung', [BookingController::class, 'hitung'])->name('hitung');
Route::get('front-office/booking/getTravelAgent/{id}', [BookingController::class, 'getTravelAgent'])->name('getTravelAgent');
Route::get('front-office/booking/getTravelAgent/{id}', [BookingController::class, 'getTravelAgent'])->name('getTravelAgent');

Route::post('front-office/room-view/store', [RoomViewController::class, 'store']);
Route::get('front-office/room-view/check-in/{id}', [RoomViewController::class, 'checkIn'])->name('check-in');
Route::post('front-office/room-view/hitung', [RoomViewController::class, 'hitung'])->name('hitung');
Route::get('front-office/room-view/getTravelAgent/{id}', [RoomViewController::class, 'getTravelAgent'])->name('getTravelAgent');
Route::get('front-office/isiRegistrasion', function () {
    return view('pages.registrasion.create', ['title' => 'Registrasi Baru']);
})->name('getTravelAgent');
//! POS
Route::resource('pos/product', ProductController::class);
Route::resource('pos/product-category', ProductCategoryController::class);
Route::resource('pos/product-for-buying', ProductBuyingController::class);
Route::resource('pos/Transaction', TransactionPosController::class);
Route::get('/menu', [ProductBuyingController::class, 'menu']);
Route::get('/menu/{id}', [ProductBuyingController::class, 'menuAdd']);
Route::get('/menuRemove/{id}', [ProductBuyingController::class, 'menuRemove']);
Route::get('/transaction', [ProductBuyingController::class, 'transaction']);
Route::post('/transaction', [ProductBuyingController::class, 'transactionPos']);





