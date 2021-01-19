<?php
    
    namespace App\Notifications;
    
    use App\Helpers\SmsHelper;
    use App\Models\User;
    use Illuminate\Bus\Queueable;
    use Illuminate\Notifications\Notification;

    class NotificationSmsUser extends Notification {
        use Queueable;
        
        /**
         * in error :
         *
         * Type of Illuminate\Notifications\DatabaseNotification::$table must be string (as in class Illuminate\Database\Eloquent\Model)
         *
         * open file Illuminate\Notifications\DatabaseNotification
         * and change line
         *         protected $table = 'notifications';
         * to
         *         protected string $table = 'notifications';
         */
        
        /** @var user */
        public User $user;
        
        /**
         * @param User $user
         */
        public function __construct($user) {
            $this->user = $user;
        }
        
        
        /**
         * Get the notification's delivery channels.
         *
         * @param mixed $notifiable
         * @return array
         */
        public function via($notifiable) {
            return ['nexmo'];
        }
        
        public function toNexmo($notifiable) {
            return SmsHelper::send($this->user->cell, 'Test SMS User from nexmo');
        }
    }
