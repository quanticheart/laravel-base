<?php
    
    namespace App\Helpers;
    
    class StringHelper
    {
        static function clearPhoneNumber(string $number)
        {
            return trim(str_replace(['(', ')', ' ', '-'], '', $number));
        }
    }
