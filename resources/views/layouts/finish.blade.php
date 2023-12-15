@extends('layouts.front')

@section('header')
    <title>Τέλος διαδικασίας</title>
@endsection

@section('content')
    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
	            <div class="content container">
					<div class="panel panel-body login-form">
						<div class="panel-heading">
                        <div class="site-logo" style="float:left;">
                            <a href="/" title="Αρχική"><img src="{{ url('/assets/images/singularlogic-logo.png') }}" alt="Αρχική"></a>
                        </div>
                        <div class="page-title"></div>
                    </div>
					<div class="text-center">
						<h2 class="content-group"><strong>Η διαδικασία έχει ολοκληρωθεί - Ευχαριστούμε!</strong></h2>
						<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
						<h5 class="content-group">
							<span class="display-block">Σε καλωσορίζουμε στην οικογένεια της SingularLogic!</span>
							<span class="display-block">Σε καλούμε να συμμετέχεις ενεργά και δημιουργικά σε κάθε δράση μας.</span>
							<span class="display-block">Καλή Αρχή & Κάθε Επιτυχία στα νέα σου καθήκοντα!</span>
						</h5>
					</div>
	            </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection
