@extends('layouts.app')

@section('title', '| Edit Post')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
@endsection

@section('content')
	{!! Form::open(['route' => ['posts.update',$post->id] , 'data-parsely-validate' => '' , 'method' => 'PUT']) !!}
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Edit post</h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							{!! Form::label('title','Title') !!}
							{!! Form::text('title' , $post->title , ['class' => 'form-control' , 'placeholder' => 'Post Title' ,'data-parsley-required' => '' , 'data-parsley-maxlength' =>'255']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('slug','Slug') !!}
							{!! Form::text('slug' , $post->slug , ['class' => 'form-control' , 'placeholder' => 'Post slug' ,'data-parsley-required' => '' , 'data-parsley-maxlength' =>'255']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('body','Body') !!}
							{!! Form::textarea('body',$post->body,['class' => 'form-control','data-parsley-required' => '']) !!}
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Action
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

						<div class="form-group">
							{!! Form::label('category','Select category') !!}
							@if( count($categories) )
								<select name="category_id" id="category" class="form-control">
									@foreach( $categories as $cat )
										<option {{ ($post->category_id == $cat->id) ? "selected='selected'": NULL }} value="{{ $cat->id }}">{{ $cat->name }}</option>
									@endforeach
								</select>
							@else
							<div class="well">
								No category created.&nbsp;&nbsp;&nbsp;<a href="{{ route('category.index') }}">Add one</a>
							</div>
							@endif
						</div>

						<hr>
						<div class="row">
							<div class="col-xs-6">
								<a href="{{ URL::previous() }}" class="btn btn-info btn-block"><i class="fa fa-reply"></i> Back</a>
							</div>

							<div class="col-xs-6">
								<a href="#" onclick="event.preventDefault();document.getElementById('delete-post').submit();" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Delete</a>

							</div>

							<div class="col-xs-12" style="margin-top: 15px;">
								<button class="btn btn-success btn-block"><i class="fa fa-pencil"></i> Save Changes</button>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>{{-- .row --}}
	</div>
	{!! Form::close() !!}
	{{ Form::open(['route' => ['posts.destroy' , $post->id] , 'method' => 'DELETE' , 'id' => 'delete-post']) }}{{ Form::close() }}
@endsection


@section('scripts')

	{!! Html::script('js/parsley.min.js') !!}
	<script type="text/javascript">
	  $('form').parsley();
	</script>
@endsection
