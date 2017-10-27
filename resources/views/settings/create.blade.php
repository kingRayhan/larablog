@extends('layouts.app')
@section('title' , '| Settings')
@section('stylesheets')
{{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.20.2/codemirror.css') }}

@stop

@section('scripts')
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.20.2/codemirror.js') }}
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.20.2/mode/css/css.min.js') }}
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.20.2/mode/javascript/javascript.min.js') }}
<script>
jQuery(document).ready(function($) {
    CodeMirror.fromTextArea(document.getElementById('css_editor'), {
      mode: "text/css",
      lineNumbers: true,
      tabMode: "indent"
    });

    CodeMirror.fromTextArea(document.getElementById('js_editor'), {
      mode: "text/javascript",
      lineNumbers: true,
      tabMode: "indent"
    });
});
</script>

@stop
@section('content')
	{{ Form::open(['route' => 'settings.store' , 'method' => 'POST']) }}
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">

				<div class="panel panel-default">
					<div class="panel-heading">Select Theme</div>
					<div class="panel-body">
						<div class="form-group">
							<select name="theme" class="form-control">
				                <option value="default">Default</option>
				                <option value="cerulean">Cerulean</option>
				                <option value="cosmo">Cosmo</option>
				                <option value="cyborg">Cyborg</option>
				                <option value="darkly">Darkly</option>
				                <option selected="selected" value="flatly">Flatly</option>
				                <option value="journal">Journal</option>
				                <option value="lumen">Lumen</option>
				                <option value="paper">Paper</option>
				                <option value="readable">Readable</option>
				                <option value="sandstone">Sandstone</option>
				                <option value="simplex">Simplex</option>
				                <option value="slate">Slate</option>
				                <option value="spacelab">Spacelab</option>
				                <option value="superhero">Superhero</option>
				                <option value="united">United</option>
				                <option value="yeti">Yeti</option>
							</select>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Custom CSS</div>
					<div class="panel-body">
						<div class="form-group">
							{{ Form::textarea('css', NULL ,['class' => 'form-control' ,'id' => 'css_editor' , 'style' => 'width:100%']) }}
						</div>
					</div>
				</div>



				<div class="panel panel-default">
					<div class="panel-heading">Custom JS</div>
					<div class="panel-body">
						<div class="form-group">
							{{ Form::textarea('js',NULL,['class' => 'form-control js_editor' , 'id' => 'js_editor', 'style' => 'width:100%;']) }}
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Footer Text</div>
					<div class="panel-body">
						<div class="form-group">
							{{ Form::textarea('footer_text',NULL,['class' => 'form-control' , 'style' => 'width:100%;height:95px;']) }}
						</div>
					</div>
				</div>


				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Save settings</button>
				</div>



			</div>
		</div>
	</div>
	{{ Form::close() }}
@endsection