<?php
    
    use Illuminate\Support\Facades\Route;
    
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
    
    /* User controllers */
    const userController = 'App\Http\Controllers\User\UserController@';
    
    /* Login controllers */
    const loginController = 'App\Http\Controllers\Login\LoginController@';
    
    /**
     * User's Routes
     *
     *
     */
    Route::group(["prefix" => "user"], function () {
        Route::post('/session', userController . 'getSessionData');
        
        Route::delete('/delete/{id}', userController . 'deleteUser');
        
        Route::put('/update', userController . 'updateUser');

//        Route::get('/list', userController . 'getUsersList');
        
        Route::get('/logout', userController . 'logout');
        
        Route::post('/insert', loginController . 'insertUser');
    });
    
    /**
     * Login's Routes
     *
     *
     */
    Route::post('/login', loginController . 'login');
    
    /**
     * Notification's Routes
     *
     *
     */
    
    const notificationController = 'App\Http\Controllers\Notification\NotificationController@';
    const emailController = 'App\Http\Controllers\Notification\EmailController@';
    const pushController = 'App\Http\Controllers\Notification\PushController@';
    const smsController = 'App\Http\Controllers\Notification\SmsController@';
    
    Route::group(["prefix" => "notify"], function () {
        //
        Route::group(["prefix" => "/user"], function () {
            
            /* notification sms */
            Route::post('/send', notificationController . 'newNotification');
            Route::post('/send/email', notificationController . 'newNotificationWithEmail');
            Route::post('/send/sms', notificationController . 'newNotificationSms');
            
            Route::post('/list', notificationController . 'allNotificationList');
            Route::post('/list/unread', notificationController . 'unreadNotificationList');
            Route::post('/list/read', notificationController . 'readNotificationList');
            
            Route::post('/read', notificationController . 'readNotificationByID');
            
            /* push sms */
            Route::post('/push/save-token', pushController . 'saveToken');
            Route::post('/push', pushController . 'sendNotificationToUser');
            
            /* user sms */
            Route::post('/sms', smsController . 'userSms');
        });
        //
        Route::post('/email', emailController . 'email');
        //
        Route::post('/sms', smsController . 'sms');
        //
        Route::post('/push/all', pushController . 'sendNotificationToAllUser');
    });
