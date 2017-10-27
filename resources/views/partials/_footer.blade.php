<footer class="well">
    <div class="container">
        <p class="text-muted">
			
			@if(empty($footer_text))
        			<strong><a href="{{ route('home') }}">{{ config('app.name') }}</a></strong> a simple laravel blog application by <a href="https://www.facebook.com" target="_blank"><b>@KingRayhan</b></a>
			@else
				{!! $footer_text !!}
			@endif
        </p>
    </div>
</footer>