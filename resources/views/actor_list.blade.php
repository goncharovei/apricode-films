@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="h4">{{ trans('cinema.films') }}</h1>
			@if (!empty($items))
				@if (!empty($is_show_toggle_page_size))
				<ul class="nav justify-content-end pb-2">
					<li><select class="form-control">
						<option>10</option>
						<option>25</option>
						<option>50</option>
						<option>100</option>
					</select></li>	
				</ul>
				@endif
				@foreach ($items as $item)
				<div class="card">
					<div class="card-body">
						@if (!empty($item->image))
						<div class="float-left pr-3">
							<img class="img-thumbnail" src="{{ $item->verboseUrl('image') }}" alt="{{ $item->name }}" title="{{ $item->name }}">
						</div>	
						@endif
						
						<a href="{{ route('film_detail', ['id' => $item->id]) }}">{{ $item->name }}</a>
						@if (!empty($item->date_release))
							<div>{{ trans('films.release_date') }}: {{ $item->date_release }}</div>
						@endif
						
					</div>
				</div>
				@endforeach
			@else
				<p>{{ trans('cinema.list_is_empty') }}</p>
			@endif
        </div>
    </div>
</div>
@endsection
