<?php
    
    namespace App\Http\Controllers;
    use Illuminate\Routing\Controller as BaseController;
    
    class Controller extends BaseController {
        /**
         * Controller constructor.
         * @param array $except for exclude connection jwt validation
         */
        function validateRoutes(array $except = []) {
            $this->middleware('auth', ['except' => $except]);
        }
    }
