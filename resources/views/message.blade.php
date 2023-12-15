@if(session('success'))
	<div class="alert alert-success" role="alert">
		<button class="close" data-dismiss="alert"></button>
		{{ session('success') }}
	</div>
@elseif(session('error'))
	<div class="alert alert-error" role="alert">
		<button class="close" data-dismiss="alert"></button>
		{{ session('error') }}
	</div>
@endif