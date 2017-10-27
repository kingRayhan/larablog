<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Blog @yield('title')</title>
    
    {{ Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}
    

    {{ Html::style('themes/bootstrap-'.$theme.'.css') }}

    @if( $theme == 'flatly' )
    <style>
        body{
            background-color: #F5F8FA;
        }
    </style>

    @endif
    {{ Html::style('/style.css') }}
    @yield('stylesheets')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @if(!empty($css))
    <style>
        {{$css}}
    </style>
    @endif
</head>
<body>
    <div id="app">
        @include('partials._nav')
        
        <div class="flash-messege container">
            @include('partials._messages')
        </div>

        @yield('content')




        @include('partials._footer')
        {{ Html::script('/js/app.js') }}
        {{ Html::script('/js/jquery.scrollUp.min.js') }}
        @yield('scripts')
        @if(!empty($js))
            <script>
                {{ $js }}
            </script>
        @endif
    </div>
</body>
</html>
