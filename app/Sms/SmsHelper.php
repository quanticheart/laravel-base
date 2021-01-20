<?php
    
    namespace App\Sms;
    
    use App\Helpers\StringHelper;
    use Illuminate\Notifications\Messages\NexmoMessage;

    class SmsHelper
    {
        static function send(string $number, string $msg): NexmoMessage
        {
            return (new NexmoMessage())
                ->content($msg)
                ->from('55' . StringHelper::clearPhoneNumber($number))
                ->unicode();
        }
    }
