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
	{{ Form::open(['route' => ['settings.update',$settings->id] , 'method' => 'PUT']) }}
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">


				<div class="panel panel-default">
					<div class="panel-heading">Select Theme</div>
					<div class="panel-body">
						<div class="form-group">
							<select name="theme" class="form-control">
<option {{ ($settings->theme == 'default') ? 'selected' : NULL }} value="default">Default</option>
<option {{ ($settings->theme == 'cerulean') ? 'selected' : NULL }} value="cerulean">Cerulean</option>
<option {{ ($settings->theme == 'cosmo') ? 'selected' : NULL }} value="cosmo">Cosmo</option>
<option {{ ($settings->theme == 'cyborg') ? 'selected' : NULL }} value="cyborg">Cyborg</option>
<option {{ ($settings->theme == 'darkly') ? 'selected' : NULL }} value="darkly">Darkly</option>
<option {{ ($settings->theme == 'flatly') ? 'selected' : NULL }} value="flatly">Flatly</option>
<option {{ ($settings->theme == 'journal') ? 'selected' : NULL }} value="journal">Journal</option>
<option {{ ($settings->theme == 'lumen') ? 'selected' : NULL }} value="lumen">Lumen</option>
<option {{ ($settings->theme == 'paper') ? 'selected' : NULL }} value="paper">Paper</option>
<option {{ ($settings->theme == 'readable') ? 'selected' : NULL }} value="readable">Readable</option>
<option {{ ($settings->theme == 'sandstone') ? 'selected' : NULL }} value="sandstone">Sandstone</option>
<option {{ ($settings->theme == 'simplex') ? 'selected' : NULL }} value="simplex">Simplex</option>
<option {{ ($settings->theme == 'slate') ? 'selected' : NULL }} value="slate">Slate</option>
<option {{ ($settings->theme == 'spacelab') ? 'selected' : NULL }} value="spacelab">Spacelab</option>
<option {{ ($settings->theme == 'superhero') ? 'selected' : NULL }} value="superhero">Superhero</option>
<option {{ ($settings->theme == 'united') ? 'selected' : NULL }} value="united">United</option>
<option {{ ($settings->theme == 'yeti') ? 'selected' : NULL }} value="yeti">Yeti</option>
							</select>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Custom CSS</div>
					<div class="panel-body">
						<div class="form-group">
							{{ Form::textarea('css',$settings->css,['class' => 'form-control' ,'id' => 'css_editor' , 'style' => 'width:100%']) }}
						</div>
					</div>
				</div>



				<div class="panel panel-default">
					<div class="panel-heading">Custom JS</div>
					<div class="panel-body">
						<div class="form-group">
							{{ Form::textarea('js',$settings->js,['class' => 'form-control js_editor' , 'id' => 'js_editor', 'style' => 'width:100%;']) }}
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">Footer Text</div>
					<div class="panel-body">
						<div class="form-group">
							{{ Form::textarea('footer_text',$settings->footer_text,['class' => 'form-control' , 'style' => 'width:100%;height:95px;']) }}
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