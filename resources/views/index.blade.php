@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="h4">{{ trans('cinema.films') }}</h1>
			<ul class="nav justify-content-end pb-2">
				<li><select class="form-control">
					<option>10</option>
					<option>25</option>
					<option>50</option>
					<option>100</option>
				</select></li>	
			</ul>
			<div class="card">
				<div class="card-body">
					<img src="..." alt="..." class="img-thumbnail">
					<a href="">This is some text within a card body.</a>
					<p>{{ trans('films.release_date') }}: 20/30/200</p>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
