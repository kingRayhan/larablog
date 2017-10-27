@extends('layouts.app')

@section('title', '| Create New Post')

@section('stylesheets')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.min.css') !!}
@endsection
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/codemirror.js') !!}
	{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/xml/xml.js') !!}
	{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/htmlmixed/htmlmixed.js') !!}
	{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.10.0/mode/css/css.js') !!}
	{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js') !!}
	<script type="text/javascript">
	  $('form').parsley();
$(document).ready(function() {
    
    // tooltips on hover
    $('[data-toggle=\'tooltip\']').tooltip({container: 'body', html: true});

    // Makes tooltips work on ajax generated content
    $(document).ajaxStop(function() {
        $('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
    });

    $('[data-toggle=\'tooltip\']').on('remove', function() {
        $(this).tooltip('destroy');
    });


    var editor = document.getElementById('text-editor');

    $("#text-editor").each(function (i) {
        
        editor = CodeMirror.fromTextArea(this, {
            lineNumbers: true,
            mode: 'html'
            
        });

        editor.on("change", function() {
            document.getElementById('question-preview').innerHTML = editor.getValue('<br>')
            .replace('<?','&lt;?')
            .replace('?>', '?&gt;')
            .replace('<script>', '&lt;script&gt;')
            .replace('<script>', '&lt;/script&gt;')
            .replace('<div>', '&lt;div&gt;')
            .replace('</div>', '&lt;/div&gt;')
            
        });

        //$('#hr').append('<hr />');

        $('a[role="button"]').click(function(){

            var val = $(this).data('val');
            var string = editor.getSelection();
              
            switch(val){
                
                case 'bold': 
                    editor.replaceSelection('<b>' + string + '</b>');
                break;

                case 'italic': 
                    editor.replaceSelection('<i>' + string + '</i>');
                break;

                case 'quote': 
                    editor.replaceSelection('<blockquote><p>' + string + '</p></blockquote>');
                break;

                case 'code': 
                    editor.replaceSelection('<pre><code>' + string + '</code></pre>');
                break;
                
                case 'align_left': 
                    editor.replaceSelection('<p style="text-align:left">' + string + '</p>');
                break;
                case 'align_center': 
                    editor.replaceSelection('<p style="text-align:center">' + string + '</p>');
                break;
                case 'align_right': 
                    editor.replaceSelection('<p style="text-align:right">' + string + '</p>');
                break;

                case 'hr': 
                    editor.replaceSelection('<hr/>');
                    
                break;
            }

        });

        $(".dropdown-menu li a[class='btn-heading']").click(function(){
            var val = $(this).data('val');
            var string = editor.getSelection();

            switch(val){
                case 'h1': 
                    editor.replaceSelection('<h1>' + string + '</h1>');
                break;
                case 'h2': 
                    editor.replaceSelection('<h2>' + string + '</h2>');
                break;
                case 'h3': 
                    editor.replaceSelection('<h3>' + string + '</h3>');
                break;
                case 'h4': 
                    editor.replaceSelection('<h4>' + string + '</h4>');
                break;
                case 'h5': 
                    editor.replaceSelection('<h5>' + string + '</h5>');
                break;
                case 'h6': 
                    editor.replaceSelection('<h6>' + string + '</h6>');
                break;
            }
        });
    });
});


	</script>
@endsection


@section('content')
{!! Form::open(['route' => 'posts.store' , 'data-parsely-validate' => '']) !!}
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
						<h3>Create New Post</h3>
						<div class="form-group">
							{!! Form::label('title','Title') !!}
							{!! Form::text('title' , NULL , ['class' => 'form-control' , 'placeholder' => 'Post Title' ,'data-parsley-required' => '' , 'data-parsley-maxlength' =>'255']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('slug','Slug') !!}
							{!! Form::text('slug' , NULL , ['class' => 'form-control' , 'placeholder' => 'Slug' ,'data-parsley-required' => '' , 'data-parsley-maxlength' =>'255']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('category','Select category') !!}
							@if( count($categories) )
								<select name="category_id" id="category" class="form-control">
									@foreach( $categories as $cat )
										<option value="{{ $cat->id }}">{{ $cat->name }}</option>
									@endforeach
								</select>
							@else
							<div class="well">
								No category created.&nbsp;&nbsp;&nbsp;<a href="{{ route('category.index') }}">Add one</a>
							</div>
							@endif
						</div>


			</div>
		</div>{{-- .row --}}
		<div class="row">
	        <div class="col-md-6 col-sm-6">
	            <div class="panel panel-default" onLoad="text_editor();">
	                <div class="panel-heading">

	                    <ul class="nav nav-pills" id="heading">
	                        <li><a role="button" data-val="bold" data-toggle="tooltip" data-placement="bottom" title="Bold"><i class="fa fa-bold"></i></a></li>
	                        <li><a role="button" data-val="italic" data-toggle="tooltip" data-placement="bottom" title="Italic"><i class="fa fa-italic"></i></a></li>
	                        <li><a role="button" data-val="link" disabled="disabled" data-toggle="tooltip" data-placement="bottom" title="link"><i class="fa fa-link"></i></a></li>
	                        <li><a role="button" data-val="quote" data-toggle="tooltip" data-placement="bottom" title="Quote"><i class="fa fa-quote-left"></i></a></li>

<li><a role="button" data-val="hr" data-toggle="tooltip" data-placement="bottom" title="hr"><i class="fa fa-minus"></i></a></li>
<li><a role="button" data-val="align_left" data-toggle="tooltip" data-placement="bottom" title="centered"><i class="fa fa-align-left"></i>
<li><a role="button" data-val="align_center" data-toggle="tooltip" data-placement="bottom" title="centered"><i class="fa fa-align-center"></i>
<li><a role="button" data-val="align_right" data-toggle="tooltip" data-placement="bottom" title="centered"><i class="fa fa-align-right"></i></a></li>
	                        
	                        <li><a role="button" data-val="code" data-toggle="tooltip" data-placement="bottom" title="Code">{ }</a></li>
	                        <li><a role="button" data-val="hr" data-toggle="tooltip" data-placement="bottom" title="hr"><i class="fa fa-minus"></i></a></li>
	                        <li class="dropdown" data-toggle="tooltip" data-placement="top" title="heading">
	                            <a class="dropdown-toggle" role="button" data-toggle="dropdown"><i class="fa fa-header"></i> <span class="caret"></span></a>
	                            <ul class="dropdown-menu">
	                                <li><a class="btn-heading" data-val="h1">H1</a></li>
	                                <li><a class="btn-heading" data-val="h2">H2</a></li>
	                                <li><a class="btn-heading" data-val="h3">H3</a></li>
	                                <li><a class="btn-heading" data-val="h4">H4</a></li>
	                                <li><a class="btn-heading" data-val="h5">H5</a></li>
	                                <li><a class="btn-heading" data-val="h6">H6</a></li>
	                            </ul>
	                        </li>
	                    </ul>

	                </div>
	                <div class="panel-body">
	                    <textarea id="text-editor" name="body" class="form-control"></textarea>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-6">
	        	<div class="panel panel-default" style="min-height: 400px;">
	        		<div class="panel-heading"><h4>Preview</h4></div>
	        		<div class="panel-body"><div id="question-preview"></div></div>
	        	</div>
	        </div>
		</div>{{-- .row --}}
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
						<div class="form-group">
							{!! Form::submit('Create new post' , ['class' => 'btn btn-success btn-lg btn-block']) !!}
						</div>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
@endsection


