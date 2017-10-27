@extends('layouts.app')
@section('title', '| All Post')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>All Category</h4>
					</div>
					<div class="panel-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="1%">#</th>
									<th width="30%">Name</th>
									<th width="50%">Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach($cats as $cat)
								<tr>
									<td>{{ $cat->id }}</td>
									<td>{{ $cat->name }}</td>
									<td>{{ $cat->description }}</td>
									<td> 
										<div class="btn-group">
											<button class="btn btn-primary" onclick="document.getElementById('update-cat-id-{{ $cat->id }}').submit()"><i class="fa fa-pencil"></i></button>
											<button class="btn btn-danger" onclick="document.getElementById('delete-cat-id-{{ $cat->id }}').submit()"><i class="fa fa-trash"></i></button>
										</div>
										{{ Form::open(['route' => ['category.destroy',$cat->id] , 'method' => 'DELETE' ,'id' => 'delete-cat-id-'.$cat->id]) }}{{ Form::close() }}
										{{ Form::open(['route' => ['category.edit',$cat->id] , 'method' => 'GET' ,'id' => 'update-cat-id-'.$cat->id]) }}{{ Form::close() }}

									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>Create new category</strong></div>
					<div class="panel-body">
						{{ Form::open(['route' => 'category.store']) }}
							<div class="form-group">
								{{ Form::text('name' , NULL , ['class' => 'form-control' , 'placeholder' => 'Category Name']) }}
							</div>
							<div class="form-group">
								{{ Form::textarea('description' , NULL , ['class' => 'form-control' , 'placeholder' => 'Category Description']) }}
							</div>
							<button type="submit" class="btn btn-primary">Save</button>
							
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection