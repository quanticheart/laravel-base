<?php /** @noinspection PhpUndefinedFieldInspection */
    
    namespace App\Http\Controllers\Notification;
    
    use App\Exceptions\RequestValidation;
    use App\Http\Controllers\Controller;
    use App\Models\User;
    use App\Push\PushSender;
    use Illuminate\Http\Request;
    use function App\Helpers\responseOk;

    class PushController extends Controller
    {
        
        /**
         * Create a new controller instance.
         *
         */
        public function __construct()
        {
            /* excepts */
            $this->validateRoutes(['sendNotificationToAllUser']);
        }
        
        public function saveToken(Request $request)
        {
            return RequestValidation::tryCatch(function () use ($request) {
                $user = User::find($request->auth);
                $user->device_token = $request->token;
                $user->save();
                return responseOk('token saved successfully.');
            });
        }
        
        public function sendNotificationToUser(Request $request)
        {
            return RequestValidation::tryCatch(function () use ($request) {
                $user = User::find($request->auth);
                $token = $user->device_token;
                if ($token !== null) {
                    PushSender::toUser($token);
                    return responseOk('send ok');
                } else {
                    return responseOk('registrations token no exists in database');
                }
            });
        }
        
        public function sendNotificationToAllUser(Request $request)
        {
            return RequestValidation::tryCatch(function () use ($request) {
                $firebaseToken = User::pushTokenList();
                if (count($firebaseToken) > 0) {
                    PushSender::allUsers($firebaseToken);
                    return responseOk('send ok');
                } else {
                    return responseOk('zero registrations in database');
                }
            });
        }
        
        
    }
