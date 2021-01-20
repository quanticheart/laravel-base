<?php /** @noinspection PhpUndefinedFieldInspection */
    
    namespace App\Http\Controllers\Notification;
    
    use App\Exceptions\RequestValidation;
    use App\Http\Controllers\Controller;
    use App\Models\User;
    use App\Notifications\NotificationSmsUser;
    use App\Sms\SmsHelper;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use function App\Helpers\responseOk;

    class SmsController extends Controller
    {
        
        /**
         * Create a new controller instance.
         *
         */
        public function __construct()
        {
            /* excepts */
            $this->validateRoutes(['sms']);
        }
        
        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function sms(Request $request)
        {
            return RequestValidation::tryCatch(function () use ($request) {
                SmsHelper::send($request->celular, 'Send Sms from nexmo');
                return responseOk('send sms success');
            });
        }
        
        /**
         * Sms Code Session
         * @param Request $request
         * @return JsonResponse
         */
        public function userSms(Request $request)
        {
            return RequestValidation::tryCatch(function () use ($request) {
                $user = User::find($request->auth);
                $user->notify(new NotificationSmsUser($user));
                return responseOk('send sms from user success');
            });
        }
    }
