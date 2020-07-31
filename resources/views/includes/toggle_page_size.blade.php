@if (!empty($is_show_toggle_page_size))
	<ul class="nav justify-content-end pb-2">
		<li>
			<select id="js_toggle_page_size" class="form-control">
				@foreach ($pager_settings['list_size']['items'] as $list_size_number)
				<option {{ $list_size_number == $pager_list_size ? 'selected' : '' }} value="{{ $list_size_number }}">{{ $list_size_number }}</option>
				@endforeach
			</select>
		</li>	
	</ul>
	@section('footer_script')
	<script type="text/javascript" src="{{ asset('js/plugins/jquery.cookie.js') }}"></script>
	<script type="text/javascript">
		window.pager_settings = <?=json_encode($pager_settings['cookie'])?>;
	</script>
	<script type="text/javascript" src="{{ asset('js/toggle_page_size.js') }}"></script>
	@endsection
@endif