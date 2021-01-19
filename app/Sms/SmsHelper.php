<?php
    
    namespace App\Sms;
    
    use Illuminate\Notifications\Messages\NexmoMessage;

    class SmsHelper
    {
        static function send(string $number, string $msg): NexmoMessage
        {
            $cell = trim(str_replace(['(', ')', ' ', '-'], '', $number));
            return (new NexmoMessage())
                ->content($msg)
                ->from('55' . $cell)
                ->unicode();
        }
    }
