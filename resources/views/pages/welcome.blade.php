@extends('layouts.app')

@section('title', '| Homepage')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @include('inc.post_loop')
                {!! $posts->links() !!}
            </div>
            <div class="col-md-3 col-md-offset-1">
                <h2>Sidebar</h2>
            </div>
        </div>
    </div>
@endsection