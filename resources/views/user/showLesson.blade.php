@extends('layouts.user.template')

@section('content')
    @include('layouts.user.partials.header')
     <div class="courses-details-area blog-area pb-140">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                	<div class="courses-details">
                		<a href="{{ route('user.course-resume', [$leccionActual->course->slug, $leccionActual->course->id]) }}"><i class="fa fa-arrow-left"></i> Volver al Curso</a>
	                	<div class="courses-details-img">
					    	<iframe width="100%" height="500" src="{{ $leccionActual->video }}" frameborder="0" allow="autoplay; fullscreen" allowfullscreen ></iframe>
					    </div>
					    <div class="course-details-content">
					    	<h2>{{ $leccionActual->title }}</h2>
	                        <p>{{ $leccionActual->duration }}</p>
	                        <p>{!! $leccionActual->description !!}</p>

	                        <a href="{{ route('user.course-resume', [$leccionActual->course->slug, $leccionActual->course->id]) }}"><i class="fa fa-arrow-left"></i> Volver al Curso</a>
					    </div>
					</div>
				</div>
                <div class="col-md-4 pt-60">
                	<div class="blog-sidebar right">
                		<div class="single-blog-widget mb-50">
                        	<div class="course-title pb-20" >
                                <h3 style="color: white !important;">Otras Lecciones</h3>
                            </div>
	                        @foreach ($lecciones as $leccion)
		                        <div class="single-post mb-50">
		                            <div class="single-post-img">
		                                <a href="{{ route('user.show-lesson', [$leccion->slug, $leccion->id]) }}"><img src="{{ asset('uploads/images/courses/'.$leccion->course->cover) }}" style="width: 100px; height: 80px;">
		                                    <div class="blog-hover">
		                                        <i class="fa fa-link"></i>
		                                    </div>
		                                </a>
		                            </div>
		                            <div class="single-post-content">
		                            	<div>
		                            		<h4><a href="{{ route('user.show-lesson', [$leccion->slug, $leccion->id]) }}">{{ $leccion->title }}</a></h4>
		                                	<p><i class="far fa-clock"></i> {{ $leccion->duration }}</p>
		                                	@if ($leccion->id == $leccionActual->id)
		                                		<label class="label label-primary"><i class="far fa-play-circle"></i> En curso...</label>
		                                	@else
		                                		@if ($leccion->vista == 1)
		                                			<label class="label label-success"><i class="far fa-check-circle"></i> Vista</label>
		                                		@else
		                                			<label class="label label-warning"><i class="far fa-eye"></i> Pendiente</label>
		                                		@endif
		                                	@endif
		                            	</div>
		                               
		                            </div>
		                        </div>
	                        @endforeach
                    	</div>
                	</div>
                </div>
            </div>
        </div>
    </div>
@endsection