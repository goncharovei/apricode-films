<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use App\Actor;

class FilmsController extends Controller {
	/**
	 * The films list
	 * 
	 * @param Request $request
	 * @return \Illuminate\View\View
	 */
	public function index(Request $request) {

		$request_param_name_actor = Actor::REQUEST_PARAM_NAME_ON_FILMS;
		$request_actor_id = $request->input($request_param_name_actor);
		$request_actor = !empty($request_actor_id) ? Actor::find($request_actor_id) : null;
		$is_films_by_actor = !empty($request_actor);
		if (!empty($request_actor_id) && !$is_films_by_actor) {
			abort(404);
		}
		
		$actor_name = $is_films_by_actor ? $request_actor->full_name : '';
		
		$pager_settings = Film::PAGER_SETTINGS;
		$pager_list_size = $request->cookie(
				$pager_settings['cookie']['param_name'],
				$pager_settings['list_size']['default']
		);
		
		
		$items = Film::latest();
		if ($is_films_by_actor) {
			$items->whereHas('actors', function ($query) use ($request_actor) {
				$query->where('id', $request_actor->id);
			});
		}
		$items = $items->paginate($pager_list_size);

		$is_show_toggle_page_size = Film::count() > $pager_settings['list_size']['default'];

		return view('index', compact('items', 'is_show_toggle_page_size',
			'pager_list_size', 'pager_settings', 'request_param_name_actor', 
			'actor_name', 'is_films_by_actor'));
	}
	/**
	 * The detail of film
	 * 
	 * @param int $id
	 * @return \Illuminate\View\View
	 */
	public function detail(int $id) {

		$item = Film::find($id);
		if (empty($item)) {
			abort(404);
		}

		return view('film_detail', compact('item'));
	}

}
