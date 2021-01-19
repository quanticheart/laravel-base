<?php /** @noinspection PhpUndefinedMethodInspection */
    
    namespace App\Http\Controllers\Login;
    
    use App\Constants\ResponseCodes;
    use App\Constants\ValidationRules;
    use App\Exceptions\RequestValidation;
    use App\Helpers\JwtHelper;
    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Hash;
    use function App\Helpers\responseError;
    use function App\Helpers\responseOk;

    class LoginController extends Controller
    {
        
        public function login(Request $request)
        {
            return RequestValidation::tryCatch(function () use ($request) {
                $request->validate(ValidationRules::LOGIN);
                // Find the user by email
                $user = User::where('email', $request->input('email'))->first();
                
                if (!$user) {
                    // You wil probably have some sort of helpers or whatever
                    // to make sure that you have the same response format for
                    // different kind of responses. But let's return the
                    // below response for now.
                    return responseError('user name or password incorrect', ResponseCodes::RESPONSE_CODE_LOGIN_USER_NOT_FOUND, Response::HTTP_NOT_FOUND);
                }
                
                // Verify the password and generate the token
                if (Hash::check($request->input('password'), $user->password)) {
                    return responseOk('login ok', JwtHelper::encode($user), ResponseCodes::RESPONSE_CODE_LOGIN_SUCCESS);
                }
                
                // Bad Request response
                return responseError('user name or password incorrect', ResponseCodes::RESPONSE_CODE_LOGIN_ERROR, Response::HTTP_NOT_FOUND);
            });
        }
        
        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function insertUser(Request $request)
        {
            return RequestValidation::tryCatch(function () use ($request) {
                $request->validate(ValidationRules::NEW_USER);
                
                $user = new User();
                $user->email = $request->email;
                $user->celular = $request->celular;
                $user->usuario = $request->usuario;
                $user->password = Hash::make($request->password);
                $user->verificado = false;
                
                $user->save();
                return responseOk('cadastro ok para ' . $request->email);
            });
        }
    }
