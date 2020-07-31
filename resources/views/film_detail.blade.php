@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<div class="card">
				<div class="card-header">
					{{ trans('films.details_about_the_film') }}
				</div>
				<div class="card-body">
					<h1 class="h4 card-title">{{ $item->name }}</h1>
					<p class="card-text">
						@if (!empty($item->description))
							<h5>{{ trans('films.description') }}:</h5>
							<p>{{ nl2br($item->description) }}</p>
						@endif
						@if (!$item->actors->isEmpty())
							<h5>{{ trans('films.actor') }}:</h5>
							{!! implode('<br>', $item->verboseActors()) !!}
						@endif
					</p>
					
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
