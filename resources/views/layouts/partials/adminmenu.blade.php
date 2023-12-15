<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    {{--<li {{ (str_contains($route,"admin.dashboard") ? 'class=active' : '') }}><a href="{{ url('/') }}"><i class="icon-home4"></i> <span>{{ trans('messages.dashboard') }}</span></a></li>--}}
                    @can('admin.users.index')<li {{ (str_contains($route,"admin.users") ? 'class=active' : '') }}><a href="{{ action('Admin\UserController@index') }}"><i class="icon-users"></i> <span>{{ trans('messages.users') }}</span></a></li>@endcan
                    @can('admin.roles.index')
                    @if(Auth::user()->isAdministrator())
                    <li {{ (str_contains($route,"admin.roles") ? 'class=active' : '') }}><a href="{{ action('Admin\RoleController@index') }}"><i class="icon-users4"></i> <span>{{ trans('messages.roles') }}</span></a></li>
                    @endif
                    @endcan
                    @can('admin.permissions.index')<li {{ (str_contains($route,"admin.permissions") ? 'class=active' : '') }}><a href="{{ action('Admin\PermissionController@index') }}"><i class="icon-user-lock"></i> <span>{{ trans('messages.permissions') }}</span></a></li>@endcan
                    @can('admin.employees.index')<li {{ (str_contains($route,"admin.employees") ? 'class=active' : '') }}><a href="{{ action('Admin\EmployeeController@index') }}"><i class="icon-aid-kit"></i> <span>{{ trans('messages.employees') }}</span></a></li>@endcan
                    <li {{ (str_contains($route,"myprofile") ? 'class=active' : '') }}><a href="{{ url('admin/myprofile') }}"><i class="icon-user"></i> <span>{{ trans('messages.myprofile') }}</span></a></li>
                    <li><a href="{{ url('logout') }}"><i class="icon-switch2"></i> <span>{{ trans('messages.logout') }}</span></a></li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->
