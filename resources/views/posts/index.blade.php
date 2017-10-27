@extends('layouts.app')
@section('title', '| All Post')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 style="">All Posts</h1>
				<br>
				<a href="{{ route('posts.create') }}" class="btn btn-success"><i class="fa fa-pencil"></i> Add new</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				@if( isset($deleted_post_count) && $deleted_post_count > 0 )
					<a href="{{ route('posts.trashed') }}" class="btn btn-danger"><i class="fa fa-trash"></i> Trashed <span class="badge">{{ $deleted_post_count }}</span></a>
				@endif
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
										<a href="{{ route('posts.show' , $post->id) }}" class="btn btn-default">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a> 
										<a href="{{ route('posts.edit' ,$post->id) }}" class="btn btn-default">
											<i class="fa fa-pencil"></i>
										</a>
										{!! Form::open(['route' => ['posts.destroy',$post->id],'method' =>'DELETE' ,'style'=>'display:inline']) !!} 
											<button type="submit" class="btn btn-default">
												<i class="fa fa-trash"></i>
											</button>
										{!! Form::close() !!}
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