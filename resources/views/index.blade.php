@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="h4">
				{{ trans('cinema.films') }}
				@if (!empty($is_films_by_actor))
					{{ trans('films.by') }} {{ $actor_name }}
				@endif
			</h1>
			@if (!$items->isEmpty())
				@include('includes.toggle_page_size')
			
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
			<div class="mt-3"> {!! $items->appends([$request_param_name_actor => Request::get($request_param_name_actor)])->render() !!} </div>
        </div>
    </div>
</div>
@endsection
