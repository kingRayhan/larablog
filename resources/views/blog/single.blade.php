@extends('layouts.app')

@section('title', '| '.$post->title)
@section('stylesheets')
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
@stop
@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<script>
        $("#share").jsSocials({
            shares: ["twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
        });
    </script>
@stop
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="title">{{ $post->title }} 
							@if(Auth::check())
							    <a class="btn btn-danger btn-xs" href="{{ route('posts.edit' , $post->id) }}"><i class="fa fa-pencil"></i></a>
							@endif
						</h3> 
					</div>
					<div class="panel-body">
						<div>
							<ol class="breadcrumb">
							  <li><a href="{{ route('home') }}">Home</a></li>
							  <li><a href="{{ route('blog.index') }}">Blog</a></li>
							  <li class="active">{{ $post->title }}</li>
							</ol>
						</div>

                            <div>
                                <strong>Published: </strong> {{ $post->created_at }} 
                                |  <strong>Posted in:</strong> 
                                @if($post->category_id != NULL)
                                    <a href="{{ route('blog.archive' , $post->category->name) }}">
                                        {{ $post->category->name }}
                                    </a>
                                @else
                                    Uncategorized
                                @endif
                            </div>
                        <hr>

						<div id="share"></div>

						<hr>

						<p class="post-body">
							{!! $post->body !!}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection