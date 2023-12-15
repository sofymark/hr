@extends('layouts.front')

@section('header')
    <title>Νέος Εργαζόμενος</title>
@endsection

@section('content')
    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
	            <div class="content container">

						<!-- Simple login form -->
						{!! Form::open(['url' => 'welcome', 'class' => 'form-horizontal']) !!}
							<div class="panel panel-body login-form">
								<div class="panel-heading">
	                            <div class="site-logo" style="float:left;">
	                                <a href="/" title="Αρχική">
	                                    <img src="{{ url('/assets/images') }}/singularlogic-logo.png" alt="Αρχική">
	                                </a>
	                            </div>
	                            <div class="page-title">
	                                <!--
	                                <h4>
	                                    <span class="text-semibold">Νέος εργαζόμενος</span>
	                                </h4>
	                                -->
	                            </div>
	                        </div>
								<div class="text-center">
									<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
									<h5 class="content-group">Αγαπητέ-ή  νέε-α συνάδελφε
										<span class="display-block">
											Η Διεύθυνση Ανθρώπινου Δυναμικού
											με χαρά σε καλωσορίζει
											στην οικογένεια του Ομίλου SingularLogic!
										</span>
										<span class="display-block">
											Σε καλούμε να μοιραστείς μαζί μας το Όραμα και τις Αξίες μας
											για να δημιουργήσουμε από κοινού
											καινοτόμα προϊόντα και υπηρεσίες υψηλής προστιθέμενης αξίας!
										</span>
										<small class="display-block">
											Παρακαλούμε συμπλήρωσε τον κωδικό που έχεις λάβει & στη συνέχεια τα στοιχεία σου στα σχετικά πεδία
										</small>
									</h5>
								</div>

								<div class="form-group has-feedback has-feedback-left">
									<input type="text" class="form-control" name="guid" placeholder="Κωδικός">
									<div class="form-control-feedback">
										<i class="icon-lock2 text-muted"></i>
									</div>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">εναρξη<i class="icon-circle-right2 position-right"></i></button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
	            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection
