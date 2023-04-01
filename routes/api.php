<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('page/{name}','Api\AppContentController@index');

Route::post('company-register','Api\CompanyController@register');

Route::group(['middleware' => ['ApiAuthorization']], function () {
    //users api routes
    Route::post('user/subscribe','Api\UserController@userSubscribe');
    Route::post('user/login','Api\UserController@login');
    Route::post('user/forgot-password','Api\UserController@forgotPassword');
    Route::post('user/change-password','Api\UserController@changePassword')->middleware(['auth:api']);
    Route::post('user/social','Api\UserController@socialLogin');
    Route::post('user/logout','Api\UserController@logout')->middleware(['auth:api']);
    Route::get('user/leader-board','Api\UserController@leaderBoard')->middleware(['auth:api']);
    Route::get('user/manage-users','Api\UserController@getManageUsers')->middleware(['auth:api','user_permission:manage_user']);
    Route::get('user/notification/badge','Api\UserController@getNotificationBadge')->middleware(['auth:api']);
    Route::get('user/company-metric','Api\UserController@getCompanyMetric')->middleware(['auth:api']);
    Route::resource('user', 'Api\UserController')
            ->except(['destroy'])
            ->middleware(['auth:api']);

    Route::resource('kpi-group','Api\KpiGroupController')->only(['index'])->middleware(['auth:api']);

    Route::resource('team','Api\TeamController')->middleware(['auth:api','user_permission:team']);

    Route::resource('status','Api\StatusController')->middleware(['auth:api','user_permission:status']);

    Route::resource('user-pin','Api\UserPinController')->middleware(['auth:api']);

    Route::resource('territory','Api\TerritoryController')->middleware(['auth:api']);

    Route::resource('appointment','Api\AppointmentController')->middleware(['auth:api']);

    Route::resource('faq','Api\FaqController')->only('index')->middleware(['auth:api']);

    Route::resource('custom-fields','Api\CustomFieldController')->only('index')->middleware(['auth:api']);

    Route::get('app-data','Api\GeneralController@appData');

    Route::delete('notification/{id}','Api\NotificationController@deleteNotification')->middleware(['auth:api']);
    Route::get('notification','Api\NotificationController@index')
        ->name('notification.list')->middleware(['auth:api']);
    Route::post('notification/setting','Api\NotificationController@notificationSetting')
        ->name('notification.setting')->middleware(['auth:api']);
    Route::get('notification/setting','Api\NotificationController@getNotificationSetting')
        ->name('notification.setting')->middleware(['auth:api']);

    Route::post('truncate-all-data','Api\GeneralController@truncateAllData');
    Route::post('truncate-chat-data','Api\GeneralController@truncateChatData');

    Route::post('chat/send-notification','Api\ChatController@sendNotification');

    Route::get('user-tracking/dates','Api\UserTrackingController@getTrackingDates');
    Route::resource('user-tracking','Api\UserTrackingController')
        ->only(['store','index'])
        ->middleware(['auth:api']);

});