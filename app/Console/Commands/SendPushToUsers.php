<?php
    
    namespace App\Console\Commands;
    
    use App\Models\User;
    use App\Push\PushSender;
    use Illuminate\Console\Command;

    /**
     * Class SendPushToUsers
     * @package App\Console\Commands
     *
     * https://tutsforweb.com/how-to-set-up-task-scheduling-cron-job-in-laravel/
     */
    class SendPushToUsers extends Command {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'push:sendall';
        
        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Send Push to all users in database';
        
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
            PushSender::allUsers(User::pushTokenList());
            return true;
        }
    }
