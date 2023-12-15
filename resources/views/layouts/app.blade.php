<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HR</title>

    @yield('css')
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ url('assets') }}/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="{{ url('assets') }}/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="{{ url('assets') }}/css/core.css" rel="stylesheet" type="text/css">
    <link href="{{ url('assets') }}/css/components.css" rel="stylesheet" type="text/css">
    <link href="{{ url('assets') }}/css/colors.css" rel="stylesheet" type="text/css">
    <link href="{{ url('assets') }}/css/style.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ url('assets') }}/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="{{ url('assets') }}/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="{{ url('assets') }}/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ url('assets') }}/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

</head>

@if (Auth::guest())

    <body class="login-container login-cover">

    <!-- Page container -->
    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="content pb-20">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('assets') }}/js/plugins/forms/validation/validate.min.js"></script>
    <script type="text/javascript" src="{{ url('assets') }}/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="{{ url('assets') }}/js/core/app.js?dt=20171127"></script>
    <script type="text/javascript" src="{{ url('assets') }}/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->

    </body>

@else
    <body class="navbar-top">

        @include('layouts.partials.admintopmenu')

        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                @include('layouts.partials.adminmenu')

                <!-- Main content -->
                <div class="content-wrapper">

                    <!-- Page header -->
                    <div class="page-header">
                        <div class="page-header-content">
                            <div class="page-title">
                                <h4><span class="text-semibold">@yield('title')</span></h4>
                            </div>
                        </div>

                        <div class="breadcrumb-line breadcrumb-line-component">
                            @yield('breadcrumb')
                        </div>
                    </div>
                    <!-- /page header -->

                    @yield('content')

                </div>
                <!-- /content wrapper -->

            </div>
            <!-- /page content -->

        </div>
        <!-- /page container -->

        <!-- Theme JS files -->
        <script type="text/javascript" src="{{ url('assets') }}/js/core/libraries/jquery_ui/interactions.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/notifications/sweet_alert.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/forms/selects/select2.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/tables/footable/footable.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/ui/fab.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/ui/prism.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/tables/footable/footable.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/forms/styling/uniform.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/forms/styling/switchery.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/forms/styling/switch.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/forms/inputs/duallistbox.min.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/core/app.js"></script>
        <script type="text/javascript" src="{{ url('assets') }}/js/plugins/ui/ripple.min.js"></script>
        <!-- /theme JS files -->

        @yield('js')

        <script src="{{ url('assets') }}/js/main.js" type="text/javascript"></script>

    </body>
@endif
</html>
