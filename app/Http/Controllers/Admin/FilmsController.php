<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Film;
use App\Actor;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $films = Film::where('name', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $films = Film::latest()->paginate($perPage);
        }

        return view('admin.films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
		$actors = Actor::all();
        $actors = $actors->isEmpty() ? [] : $actors->pluck('full_name', 'id')->all();
		
		return view('admin.films.create', compact('actors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, Film::validationRuls());
        $requestData = $request->all();
		
        $film = Film::create($requestData);
		$film->storeFileFromRequest('image', $request);
		$film->actors()->sync($request->actors);
		
        return redirect('admin/films')->with('flash_message', 'Film added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $film = Film::findOrFail($id);

        return view('admin.films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $film = Film::findOrFail($id);
		
		$film_actors = $film->actors->isEmpty() ? [] : $film->actors()->pluck('id', 'full_name')->all();
		$actors = Actor::all();
        $actors = $actors->isEmpty() ? [] : $actors->pluck('full_name', 'id')->all();
		
        return view('admin.films.edit', compact('film', 'film_actors', 'actors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, Film::validationRuls());
        $requestData = $request->all();
		
        $film = Film::findOrFail($id);
	
        $film->update($requestData);
		$film->storeFileFromRequest('image', $request);
		$film->actors()->sync($request->actors);
		
        return redirect('admin/films')->with('flash_message', 'Film updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $film = Film::findOrFail($id);
		$film->deleteFile('image');
		$film->delete();
				
        return redirect('admin/films')->with('flash_message', 'Film deleted!');
    }
}
