<!-- Main navbar -->
<div class="navbar navbar-default navbar-fixed-top header-highlight">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ url('/') }}"><strong>HR</strong></a>

        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
        <div class="navbar-right">
            <p class="navbar-text">{{ trans('messages.welcome') }}{{ Auth::user()->username }}!</p>
        </div>
    </div>
</div>
<!-- /main navbar -->
