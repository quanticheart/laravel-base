<?php
    
    namespace App\Console\Commands;
    
    use App\Mail\MailSender;
    use App\Models\User;
    use Illuminate\Console\Command;
    
    /**
     * Class SendPushToUsers
     * @package App\Console\Commands
     *
     */
    class SendEmailToUsers extends Command {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'email:sendall';
        
        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Send Email to all users in database';
        
        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct() {
            parent::__construct();
        }
        
        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle() {
            MailSender::allUsers(User::emailList());
            return true;
        }
    }
