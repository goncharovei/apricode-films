@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="h4">{{ trans('cinema.actors') }}</h1>
			@if (!$items->isEmpty())
				@include('includes.toggle_page_size')
			
				@foreach ($items as $item)
				<div class="card">
					<div class="card-body">
						@if (!empty($item->image))
						<div class="float-left pr-3">
							<img class="img-thumbnail" src="{{ $item->verboseUrl('image') }}" alt="{{ $item->full_name }}" title="{{ $item->full_name }}">
						</div>	
						@endif

						<a href="{{ route('film_list', [$request_param_name_on_films => $item->id]) }}">{{ $item->full_name }}</a>
						@if (!empty($item->date_birth))
						<div>{{ trans('actors.date_of_birth') }}: {{ $item->date_birth }}</div>
						@endif

					</div>
				</div>
				@endforeach
			@else
			<p>{{ trans('cinema.list_is_empty') }}</p>
			@endif
			<div class="mt-3"> {!! $items->render() !!} </div>
        </div>
    </div>
</div>
@endsection
