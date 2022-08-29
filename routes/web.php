<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Admin\Main;
use App\Http\Controllers\My_library;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\EmailController;

// use App\Models\M_module;

$prefix_fo = request()->segment(1);
Route::get('kirim-email', [EmailController::class, 'index'])->name('kirim-email');

######### FO ##########
Route::group([
    'prefix' => '/',
    'as' => 'web.',
    // 'middleware' => ['web', 'validasi_req_token'],  //iki durung gawe filter login fo
    'middleware' => ['web'],  //iki durung gawe filter login fo
], function (){
    Route::get('/', [\App\Http\Controllers\Web\Home::class, 'index'])->name('index');


    #### EMAIL ####
    Route::group([
        'prefix' => 'mail',
        'as' => 'mail.',
    ], function (){
        Route::get('/send_email_link_upload', [MailController::class, 'send_email_link_upload'])->name('send_email_link_upload');
    });

    /** AUTH */
    Route::group([
        'prefix' => 'auth',
        'as' => 'auth.',
    ], function (){
        // Route::post('/authenticate', [App\Http\Controllers\Web\CheckIn::class, 'authenticate'])->name('authenticate');
        // Route::post('/authenticate_booking', [App\Http\Controllers\Web\CheckIn::class, 'authenticate_booking'])->name('authenticate_booking');
        // Route::post('/checkin', [App\Http\Controllers\Web\CheckIn::class, 'checkin'])->name('checkin');
        // Route::post('/authenticate_out', [App\Http\Controllers\Web\CheckOut::class, 'authenticate_out'])->name('authenticate_out');
        // Route::post('/authenticate_out_bypass', [App\Http\Controllers\Web\CheckOut::class, 'authenticate_out_bypass'])->name('authenticate_out_bypass');
        // Route::post('/checkout', [App\Http\Controllers\Web\CheckOut::class, 'chm_menu_boeckout'])->name('checkout');
    });

});

Route::group([
    'prefix' => 'booking',
    'as' => 'booking.',
    // 'middleware' => ['web', 'validasi_req_token'],  //iki durung gawe filter login fo
    // 'middleware' => ['web'],  //iki durung gawe filter login fo
], function (){
    Route::get('/jadwal/', [BookingController::class, 'jadwal'])->name('jadwal');
    Route::get('/payment-manual/', [BookingController::class, 'formUploadPembayaran'])->name('payment-manual');
    Route::post('/get-jam', [BookingController::class, 'getJam'])->name('get-jam');
    Route::get('/konfirmasi-data-diri/', [BookingController::class, 'konfirmasiDataDiri'])->name('konfirmasi-data-diri');

    Route::post('/save-reservasi', [BookingController::class, 'saveReservasi'])->name('save-reservasi');
    Route::post('/save-pembayaran', [BookingController::class, 'savePembayaran'])->name('save-pembayaran');
    Route::get('/after-payment/{id}', [BookingController::class, 'afterPayment'])->name('after-payment');

    Route::get('/coba', [BookingController::class, 'jajalEmail'])->name('coba');
});

######### END FO ##########

Route::get('/admin/login', [Auth::class, 'login'])->name('login');
Route::post('/admin/authenticate', [Auth::class, 'authenticate'])->name('authenticate');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['ceklogin_bo','web'],
], function (){
    Route::get('/', [Main::class, 'index'])->name('main');
    Route::get('/edit_profile', [Main::class, 'edit_profile'])->name('edit_profile');
    Route::post('/edit_profile', [Main::class, 'edit_profile_post'])->name('edit_profile_post');
    Route::get('/logout', [Auth::class, 'logout'])->name('logout');

    Route::group([
        'prefix' => 't_content',
        'as' => 't_content.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\T_content_management::class, 'index'])->name('index');
        Route::get('/set_content', [\App\Http\Controllers\Admin\T_content_management::class, 'set_content'])->name('set_content');
        Route::post('/save', [\App\Http\Controllers\Admin\T_content_management::class, 'save'])->name('save');
        Route::post('/save_set_content', [\App\Http\Controllers\Admin\T_content_management::class, 'save_set_content'])->name('save_set_content');
        Route::get('/edit', [\App\Http\Controllers\Admin\T_content_management::class, 'edit'])->name('edit');
        Route::post('/add_modal', [\App\Http\Controllers\Admin\T_content_management::class, 'add_modal'])->name('add_modal');
        Route::post('/load_user_group', [\App\Http\Controllers\Admin\T_content_management::class, 'load_user_group'])->name('load_user_group');
        Route::post('/load_menu', [\App\Http\Controllers\Admin\T_content_management::class, 'load_menu'])->name('load_menu');
        Route::post('/datatable', [\App\Http\Controllers\Admin\T_content_management::class, 'datatable'])->name('datatable');
        Route::post('/dynamic_field', [\App\Http\Controllers\Admin\T_content_management::class, 'dynamic_field'])->name('dynamic_field');
        Route::post('/edit_modal_order', [\App\Http\Controllers\Admin\T_content_management::class, 'edit_modal_order'])->name('edit_modal_order');
        Route::post('/edit_modal_content', [\App\Http\Controllers\Admin\T_content_management::class, 'edit_modal_content'])->name('edit_modal_content');
        Route::post('/edit_modal', [\App\Http\Controllers\Admin\T_content_management::class, 'edit_modal'])->name('edit_modal');
        Route::post('/update_data_order', [\App\Http\Controllers\Admin\T_content_management::class, 'update_data_order'])->name('update_data_order');
        Route::post('/update_data_content', [\App\Http\Controllers\Admin\T_content_management::class, 'update_data_content'])->name('update_data_content');
        Route::post('/delete_content_det', [\App\Http\Controllers\Admin\T_content_management::class, 'delete_content_det'])->name('delete_content_det');
        Route::post('/update', [\App\Http\Controllers\Admin\T_content_management::class, 'update'])->name('update');
        Route::post('/update_user_group', [\App\Http\Controllers\Admin\T_content_management::class, 'update_user_group'])->name('update_user_group');
        Route::post('/delete', [\App\Http\Controllers\Admin\T_content_management::class, 'delete'])->name('delete');
        Route::post('/user_group_modal', [\App\Http\Controllers\Admin\T_content_management::class, 'user_group_modal'])->name('user_group_modal');
    });


    /**
     * master user group bo
     */
    Route::group([
        'prefix' => 'm_user_group_bo',
        'as' => 'm_user_group_bo.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Master_user_group_bo::class, 'index'])->name('index');
        Route::get('/add', [\App\Http\Controllers\Admin\Master_user_group_bo::class, 'add'])->name('add');
        Route::post('/save', [\App\Http\Controllers\Admin\Master_user_group_bo::class, 'save'])->name('save');
        Route::get('/edit', [\App\Http\Controllers\Admin\Master_user_group_bo::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\Master_user_group_bo::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\Master_user_group_bo::class, 'delete'])->name('delete');
        Route::post('/datatable', [\App\Http\Controllers\Admin\Master_user_group_bo::class, 'datatable'])->name('datatable');
        Route::get('/manage', [\App\Http\Controllers\Admin\Master_user_group_bo::class, 'manage'])->name('manage');
        Route::post('/manage', [\App\Http\Controllers\Admin\Master_user_group_bo::class, 'manage_post'])->name('manage_post');

        // Route::get('/open_modal_setting', [\App\Http\Controllers\Admin\Master_user_group::class, 'open_modal_setting'])->name('open_modal_setting');
        // Route::post('/save_modal_setting', [\App\Http\Controllers\Admin\Master_user_group::class, 'save_modal_setting'])->name('save_modal_setting');
        // Route::post('/set_exist_branch', [\App\Http\Controllers\Admin\Master_user_group::class, 'set_exist_branch'])->name('set_exist_branch');
    });

    /**
     * master user bo
     */
    Route::group([
        'prefix' => 'm_user_bo',
        'as' => 'm_user_bo.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Master_user_bo::class, 'index'])->name('index');
        Route::get('/add', [\App\Http\Controllers\Admin\Master_user_bo::class, 'add'])->name('add');
        Route::post('/save', [\App\Http\Controllers\Admin\Master_user_bo::class, 'save'])->name('save');
        Route::get('/edit', [\App\Http\Controllers\Admin\Master_user_bo::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\Master_user_bo::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\Master_user_bo::class, 'delete'])->name('delete');
        Route::post('/datatable', [\App\Http\Controllers\Admin\Master_user_bo::class, 'datatable'])->name('datatable');
        Route::get('/manage', [\App\Http\Controllers\Admin\Master_user_bo::class, 'manage'])->name('manage');
        Route::post('/manage', [\App\Http\Controllers\Admin\Master_user_bo::class, 'manage_post'])->name('manage_post');
    });

    /**
     * master user bo
     */
    Route::group([
        'prefix' => 'm_menu_bo',
        'as' => 'm_menu_bo.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'index'])->name('index');
        Route::get('/add', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'add'])->name('add');
        Route::post('/save', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'save'])->name('save');
        Route::get('/edit', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'delete'])->name('delete');
        Route::post('/datatable', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'datatable'])->name('datatable');
        // Route::get('/manage', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'manage'])->name('manage');
        // Route::post('/manage', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'manage_post'])->name('manage_post');
    });

    /**
     * master harga
     */
    Route::group([
        'prefix' => 'm_harga',
        'as' => 'm_harga.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Master_harga::class, 'index'])->name('index');
        Route::get('/add', [\App\Http\Controllers\Admin\Master_harga::class, 'add'])->name('add');
        Route::post('/save', [\App\Http\Controllers\Admin\Master_harga::class, 'save'])->name('save');
        Route::get('/edit', [\App\Http\Controllers\Admin\Master_harga::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\Master_harga::class, 'update'])->name('update');
        Route::post('/nonaktif', [\App\Http\Controllers\Admin\Master_harga::class, 'nonaktif'])->name('nonaktif');
        Route::post('/datatable', [\App\Http\Controllers\Admin\Master_harga::class, 'datatable'])->name('datatable');
    });

     /**
     * master interval
     */
    Route::group([
        'prefix' => 'm_interval',
        'as' => 'm_interval.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Master_interval::class, 'index'])->name('index');
        Route::get('/add', [\App\Http\Controllers\Admin\Master_interval::class, 'add'])->name('add');
        Route::post('/save', [\App\Http\Controllers\Admin\Master_interval::class, 'save'])->name('save');
        Route::get('/edit', [\App\Http\Controllers\Admin\Master_interval::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\Master_interval::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\Master_interval::class, 'delete'])->name('delete');
        Route::post('/datatable', [\App\Http\Controllers\Admin\Master_interval::class, 'datatable'])->name('datatable');
    });


    /**
     * Transaksi Reservasi
     */
    Route::group([
        'prefix' => 't_reservasi',
        'as' => 't_reservasi.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\T_reservasi_controller::class, 'index'])->name('index');
        Route::post('/detail_modal', [\App\Http\Controllers\Admin\T_reservasi_controller::class, 'detail_modal'])->name('detail_modal');
        Route::post('/verifikasi_modal', [\App\Http\Controllers\Admin\T_reservasi_controller::class, 'verifikasi_modal'])->name('verifikasi_modal');
        Route::post('/datatable', [\App\Http\Controllers\Admin\T_reservasi_controller::class, 'datatable'])->name('datatable');
        Route::post('/verifikasi', [\App\Http\Controllers\Admin\T_reservasi_controller::class, 'verifikasi'])->name('verifikasi');

        Route::get('/add', [\App\Http\Controllers\Admin\T_reservasi_controller::class, 'add'])->name('add');
        Route::post('/update', [\App\Http\Controllers\Admin\T_reservasi_controller::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\T_reservasi_controller::class, 'delete'])->name('delete');
        // Route::get('/manage', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'manage'])->name('manage');
        // Route::post('/manage', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'manage_post'])->name('manage_post');
    });

    /**
     * transaksi jadwal rutin
     */
    Route::group([
        'prefix' => 't_jadwal_rutin',
        'as' => 't_jadwal_rutin.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Trans_jadwal_rutin::class, 'index'])->name('index');
        Route::get('/add', [\App\Http\Controllers\Admin\Trans_jadwal_rutin::class, 'add'])->name('add');
        Route::post('/save', [\App\Http\Controllers\Admin\Trans_jadwal_rutin::class, 'save'])->name('save');
        Route::post('/edit_modal', [\App\Http\Controllers\Admin\Trans_jadwal_rutin::class, 'edit_modal'])->name('edit_modal');
        Route::post('/update', [\App\Http\Controllers\Admin\Trans_jadwal_rutin::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\Trans_jadwal_rutin::class, 'delete'])->name('delete');
        Route::post('/datatable', [\App\Http\Controllers\Admin\Trans_jadwal_rutin::class, 'datatable'])->name('datatable');
        // Route::get('/manage', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'manage'])->name('manage');
        // Route::post('/manage', [\App\Http\Controllers\Admin\Master_menu_bo::class, 'manage_post'])->name('manage_post');
    });

    /**
     * Transaksi Reservasi
     */
    Route::group([
        'prefix' => 't_pembayaran',
        'as' => 't_pembayaran.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Trans_pembayaran::class, 'index'])->name('index');
        Route::post('/detail_modal', [\App\Http\Controllers\Admin\Trans_pembayaran::class, 'detail_modal'])->name('detail_modal');
        Route::post('/verifikasi_modal', [\App\Http\Controllers\Admin\Trans_pembayaran::class, 'verifikasi_modal'])->name('verifikasi_modal');
        Route::post('/datatable', [\App\Http\Controllers\Admin\Trans_pembayaran::class, 'datatable'])->name('datatable');
        Route::post('/verifikasi', [\App\Http\Controllers\Admin\Trans_pembayaran::class, 'verifikasi'])->name('verifikasi');

        Route::get('/add', [\App\Http\Controllers\Admin\Trans_pembayaran::class, 'add'])->name('add');
        Route::post('/update', [\App\Http\Controllers\Admin\Trans_pembayaran::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\Trans_pembayaran::class, 'delete'])->name('delete');
    });
});

Route::post('load_state_indonesia', [My_library::class, 'load_state_indonesia'])->name('load_state_indonesia');
Route::post('load_states', [My_library::class, 'load_states'])->name('load_states');
Route::post('load_cities', [My_library::class, 'load_cities'])->name('load_cities');
Route::post('load_kota', [My_library::class, 'load_kota'])->name('load_kota');
Route::post('load_branch', [My_library::class, 'load_branch'])->name('load_branch');
Route::post('load_branch_company', [My_library::class, 'load_branch_company'])->name('load_branch_company');
Route::post('load_business_field', [My_library::class, 'load_business_field'])->name('load_business_field');
Route::post('load_education_type', [My_library::class, 'load_education_type'])->name('load_education_type');
Route::post('load_profession', [My_library::class, 'load_profession'])->name('load_profession');
Route::post('load_dept', [My_library::class, 'load_dept'])->name('load_dept');
Route::post('load_division', [My_library::class, 'load_division'])->name('load_division');
Route::post('load_kecamatan', [My_library::class, 'load_kecamatan'])->name('load_kecamatan');
Route::post('load_kelurahan', [My_library::class, 'load_kelurahan'])->name('load_kelurahan');
Route::post('load_all_provinsi', [My_library::class, 'load_all_provinsi'])->name('load_all_provinsi');
Route::post('reload_captcha', [My_library::class, 'reload_captcha'])->name('reload_captcha');
