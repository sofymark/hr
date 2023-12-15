<div class="heading-elements">
    <ul class="icons-list">
        <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-gear position-left"></i>
                <span class="current-language">English</span>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right switch-locales">
                @if(isset($model->id))
                    @foreach($model->translations as $locale)
                        <li><a href="#" @if($locale->locale == "en")class="active"@endif id="switch" data-language="{{ $locale->locale }}"><img src="{{ url('assets') }}/images/flags/{{ $locale->locale }}.png" />{{ $locales->where('iso', $locale->locale)->first()->name }}</a></li>
                    @endforeach
                @else
                    @foreach($locales as $locale)
                        <li><a href="#" @if($locale->iso == "en")class="active"@endif id="switch" data-language="{{ $locale->iso }}"><img src="{{ url('assets') }}/images/flags/{{ $locale->iso }}.png" />{{ $locale->name }}</a></li>
                    @endforeach
                @endif
            </ul>
        </li>
    </ul>
</div>