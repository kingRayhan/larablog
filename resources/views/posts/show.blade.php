@extends('layouts.app')

@section('title', '| '.$post->title)

@section('content')
	<div class="container">
		<div class="row">


			<div class="col-md-8">				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h1 class="title">{{ $post->title }}</h1>
					</div>
					<div class="panel-body">
						<p class="post-body">{{ $post->body }}</p>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Actions
					</div>
					<div class="panel-body">
					   <div>
					   		<h4>Hyperlink:</h4>
					   		<a href="{{ route('blog.single' , $post->slug) }}">{{ route('blog.single' , $post->slug) }}</a>
					   </div>
					   <div>
						  <h4>Created at:</h4>
						    {{ date('d F Y',strtotime($post->created_at)) }} 
						  	<br>{{ date('l',strtotime($post->created_at)) }}
						  	<br>{{ date('h:i A',strtotime($post->created_at)) }}
						</div>

					   <div>
						  <h4>Last Updated at:</h4>
						    {{ date('d F Y',strtotime($post->updated_at)) }} 
						  	<br>{{ date('l',strtotime($post->updated_at)) }}
						  	<br>{{ date('h:i A',strtotime($post->updated_at)) }}
						</div>

						<hr>
						<strong>Category:</strong>
						<div class="well">{{ ($post->category_id != NULL) ? $post->category->name : 'Uncategorized' }}</div>
						<hr>
						<div class="row">
							<div class="col-xs-6">
								<a href="{{ URL::previous() }}" class="btn btn-info btn-block"><i class="fa fa-reply"></i> Back</a>
							</div>
							<div class="col-xs-6">
								<a href="{{ route('posts.edit' , $post->id) }}" class="btn btn-success btn-block"><i class="fa fa-pencil"></i> Edit</a>
							</div>
							<div class="col-xs-12" style="margin-top: 15px;">
								<a href="#" onclick="event.preventDefault();document.getElementById('delete-post').submit();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Delete</a>
								{{ Form::open(['route' => ['posts.destroy' , $post->id] , 'method' => 'DELETE' , 'id' => 'delete-post']) }}{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
@endsection