@extends('layouts.user.template')

@section('content')
@include('layouts.user.partials.header')
<div class="blog-details-area pb-140">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="blog-details">
                    <div class="blog-details-img">
                        <img src="{{ asset('uploads/images/news/'.$noticia->image) }}" alt="blog-details">
                    </div>
                    <div class="blog-details-content">
                        <h2>{{ $noticia->title }}</h2>
                        {!! $noticia->description !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-sidebar right">
                    <div class="single-blog-widget mb-47">
                        <h3>Buscar</h3>
                        <div class="blog-search">
                            <form method="GET" action="{{ route('courses.search') }}">
                                <input type="search" placeholder="Curso..." name="busqueda" />
                                <button type="submit">
                                    <span><i class="fa fa-search"></i></span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="single-blog-widget mb-47">
                        <h3>Otras Noticias</h3>
                        @foreach ($otrasNoticias as $otraNoticia)
                        <div class="single-post mb-30">
                            <div class="single-post-img">
                                <a href="{{ route('news.show', [$otraNoticia->slug, $otraNoticia->id]) }}"><img src="{{ asset('uploads/images/news/'.$otraNoticia->image) }}" alt="post">
                                    <div class="blog-hover">
                                        <i class="fa fa-link"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="single-post-content">
                                <h4><a href="{{ route('news.show', [$otraNoticia->slug, $otraNoticia->id]) }}">{{ $otraNoticia->title }}</a></h4>
                                <p>{{ date('d-m-Y', strtotime($otraNoticia->created_at)) }}</p>
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