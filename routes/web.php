<?php
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
Route::get('user/verify/{tablename}/{email}','UserController@verifyUser')->name('verify-email');

Route::get('admin/privacy-policy/index', function () {
    return view('admin.privacy-policy.index');
});
Route::get('admin/terms-condition/index', function () {
    return view('admin.terms-condition.index');
});

Route::middleware(['logging:web'])->group(function () {

    Route::get('/','HomeController@index')->name('home');

    Route::prefix('admin')->group(function () {

        Route::group(['middleware' => ['guest']], function () {
    
            Route::match(['get','post'],'login','Admin\AdminController@login')->name('admin.login');
            Route::match(['get','post'],'forgot-password','Admin\AdminController@forgotPassword')->name('admin.forgot-password');
            Route::match(['get','post'],'reset-password/{tablename}/{email}','UserController@resetPassword')->name('user-password-reset');
        
        });
        
        Route::post('upgrade-subscription','Admin\SubscriptionController@upgradePackage')->name('admin.upgrade-package');

        Route::group(['middleware' => ['auth:web']], function () {
            
            Route::get('faq-content','Admin\AdminFaqController@index')->name('admin-faq-index');
            Route::post('faq-content','Admin\AdminFaqController@store')->name('admin.save-faq');
            Route::post('admin-faq-delete','Admin\AdminFaqController@faqDelete')->name('admin-faq-delete');

            Route::post('app-content/update','Admin\AdminContentController@update')->name('admin-content-update');
            Route::get('app-content','Admin\AdminContentController@index')->name('admin-content-index');
            Route::get('app-content/edit-content','Admin\AdminContentController@editContent')->name('admin-content-edit');

            Route::get('dashboard','Admin\DashboardController@index')->name('admin.dashboard');
            Route::get('sr-kpi-targets','Admin\DashboardController@getSRKpiTargets')->name('admin.dashboard.kpi-targets');
            Route::get('dashboard/leader-board','Admin\DashboardController@getLeaderBoard')->name('admin.dashboard.leader-board');
            Route::get('dashboard/knock-time-chart','Admin\DashboardController@getUserKnockTime')->name('admin.dashboard.knock-time');
            Route::get('dashboard/knock-day-chart','Admin\DashboardController@getUserKnockDay')->name('admin.dashboard.knock-day');
            Route::get('dashboard/kpi-group-performance','Admin\DashboardController@getKpiGroupPerformance')->name('admin.dashboard.kpi-group-performance');
            Route::get('dashboard/metric-group-performance','Admin\DashboardController@getMetricPerformance')->name('admin.dashboard.metric-performance');
            Route::get('dashboard/team-performance','Admin\DashboardController@getTeamPerformance')->name('admin.dashboard.team-performance');
            Route::get('dashboard/top-widget','Admin\DashboardController@topWidget')->name('admin.dashboard.top-widget');
            Route::get('dashboard/territory-performance','Admin\DashboardController@territoryPerforamance')->name('admin.dashboard.territory-performance');

            Route::match(['get','post'],'company-sales','Admin\CompanySalesController@index')
				          ->name('admin.company-sales')->middleware(['web_user_permission:company-sales']);

            Route::post('change-password','Admin\AdminController@changePassword')->name('admin.change-password');
            Route::post('update-profile','Admin\AdminController@updateProfile')->name('admin.update-profile');

            Route::match(['get','post'],'add-user','Admin\UserController@addUser')
                ->name('admin.add-user')->middleware(['user_permission:manage_user']);

            Route::post('edit-user/{id}','Admin\UserController@updateUser')
                ->name('admin.update-user')->middleware(['user_permission:manage_user']);

            Route::post('user-pin/export-data','Admin\UserPinController@exportData')->name('admin.userpins.export');
            Route::post('user-pin/export-file','Admin\UserPinController@exportDeleteFile')->name('admin.userpins.delete-export-file');
            Route::post('user/pins','Admin\UserPinController@ajaxListing')->name('admin.userpins.list');
            Route::match(['get','post'],'add-pin','Admin\UserPinController@addPin')->name('admin.add-pin');
            Route::get('user-pin','Admin\UserPinController@index')->name('admin.user-pin');
            Route::match(['get','post'],'user-pin/edit/{id}','Admin\UserPinController@editPin')->name('admin.user-pin.update');
            Route::post('user-pin/delete','Admin\UserPinController@deletePin')->name('admin.user-pin.delete');

            Route::get('map','Admin\MapController@index')->name('admin.map');
            Route::get('map/get-pins','Admin\MapController@getPins')->name('admin.map.getPins');
            Route::post('territory/save','Admin\MapController@saveTerritory')->name('admin.territory.save');
            Route::get('territory/get','Admin\MapController@getTerritory')->name('admin.territory.get');
            Route::post('territory/update','Admin\MapController@updateTerritory')->name('admin.territory.update');
            Route::post('territory/delete','Admin\MapController@territoryDelete')->name('admin.territory.delete');

            Route::match(['get','post'],'add-appointment','Admin\AppointmentController@addAppointment')->name('admin.add-appointment');
            Route::match(['get','post'],'edit-appointment','Admin\AppointmentController@editAppointment')->name('admin.edit-appointment');
            Route::get('calendar','Admin\AppointmentController@index')->name('admin.calender');

            Route::match(['get','post'],'add-status','Admin\StatusController@addStatus')
                ->name('admin.add-status')->middleware(['web_user_permission:status']);
            Route::match(['get','post','delete'],'edit-status','Admin\StatusController@editStatus')
                ->name('admin.edit-status')->middleware(['web_user_permission:status']);
            Route::get('statuses','Admin\StatusController@index')
                ->name('admin.statuses')->middleware(['web_user_permission:status']);
            
            Route::match(['get','post'],'add-team','Admin\TeamController@addTeam')
                ->name('admin.add-team')->middleware(['web_user_permission:team']);
            Route::match(['get','post','delete'],'edit-team','Admin\TeamController@editTeam')
                ->name('admin.edit-team')->middleware(['web_user_permission:team']);
            Route::get('team','Admin\TeamController@index')
                ->name('admin.team')->middleware(['web_user_permission:team']);  
                
            Route::get('chat','Admin\ChatController@index')->name('admin.chat');

            Route::get('user/suggestion','Admin\UserController@userSuggestion')->name('admin.user.suggestion');
            Route::get('user/leader-board','Admin\UserController@leaderBoard')->name('admin.leader-board');

            Route::get('user/manage','Admin\UserController@manageUser')
                ->name('admin.manage-user')->middleware(['web_user_permission:manage_user']);
            Route::get('user/manage/{id}','Admin\UserController@editUser')
                ->name('admin.manage-user.edit')->middleware(['web_user_permission:manage_user']);

            Route::get('faq','Admin\FaqController@index')->name('admin.faq');

            Route::get('user/account-details','Admin\UserController@accountDetail')
                ->name('admin.account-details')->middleware(['web_user_permission:account-detail']);

            Route::get('custom-fields','Admin\CustomFieldsController@index')
                ->name('admin.custom-fields')->middleware(['web_user_permission:custom_field']);
            Route::post('custom-fields','Admin\CustomFieldsController@addCustomField')
                ->name('admin.add-custom-fields')->middleware(['web_user_permission:custom_field']);
            Route::post('custom-fields/delete','Admin\CustomFieldsController@deleteCustomField')
                ->name('admin.delete-custom-fields')->middleware(['web_user_permission:custom_field']);

            Route::get('history-data','Admin\ImportHistoryController@history')
                ->name('admin.history-data')->middleware(['web_user_permission:import_pin']);
            
            Route::get('import-history','Admin\ImportHistoryController@index')
                ->name('admin.import-history')->middleware(['web_user_permission:import_pin']);

            Route::post('get-import-data','Admin\ImportHistoryController@getImportData')
                ->name('admin.get-import-data')
                ->middleware(['web_user_permission:import_pin']);

            Route::post('get-import-step3','Admin\ImportHistoryController@getImportStep3')->name('admin.get-import-data')
                ->middleware(['web_user_permission:import_pin']);

            Route::post('get-import-step4','Admin\ImportHistoryController@getImportStep4')->name('admin.get-import-data')
                ->middleware(['web_user_permission:import_pin']);
			
            Route::get('user-track/dates','Admin\UserTrackController@getTrackingDates');    
			Route::get('user-track','Admin\UserTrackController@index')
				->name('admin.user-track')->middleware(['web_user_permission:user-track']);
			Route::get('user-track/data','Admin\UserTrackController@getUserTrackingData')
				->name('admin.user-track-data')->middleware(['web_user_permission:user-track']);
			
            Route::get('company','Admin\UserController@companyListing')->name('admin.user.company');  
            Route::post('company/store','Admin\UserController@companyStore')->name('admin.store-company');  

            Route::get('team-lead','Admin\UserController@teamLeadListing')->name('admin.user.team-lead');  
            
            Route::get('sale-reps','Admin\UserController@saleRepsListing')->name('admin.user.sale-reps');    
            
            Route::post('update-user','Admin\UserController@updateAllUser')->name('admin.update-all-user');

            Route::get('subscription','Admin\SubscriptionController@index')->name('admin.subscription.index');    
            Route::post('subscription/update','Admin\SubscriptionController@update')->name('admin.subscription.update');    

            Route::get('package','Admin\PackageController@index')->name('admin.package.index');
            Route::get('transactions','Admin\TransactionsController@index')->name('admin.transactions.index');

            Route::get('logout','Admin\AdminController@logout')->name('admin.logout');
            
        });
    
    });

});





