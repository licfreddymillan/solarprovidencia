@extends('layouts.user.template')

@section('content')
@include('layouts.user.partials.header')
<div class="blog-area pb-150">
    <div class="container">
        <div class="row">
            @foreach ($noticias as $noticia)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="single-blog mb-60">
                    <div class="blog-img">
                        <a href="{{ route('news.show', [$noticia->slug, $noticia->id]) }}"><img src="{{ asset('uploads/images/news/'.$noticia->image) }}" style="width: 100%; height: 250px;"></a>
                        <div class="blog-hover">
                            <i class="fa fa-link"></i>
                        </div>
                    </div>
                    <div class="blog-content">
                        <div class="blog-top">
                            <p>{{ date('d-m-Y', strtotime($noticia->created_at)) }}</p>
                        </div>
                        <div class="blog-bottom">
                            <h2><a href="{{ route('news.show', [$noticia->slug, $noticia->id]) }}">{{ $noticia->title }} </a></h2>
                            <a href="{{ route('news.show', [$noticia->slug, $noticia->id]) }}">Ver Más</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection