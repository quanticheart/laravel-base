<?php
    
    namespace Database\Seeders;
    
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    
    /**
     *  for create
     *  php artisan make:seeder DataBaseSeeder
     *
     *  for seed
     *  php artisan db:seed
     *
     * Class DatabaseSeeder
     * @package Database\Seeders
     */
    class DatabaseSeeder extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            
            /**
             * for seed with exists model
             */
//            $user = new Usuario();
//            $user->usuario = "admin admin";
//            $user->email = "admin@admin.com";
//            //123456
//            $user->password = "$2y$10$0zcQ.gkUGSUXSaZ4NUj3A..bflUysuKcZoWUzgpcLDBOqWf21yev6";
//            $user->verificado = true;
//
//            $user->save();
            
            /**
             * for seed without model
             */
            DB::table('usuario')->insert([
                'usuario' => "admin admin",
                'email' => "admin@admin.com",
                //123456
                'password' => "$2y$10$0zcQ.gkUGSUXSaZ4NUj3A..bflUysuKcZoWUzgpcLDBOqWf21yev6",
                'verificado' => true
            ]);
            
            /**
             * for seed fake data
             *
             * or
             * https://github.com/fzaninotto/Faker#create-fake-data
             */
            
            foreach (range(1, 100) as $index) {
                DB::table('usuario')->insert([
                    'usuario' => "admin $index",
                    'email' => "admin$index@admin.com",
                    //123456
                    'password' => "$2y$10$0zcQ.gkUGSUXSaZ4NUj3A..bflUysuKcZoWUzgpcLDBOqWf21yev6",
                    'verificado' => true
                ]);
            }
        }
    }
