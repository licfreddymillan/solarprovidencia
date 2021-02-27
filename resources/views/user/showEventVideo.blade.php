@extends('layouts.user.template')

@section('content')
    @include('layouts.user.partials.header')
     <div class="courses-details-area blog-area pb-140">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                	<div class="courses-details">
                		<a href="{{ route('user.event-resume', [$evento->slug, $evento->id]) }}"><i class="fa fa-arrow-left"></i> Volver al Evento</a>
	                	<div class="courses-details-img">
					    	<iframe width="100%" height="500" src="{{ $evento->video }}" frameborder="0" allow="autoplay; fullscreen" allowfullscreen ></iframe>
					    </div>
					    <div class="course-details-content">
					    	<h2>{{ $evento->title }}</h2>

	                        <a href="{{ route('user.event-resume', [$evento->slug, $evento->id]) }}"><i class="fa fa-arrow-left"></i> Volver al Evento</a>
					    </div>
					</div>
				</div>
            </div>
        </div>
    </div>
@endsection