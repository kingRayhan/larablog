@extends('layouts.app')

@section('title', '| Archive: '.$catName)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <h1>Archive: {{ $catName }}</h1>
            @if(strlen($catDesc) > 0)
            <div class="well">
                {{ $catDesc }}
            </div>
            @endif
            <div>
                <ol class="breadcrumb">
                  <li><a href="{{ route('home') }}">Home</a></li>
                  <li><a href="{{ route('blog.index') }}">Blog</a></li>
                  <li>Archieve</li>
                  <li class="active">{{ $catName }}</li>
                </ol>
            </div>

            @foreach($posts as $post)
                <div class="panel panel-default">
                        <div class="panel-heading blog-list-title">
                            <a href="{{ route('blog.single' , $post->slug) }}">{{ $post->title }}</a>
                        </div>
                    <div class="panel-body">
                        <div class="post">
                            
                            <div>
                                <strong>Published: </strong> {{ $post->created_at }} 
                                |  <strong>Posted in:</strong> <a href="{{ route('blog.archive',$post->category->name) }}">{{ $post->category->name }}</a>
                            </div>
                            <hr>
                            <p>{{ substr($post->body, 0 , 200) }}{{ strlen($post->body) > 200 ?  '[...]' : NULL }}</p>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <a href="{{ route('blog.single' , $post->slug) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            @endforeach
                <div class="text-center">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection