@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>Edit category</strong></div>
					<div class="panel-body">
						{{ Form::open(['route' => ['category.update',$cat->id] , 'method' => 'PUT']) }}
							<div class="form-group">
								{{ Form::text('name' , $cat->name , ['class' => 'form-control' , 'placeholder' => 'Category Name']) }}
							</div>
							<div class="form-group">
								{{ Form::textarea('description' , $cat->description , ['class' => 'form-control' , 'placeholder' => 'Category Description']) }}
							</div>
							<button type="submit" class="btn btn-primary">Update</button>
							
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection