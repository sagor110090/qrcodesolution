<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'provider_id' => NULL,
                'name' => 'Mehedi Hasan Sagor',
                'email' => 'mehedihasansagor.cse@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$wzP2R6D3NnyW0/Yhe72iEu6EiMNV/OAPkQjGkuXPzyJFbdgMmR4eu',
                'remember_token' => 'Owbke3Zh5hhZcOsVqa6uH3ZNQKjBDqjxUsduxwHqN7xzhzC7hnplN4zDnGLW',
                'created_at' => '2023-10-23 11:11:01',
                'updated_at' => '2023-11-06 18:21:18',
                'stripe_id' => 'cus_OxSKOr9rjqImUY',
                'pm_type' => NULL,
                'pm_last_four' => NULL,
                'trial_ends_at' => NULL,
            ),
        ));
        
        
    }
}