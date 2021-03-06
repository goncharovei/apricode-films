<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('actors') ? ' has-error' : ''}}">
    {!! Form::label('actor', 'Actor: ', ['class' => 'control-label']) !!}
    {!! Form::select('actors[]', $actors, !empty($film_actors) ? $film_actors : [], ['class' => 'form-control', 'multiple' => true]) !!}
</div>
<div class="form-group{{ $errors->has('date_release') ? 'has-error' : ''}}">
    {!! Form::label('date_release', 'Date Release', ['class' => 'control-label']) !!}
    {!! Form::text('date_release', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('date_release', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image (Recommended size 200x200 px)', ['class' => 'control-label']) !!}
    {!! Form::file('image', ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
	@if (!empty($film->image))
	{{ $film->image }}
	@endif
</div>
<div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

@section('scripts')
<script type="text/javascript">
	$(function () {
		$("#date_release").datepicker({
			dateFormat: "yy-mm-dd"
		});
		
	});
</script>
@endsection 