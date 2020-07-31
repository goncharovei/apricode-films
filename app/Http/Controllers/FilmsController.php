<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;

class FilmsController extends Controller {

	public function index(Request $request) {

		$pager_settings = Film::PAGER_SETTINGS;
		$pager_list_size = $request->cookie($pager_settings['cookie']['param_name']);
		
		$items = Film::latest()->paginate($pager_list_size);
		$is_show_toggle_page_size = Film::count() > $pager_settings['list_size']['default'];

		return view('index', compact('items', 'is_show_toggle_page_size', 'pager_list_size', 'pager_settings'));
	}
	
	public function detail(int $id) {
		
		$item = Film::find($id);
		if (empty($item)) {
			abort(404);
		}
		
		return view('film_detail', compact('item'));
	}
	
}
