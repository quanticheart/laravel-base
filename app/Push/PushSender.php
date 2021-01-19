<?php
    
    namespace App\Push;
    
    class PushSender {
        public static function allUsers(array $tokenList) {
            $push = new Push();
            $push->setTitle('test push list');
            $push->setMessage('test push msg');
            $push->setDeeplink('com.test');
            $push->setPayload($tokenList);
            return $push->send();
        }
        
        public static function toUser(string $token) {
            $push = new Push();
            $push->setTitle('test push');
            $push->setMessage('test push msg');
            $push->setDeeplink('com.test');
            $push->setTo($token);
            return $push->send();
        }
    }
