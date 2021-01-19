<?php
    
    namespace App\Http\Middleware;
    
    use Closure;
    use Illuminate\Http\Request;

    class CorsMiddleware {
        /**
         * Handle an incoming request.
         *
         * @param Request $request
         * @param Closure $next
         * @return mixed
         */
        public function handle($request, Closure $next) {
            $headers = [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'POST, PUT, GET, DELETE, OPTIONS',
                'Access-Control-Allow-Credentials' => 'true',
                'Access-Control-Allow-Max-Age' => '86400',
                'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With',
            ];
            
            if ($request->isMethod('OPTIONS')) {
                return response()->json('{"method":"OPTIONS"}', 200, $headers);
            }
            
            $response = $next($request);
            foreach ($headers as $key => $value) {
                $response->header($key, $value);
            }
            return $response;
        }
    }
