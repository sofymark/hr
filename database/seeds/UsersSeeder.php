<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('1234567890'),
            'name' => 'Admin',
            'email' => 'ssavranakis@singularlogic.eu',        
            'active' => 1,
        ]);
    }
}
