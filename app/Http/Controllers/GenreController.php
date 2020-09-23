<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreFormRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Genre::class);
        $genres = $this->getGenresOrderedPaginate();
        return view('genres.index', [
            'genres' => $genres
        ]);
    }

    public function create()
    {
        $this->authorize('create', Genre::class);
        return view('genres.form');
    }

    public function store(GenreFormRequest $request)
    {
        $this->authorize('create', Genre::class);
        Genre::query()->create($request->validated());
        $genres = $this->getGenresOrderedPaginate();
        return redirect()->route('genres.index', [
            'genres' => $genres
        ]);
    }

    public function show(Genre $genre)
    {
        /*$this->authorize('view', $country);
        return view('countries.show', [
            'country' => $country
        ]);*/
    }

    public function edit(Genre $genre)
    {
        $this->authorize('update', $genre);
        return view('genres.form', [
            'genre' => $genre
        ]);
    }

    public function update(GenreFormRequest $request, Genre $genre)
    {
        $this->authorize('update', $genre);
        $genre->update($request->validated());
        $genres = $this->getGenresOrderedPaginate();
        return redirect()->route('genres.index', [
            'genres' => $genres
        ]);
    }

    public function destroy(Genre $genre)
    {
        $this->authorize('delete', $genre);
        $genre->delete();
        return back();
    }

    function getGenresOrderedPaginate() {
        return Genre::query()
            ->orderBy('name')
            ->paginate(10);
    }
}
