<div class="form-group{{ $errors->has('full_name') ? 'has-error' : ''}}">
    {!! Form::label('full_name', 'Full Name', ['class' => 'control-label']) !!}
    {!! Form::text('full_name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('full_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('films') ? ' has-error' : ''}}">
    {!! Form::label('film', 'Film: ', ['class' => 'control-label']) !!}
    {!! Form::select('films[]', $films, !empty($actor_films) ? $actor_films : [], ['class' => 'form-control', 'multiple' => true]) !!}
</div>
<div class="form-group{{ $errors->has('date_birth') ? 'has-error' : ''}}">
    {!! Form::label('date_birth', 'Date Birth', ['class' => 'control-label']) !!}
    {!! Form::text('date_birth', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('date_birth', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image (Recommended size 200x200 px)', ['class' => 'control-label']) !!}
    {!! Form::file('image',('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
	@if (!empty($actor->image))
	{{ $actor->image }}
	@endif
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

@section('scripts')
<script type="text/javascript">
	$(function () {
		$("#date_birth").datepicker({
			dateFormat: "yy-mm-dd"
		});
		
	});
</script>
@endsection 
