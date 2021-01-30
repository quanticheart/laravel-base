<?php
    
    use Illuminate\Support\Facades\Route;
    
    const folderController = 'App\Http\Controllers\Api\\';
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
    const userController = folderController . 'User\UserController@';
    
    /* Login controllers */
    const loginController = folderController . 'Login\LoginController@';
    
    /**
     * User's Routes
     *
     *
     */
    Route::group(["prefix" => "user"], function () {
        Route::post('/session', userController . 'getSessionData');
        
        Route::delete('/delete', userController . 'deleteUser');
        
        Route::put('/update', userController . 'updateUser');

//        Route::get('/list', userController . 'getUsersList');
        
        Route::post('/logout', userController . 'logout');
        
        /**
         * Login's Routes
         *
         *
         */
        Route::post('/login', loginController . 'login');
        
        Route::post('/insert', loginController . 'insertUser');
    });
    
    /**
     * Notification's Routes
     *
     *
     */
    
    const notificationController = folderController . 'Notification\NotificationController@';
    const emailController = folderController . 'Notification\EmailController@';
    const pushController = folderController . 'Notification\PushController@';
    const smsController = folderController . 'Notification\SmsController@';
    
    Route::group(["prefix" => "notify"], function () {
        //
        Route::group(["prefix" => "/user"], function () {
            
            /* notification */
            Route::post('/send', notificationController . 'newNotification');
            Route::post('/send/email', notificationController . 'newNotificationWithEmail');
            Route::post('/send/sms', notificationController . 'newNotificationSms');
            
            Route::post('/list', notificationController . 'allNotificationList');
            Route::post('/list/unread', notificationController . 'unreadNotificationList');
            Route::post('/list/read', notificationController . 'readNotificationList');
            
            Route::post('/read', notificationController . 'readNotificationByID');
            
            /* push */
            Route::post('/push/save-token', pushController . 'saveToken');
            Route::post('/push', pushController . 'sendNotificationToUser');
            
            /* sms */
            Route::post('/sms', smsController . 'userSms');
        });
        //
        Route::post('/email', emailController . 'email');
        //
        Route::post('/sms', smsController . 'sms');
        //
        Route::post('/push/all', pushController . 'sendNotificationToAllUser');
    });
