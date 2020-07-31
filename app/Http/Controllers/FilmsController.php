<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;

class FilmsController extends Controller {

	public function index() {
		$perPage = 10;
		$items = Film::latest()->paginate($perPage);
		$is_show_toggle_page_size = Film::count() > $perPage;
		
		return view('index', compact('items', 'is_show_toggle_page_size'));
	}

}
