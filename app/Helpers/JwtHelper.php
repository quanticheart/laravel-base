<?php
    
    namespace App\Helpers;
    
    use App\Models\User;
    use Firebase\JWT\JWT;

    class JwtHelper
    {
        /**
         * Create a new token.
         *
         * @param User $user
         * @return string
         */
        static function encode(User $user)
        {
            $payload = [
                'sub' => HashHelper::encrypt($user->id), // Subject of the token
                'iat' => time(), // Time when JWT was issued.
                'exp' => time() + 60 * 60 // Expiration time
            ];
            
            // As you can see we are passing `JWT_SECRET` as the second parameter that will
            // be used to decode the token in the future.
            return JWT::encode($payload, env('JWT_SECRET'));
        }
        
        static function decode(string $token)
        {
            return JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        }
    }
