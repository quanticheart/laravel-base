<?php /** @noinspection PhpUndefinedFieldInspection */
    
    namespace App\Http\Controllers;
    
    use App\Constants\ResponseCodes;
    use App\Exceptions\RequestValidation;
    use App\Mail\MailSender;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Mail;
    use function App\Helpers\responseError;
    use function App\Helpers\responseOk;

    class EmailController extends Controller
    {
        
        /**
         * Create a new controller instance.
         *
         */
        public function __construct()
        {
            /* excepts */
            $this->validateRoutes(['email']);
        }
        
        /**
         * Email Code Session
         *
         *
         * @param Request $request
         * @return JsonResponse
         */
        public function email(Request $request)
        {
            return RequestValidation::tryCatch(function () use ($request) {
                $result = MailSender::toUser($request->email);
                if (!$result) {
                    return responseError('failure send to:' . Mail::failures(), ResponseCodes::RESPONSE_CODE_EMAIL_FAILED_SEND, Response::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    return responseOk('e-mail send success');
                }
            });
        }
    }
