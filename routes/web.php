<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Admin\Main;
use App\Http\Controllers\My_library;


// use App\Models\M_module;

$prefix_fo = request()->segment(1);


Route::group([
    'prefix' => '/',
    'as' => 'web.',
    // 'middleware' => ['web', 'validasi_req_token'],  //iki durung gawe filter login fo
    'middleware' => ['web'],  //iki durung gawe filter login fo
], function (){
    Route::get('/', [\App\Http\Controllers\Web\Home::class, 'index'])->name('index');
    // Route::get('/homepage', [App\Http\Controllers\Web\Home::class, 'homepage'])->name('homepage');
    // Route::get('/content', [App\Http\Controllers\Web\Home::class, 'content'])->name('content');
    // Route::get('/search_docs', [App\Http\Controllers\Web\Home::class, 'search_docs'])->name('search_docs');
    // Route::get('/show_pdf', [App\Http\Controllers\Web\Home::class, 'show_pdf'])->name('show_pdf');

    Route::group([
        'prefix' => 'reservation',
        'as' => 'reservation.',
    ], function (){
        Route::get('/wizard', [\App\Http\Controllers\Web\Reservation::class, 'wizard'])->name('wizard');
        // Route::post('/authenticate_booking', [App\Http\Controllers\Web\CheckIn::class, 'authenticate_booking'])->name('authenticate_booking');
        // Route::post('/checkin', [App\Http\Controllers\Web\CheckIn::class, 'checkin'])->name('checkin');
        // Route::post('/authenticate_out', [App\Http\Controllers\Web\CheckOut::class, 'authenticate_out'])->name('authenticate_out');
        // Route::post('/authenticate_out_bypass', [App\Http\Controllers\Web\CheckOut::class, 'authenticate_out_bypass'])->name('authenticate_out_bypass');
        // Route::post('/checkout', [App\Http\Controllers\Web\CheckOut::class, 'checkout'])->name('checkout');
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
        // Route::post('/checkout', [App\Http\Controllers\Web\CheckOut::class, 'checkout'])->name('checkout');
    });

});

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
     * master user group fo
     */
    Route::group([
        'prefix' => 'm_user_group',
        'as' => 'm_user_group.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Master_user_group::class, 'index'])->name('index');
        Route::get('/add', [\App\Http\Controllers\Admin\Master_user_group::class, 'add'])->name('add');
        Route::post('/save', [\App\Http\Controllers\Admin\Master_user_group::class, 'save'])->name('save');
        Route::get('/edit', [\App\Http\Controllers\Admin\Master_user_group::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\Master_user_group::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\Master_user_group::class, 'delete'])->name('delete');
        Route::post('/datatable', [\App\Http\Controllers\Admin\Master_user_group::class, 'datatable'])->name('datatable');
        Route::get('/manage', [\App\Http\Controllers\Admin\Master_user_group::class, 'manage'])->name('manage');
        Route::post('/manage', [\App\Http\Controllers\Admin\Master_user_group::class, 'manage_post'])->name('manage_post');

        // Route::get('/open_modal_setting', [\App\Http\Controllers\Admin\Master_user_group::class, 'open_modal_setting'])->name('open_modal_setting');
        // Route::post('/save_modal_setting', [\App\Http\Controllers\Admin\Master_user_group::class, 'save_modal_setting'])->name('save_modal_setting');
        // Route::post('/set_exist_branch', [\App\Http\Controllers\Admin\Master_user_group::class, 'set_exist_branch'])->name('set_exist_branch');
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
