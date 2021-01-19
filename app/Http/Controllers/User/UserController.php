<?php /** @noinspection PhpUndefinedFieldInspection */
    
    namespace App\Http\Controllers\User;
    
    use App\Constants\ValidationRules;
    use App\Exceptions\RequestValidation;
    use App\Http\Controllers\Controller;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use function App\Helpers\responseOk;

    /**
     * @method validate(Request $request, array $UPDATE_USER)
     */
    class UserController extends Controller
    {
        
        /**
         * Create a new controller instance.
         *
         */
        public function __construct()
        {
            $this->validateRoutes();
        }
        
        public function logout()
        {
            return RequestValidation::tryCatch(function () {
                return responseOk('token invalided');
            });
        }

//        public function getUsersList()
//        {
//            return RequestValidation::tryCatch(function () {
//                return responseOk('user list', User::all());
//            });
//        }
        
        public function getSessionData(Request $request)
        {
            return RequestValidation::tryCatch(function () use ($request) {
                return responseOk('user data', User::find($request->auth));
            });
        }
        
        public function deleteUser($id)
        {
            return RequestValidation::tryCatch(function () use ($id) {
                $user = User::find($id);
                $user->delete();
                return responseOk('user deleted');
            });
        }
        
        public function updateUser(Request $request)
        {
            return RequestValidation::tryCatch(function () use ($request) {
                $request->validate(ValidationRules::UPDATE_USER);
                
                $user = User::find($request->auth);
                $user->usuario = $request->usuario;
                $user->celular = $request->celular;
                $user->password = Hash::make($request->password);
                
                $user->save();
                return responseOk('user ' . $user->usuario . ' updated');
            });
        }
    }