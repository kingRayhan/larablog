@extends('layouts.app')

@section('title', '| Blog')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

            <div>
                <ol class="breadcrumb">
                  <li><a href="{{ route('home') }}">Home</a></li>
                  <li class="active">Blog</li>
                </ol>
            </div>

                @include('inc.post_loop')

                <div class="text-center">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection