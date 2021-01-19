<?php
    
    namespace App\Http\Middleware;
    
    use App\Helpers\HashHelper;
    use Closure;
    use Illuminate\Http\Request;
    use Jenssegers\Agent\Agent;
    use function App\Helpers\responseError;

    class ApiTokenMiddleware {
        /**
         * Handle an incoming request.
         *
         * @param Request $request
         * @param Closure $next
         * @return mixed
         */
        public function handle(Request $request, Closure $next) {
            $apiToken = $request->header('Api-Token', null);
            $ip = $request->ip();
            
            if ($apiToken !== null) {
                
                $auth = false;
                $agent = new Agent();
                
                // ['nl-nl', 'nl', 'en-us', 'en']
                $languages = $agent->languages();
                //
                $device = $agent->device();
                $platform = $agent->platform();
                $browser = $agent->browser();
                //
                $browser = $agent->browser();
                $version = $agent->version($browser);
                //
                $platform = $agent->platform();
                $version = $agent->version($platform);
                
                if ($agent->isDesktop()) {
                    $token = env('TOKEN_WEB');
                    if ($apiToken === $token) {
                        $auth = true;
                    }
                }
                
                if ($agent->isMobile()) {
                    
                    if ($platform === 'iOS') {
                        $token = env('TOKEN_IOS');
                        if ($apiToken === $token) {
                            $auth = true;
                        }
                    }
                    
                    if ($platform === 'AndroidOS') {
                        $token = env('TOKEN_ANDROID');
                        if ($apiToken === $token) {
                            $auth = true;
                        }
                    }
                    
                }
                
                if ($agent->isRobot()) {
                    $token = env('TOKEN_POSTMAN');
                    if ($apiToken === $token) {
                        $auth = true;
                    }
                }
                
                /**
                 * verify auth is ok
                 */
                if ($auth) {
                    return $next($request);
                } else {
                    return $this->returnErrorToken();
                }
                
            } else {
                return $this->returnErrorToken();
            }
        }
        
        private function returnErrorToken() {
            return responseError('api-token invalid', 999, 401);
        }
    }
