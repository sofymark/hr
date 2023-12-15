<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // USERS
        DB::table('permissions')->insert([
            'name' => 'Create User',
            'machine' => 'admin.users.create',
            'description' => 'Permission to create a user',
            'group' => 'users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Read User',
            'machine' => 'admin.users.show',
            'description' => 'Permission to view a user',
            'group' => 'users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Update User',
            'machine' => 'admin.users.edit',
            'description' => 'Permission to edit a user',
            'group' => 'users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete User',
            'machine' => 'admin.users.destroy',
            'description' => 'Permission to delete a user',
            'group' => 'users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View all Users',
            'machine' => 'admin.users.index',
            'description' => 'Permission to view a list of all users',
            'group' => 'users'
        ]);

        // EMPLOYESS
        DB::table('permissions')->insert([
            'name' => 'Create Employee',
            'machine' => 'admin.employees.create',
            'description' => 'Permission to create an employee',
            'group' => 'users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Read Employee',
            'machine' => 'admin.employees.show',
            'description' => 'Permission to view an employee',
            'group' => 'users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Update Employee',
            'machine' => 'admin.employees.edit',
            'description' => 'Permission to edit an employee',
            'group' => 'users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Employee',
            'machine' => 'admin.employees.destroy',
            'description' => 'Permission to delete an employee',
            'group' => 'users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View all Employees',
            'machine' => 'admin.employees.index',
            'description' => 'Permission to view a list of all employees',
            'group' => 'users'
        ]);

        // ROLES
        DB::table('permissions')->insert([
            'name' => 'Create Role',
            'machine' => 'admin.roles.create',
            'description' => 'Permission to create a role',
            'group' => 'roles'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Read Role',
            'machine' => 'admin.roles.show',
            'description' => 'Permission to view a role',
            'group' => 'roles'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Update Role',
            'machine' => 'admin.roles.edit',
            'description' => 'Permission to edit a role',
            'group' => 'roles'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Role',
            'machine' => 'admin.roles.destroy',
            'description' => 'Permission to delete a role',
            'group' => 'roles'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View all Roles',
            'machine' => 'admin.roles.index',
            'description' => 'Permission to view a list of all roles',
            'group' => 'roles'
        ]);

        // PERMISSIONS
        DB::table('permissions')->insert([
            'name' => 'Create Permission',
            'machine' => 'admin.permissions.create',
            'description' => 'Permission to create a permission',
            'group' => 'permissions'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Read Permission',
            'machine' => 'admin.permissions.show',
            'description' => 'Permission to view a permission',
            'group' => 'permissions'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Update Permission',
            'machine' => 'admin.permissions.edit',
            'description' => 'Permission to edit a permission',
            'group' => 'permissions'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Permission',
            'machine' => 'admin.permissions.destroy',
            'description' => 'Permission to delete a permission',
            'group' => 'permissions'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View all Permissions',
            'machine' => 'admin.permissions.index',
            'description' => 'Permission to view a list of all permissions',
            'group' => 'permissions'
        ]);
    }
}
