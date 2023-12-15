<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push(trans('messages.home'), route('home'));
});

// Permissions
Breadcrumbs::register('permissions', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('messages.permissions'), route('admin.permissions.index'));
});

Breadcrumbs::register('add-permission', function($breadcrumbs)
{
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push(trans('messages.add'), route('admin.permissions.create'));
});

Breadcrumbs::register('edit-permission', function($breadcrumbs, $permission)
{
    $breadcrumbs->parent('permissions');
    $breadcrumbs->push($permission->name, route('admin.permissions.edit', $permission->id));
});

// Roles
Breadcrumbs::register('roles', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('messages.roles'), route('admin.roles.index'));
});

Breadcrumbs::register('add-role', function($breadcrumbs)
{
    $breadcrumbs->parent('roles');
    $breadcrumbs->push(trans('messages.add'), route('admin.roles.create'));
});

Breadcrumbs::register('edit-role', function($breadcrumbs, $role)
{
    $breadcrumbs->parent('roles');
    $breadcrumbs->push($role->name, route('admin.roles.edit', $role->id));
});

// Users
Breadcrumbs::register('users', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('messages.users'), route('admin.users.index'));
});

Breadcrumbs::register('add-user', function($breadcrumbs)
{
    $breadcrumbs->parent('users');
    $breadcrumbs->push(trans('messages.add'), route('admin.users.create'));
});

Breadcrumbs::register('edit-user', function($breadcrumbs, $user)
{
    $breadcrumbs->parent('users');
    $breadcrumbs->push($user->username, route('admin.users.edit', $user->id));
});

// Doctors
Breadcrumbs::register('employees', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('messages.employees'), route('admin.employees.index'));
});

Breadcrumbs::register('add-employee', function($breadcrumbs)
{
    $breadcrumbs->parent('employees');
    $breadcrumbs->push(trans('messages.add'), route('admin.employees.create'));
});

Breadcrumbs::register('edit-employee', function($breadcrumbs, $employee)
{
    $breadcrumbs->parent('employees');
    $breadcrumbs->push($employee->surname . ' ' . $employee->name , route('admin.employees.edit', $employee->id));
});
