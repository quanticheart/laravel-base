<?php
    
    namespace App\Constants;
    
    class ResponseCodes
    {
        /**
         * Code Errors
         */
        
        /* TOKEN */
        const RESPONSE_CODE_TOKEN_EXPIRED = 15;
        const RESPONSE_CODE_TOKEN_INVALID = 16;
        const RESPONSE_CODE_TOKEN_TOKEN_OUT = 17;
        
        /* LOGIN */
        const RESPONSE_CODE_LOGIN_SUCCESS = 50;
        const RESPONSE_CODE_LOGIN_USER_NOT_FOUND = 55;
        const RESPONSE_CODE_LOGIN_ERROR = 56;
        
        /* Email */
        const RESPONSE_CODE_EMAIL_FAILED_SEND = 65;
        
        /*Validation Fails*/
        const RESPONSE_CODE_VALIDATE_FAILED = 75;
    }
