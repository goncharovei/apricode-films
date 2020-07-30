<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Actor;
use App\Film;
use Illuminate\Http\Request;

class ActorsController extends Controller
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
            $actors = Actor::where('full_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $actors = Actor::latest()->paginate($perPage);
        }

        return view('admin.actors.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $films = Film::all();
        $films = $films->isEmpty() ? [] : $films->pluck('name', 'id')->all();
		
		return view('admin.actors.create', compact('films'));
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
        $this->validate($request, [
			'full_name' => 'required',
			'image' => 'image|max:1024',
		]);
        $requestData = $request->all();
        
		$uploaded_filename = Actor::storeFileFromRequest('image', $request);
		if (!empty($uploaded_filename)) {
			$requestData['image'] = $uploaded_filename;
		}
        $actor = Actor::create($requestData);
		$actor->films()->sync($request->films);
		
        return redirect('admin/actors')->with('flash_message', 'Actor added!');
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
        $actor = Actor::findOrFail($id);

        return view('admin.actors.show', compact('actor'));
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
        $actor = Actor::findOrFail($id);
		
		$actor_films = $actor->films->isEmpty() ? [] : $actor->films()->pluck('id', 'name')->all();
		$films = Film::all();
        $films = $films->isEmpty() ? [] : $films->pluck('name', 'id')->all();
		
        return view('admin.actors.edit', compact('actor', 'actor_films', 'films'));
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
        $this->validate($request, [
			'full_name' => 'required',
			'image' => 'image|max:1024',
		]);
        $requestData = $request->all();
        
        $actor = Actor::findOrFail($id);
		
		$uploaded_filename = Actor::storeFileFromRequest('image', $request);
		if (!empty($uploaded_filename)) {
			$requestData['image'] = $uploaded_filename;
		}
        $actor->update($requestData);
		$actor->films()->sync($request->films);
		
        return redirect('admin/actors')->with('flash_message', 'Actor updated!');
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
        Actor::destroy($id);

        return redirect('admin/actors')->with('flash_message', 'Actor deleted!');
    }
}
