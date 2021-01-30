<?php /** @noinspection PhpUndefinedFieldInspection */
    
    namespace App\Http\Middleware;
    
    use App\Constants\ConstantsMessages;
    use App\Constants\ResponseCodes;
    use App\Helpers\HashHelper;
    use App\Helpers\JwtHelper;
    use Closure;
    use Exception;
    use Firebase\JWT\ExpiredException;
    use Illuminate\Http\Request;
    use function App\Helpers\responseTokenError;

    class Authenticate
    {
        /**
         * Handle an incoming request.
         *
         * @param Request $request
         * @param Closure $next
         * @return mixed
         */
        public function handle(Request $request, Closure $next)
        {
            $language = $request->headers->get('language', ConstantsMessages::defaultLanguage);
            $msgs = new ConstantsMessages($language);
            
            $token = $request->header('User-Token');
            if (!$token) {
                // Unauthorized response if token not there
                return responseTokenError($msgs->msgErrorTokenOut, ResponseCodes::RESPONSE_CODE_TOKEN_TOKEN_OUT);
            }
            
            try {
                $credentials = JwtHelper::decode($token);
            } catch (ExpiredException $e) {
                return responseTokenError($msgs->msgErrorTokenExpired, ResponseCodes::RESPONSE_CODE_TOKEN_EXPIRED);
            } catch (Exception $e) {
                return responseTokenError($msgs->msgErrorTokenInvalid . ' - ' . $e, ResponseCodes::RESPONSE_CODE_TOKEN_INVALID);
            }
            
            // Now let's put the user in the request class so that you can grab it from there
            $request->auth = HashHelper::decrypt($credentials->sub);
            return $next($request);
        }
    }
