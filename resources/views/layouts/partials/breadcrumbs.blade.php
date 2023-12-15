@if ($breadcrumbs)
	<ul class="breadcrumb">
		@foreach ($breadcrumbs as $breadcrumb)
			@if ($breadcrumb->url && !$breadcrumb->last)
				<li><a class="active" href="{{ $breadcrumb->url }}">@if($breadcrumb->title == "Home")<i class="icon-home2 position-left"></i>@endif{{ $breadcrumb->title }}</a></li>
			@else
				<li>@if($breadcrumb->title == "Home")<i class="icon-home2 position-left"></i>@endif{{ $breadcrumb->title }}</li>
			@endif
		@endforeach
	</ul>
@endif
