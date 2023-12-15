<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('PermissionsSeeder');
        $this->command->info('Permissions table seeded!');

        $this->call('RolesSeeder');
        $this->command->info('Roles table seeded!');

        $this->call('PermissionsRolesSeeder');
        $this->command->info('PermissionsRoles table seeded!');

        $this->call('UsersSeeder');
        $this->command->info('Users table seeded!');

        $this->call('RolesUsersSeeder');
        $this->command->info('RolesUsers table seeded!');
        
    }
}
