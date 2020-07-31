<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actor;

class ActorsController extends Controller {

	public function index(Request $request) {

		$pager_settings = Actor::PAGER_SETTINGS;
		$pager_list_size = $request->cookie(
			$pager_settings['cookie']['param_name'],
			$pager_settings['list_size']['default']	
		);
		
		$items = Actor::latest()->paginate($pager_list_size);
		$actors_count = Actor::count();
		if ($actors_count > 0 && $items->isEmpty()) {
			abort(404);
		}
		
		$is_show_toggle_page_size = $actors_count > $pager_settings['list_size']['default'];

		return view('actor_list', compact('items', 'is_show_toggle_page_size', 'pager_list_size', 'pager_settings'));
	}
	
	
}
