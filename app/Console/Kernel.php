<?php
    
    namespace App\Console;
    
    use Illuminate\Console\Scheduling\Schedule;
    use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

    /**
     * Class Kernel
     * @package App\Console
     *
     * https://laravel.com/docs/5.1/scheduling
     * https://en.wikipedia.org/wiki/Cron
     * https://tutsforweb.com/how-to-set-up-task-scheduling-cron-job-in-laravel/
     */
    class Kernel extends ConsoleKernel
    {
        /**
         * The Artisan commands provided by your application.
         *
         * @var array
         */
        protected $commands = [
            Commands\SendPushToUsers::class,
            Commands\SendEmailToUsers::class,
            Commands\MakeHelper::class
        ];
        
        /**
         * Define the application's command schedule.
         *
         * @param Schedule $schedule
         * @return void
         */
        protected function schedule(Schedule $schedule)
        {
            
            $schedule->command('push:sendall')
                ->everyMinute()
                ->appendOutputTo(storage_path() . "/logs/push.log")
                ->emailOutputTo(env('MAIL_FROM_ADDRESS'));
            
            $schedule->command('email:sendall')
                ->daily()
                ->before(function () {
                    // Task is about to start...
                })
                ->after(function () {
                    // Task is complete...
                });
//
            $schedule->call(function () {
                echo 'Schedule Closure';
            })
                ->everyMinute();
            
            $schedule->call(function () {
                echo 'Runs once a week on Monday at 13:00...';
            })
                ->weekly()
                ->mondays()
                ->at('13:00');
        }
        
        /**
         * Register the commands for the application.
         *
         * @return void
         */
        protected function commands()
        {
            $this->load(__DIR__ . '/Commands');
            
            require base_path('routes/console.php');
        }
    }
