<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Global stylesheets -->
    <link href="{{ url('/assets/css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{ url('/assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ url('/assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ url('/assets/js/plugins/forms/wizards/steps.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/plugins/forms/validation/localization/messages_el.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/plugins/ui/fab.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/plugins/ui/prism.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/plugins/uploaders/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/core/app.js') }}"></script>
    <!-- /theme JS files -->

    @yield('header')
</head>
<body>
@yield('content')
@yield('modals')
@yield('footer')

@yield('script')
<script type="text/javascript" src="{{ url('/assets/js/iban.js') }}"></script>
<script type="text/javascript" src="{{ url('/assets/js/constants.js') }}"></script>
<script type="text/javascript" src="{{ url('/assets/js/listeners.js') }}"></script>
<script type="text/javascript" src="{{ url('/assets/js/appendDetails.js') }}"></script>
<script type="text/javascript" src="{{ url('/assets/js/app.js?dt=20171127') }}"></script>
</body>
</html>
