@extends('layouts.app')

@section('title', '| Deleted Posts')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 style="">Deleted Posts</h1>
				<br>
				<a href="{{ route('posts.index') }}" class="btn btn-success">All posts</a>
				
				<button onclick="document.getElementById('clear_trash').submit();" class="btn btn-danger">Clear Trash</button>
				{{ Form::open(['route' => 'posts.clearTrash' , 'method' => 'DELETE' , 'id'=>'clear_trash']) }}{{ Form::close() }}
				<hr>
				<div class="panel panel-default">
					  <table class="table table-bordered">
						    <thead>
						      <tr>
						        <th>#</th>
						        <th>Title</th>
						        <th>Slug</th>
						        <th width="35%">Body</th>
						        <th>Created at</th>
						        <th>Action</th>
						      </tr>
						    </thead>
						    <tbody>
								@foreach($posts as $post)
									<tr>
										<td>{{ $post->id }}</td>
										<td>{{ $post->title }}</td>
										<td>{{ $post->slug }}</td>
										<td>{{ substr($post->body, 0 , 120) }} {{ strlen($post->body) > 120 ? '[....]' : '' }}</td>
										<td>{{ $post->created_at }}</td>
										<td>
											<div class="btn-group">
												<button onclick="return getElementById('post-restore-{{ $post->id }}').submit()" class="btn btn-primary">Restore</button>
												<button onclick="return getElementById('post-forceDelete-{{ $post->id }}').submit()" class="btn btn-danger">Delete</button>
											</div>
											<form action="{{ route('posts.restore' , $post->id) }}" id="post-restore-{{ $post->id }}" method="POST">
												<input type="hidden" name="_method" value="PUT">
												{{ csrf_field() }}
											</form>
											<form action="{{ route('posts.forceDelete' , $post->id) }}" id="post-forceDelete-{{ $post->id }}" method="POST">
												<input type="hidden" name="_method" value="DELETE">
												{{ csrf_field() }}
											</form>
										</td>
									</tr>
								@endforeach
						    </tbody>
					   </table>
				</div>
				<div class="text-center">
					{!! $posts->links() !!}
				</div>
			</div>
		</div>
	</div>
@endsection