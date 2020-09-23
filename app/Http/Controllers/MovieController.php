<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieFormRequest;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $perPage = 5;

    public function index()
    {
        $movies = Movie::query()
            ->latest()
            ->paginate($this->perPage);

        return view('movies.index', [
            'movies' => $movies
        ]);
    }

    public function byGenre(Genre $genre) {
        $movies = $genre->movies()->latest()->paginate($this->perPage);
        $table = $genre->getTable();

        return view('movies.by-genre', [
            'movies' => $movies,
            'genre' => $genre
        ]);
    }

    public function create()
    {
        $this->authorize('create', Movie::class);
        $countries = Country::query()->orderBy('name')->get();
        $genres = Genre::query()->orderBy('name')->get();
        return view('movies.form', [
            'countries' => $countries,
            'genres' => $genres
        ]);
    }

    public function store(MovieFormRequest $request)
    {
        $this->authorize('create', Movie::class);
        $movie = Movie::query()->create($this->getData($request));
        return redirect()->route('movies.show', $movie);
    }

    public function show(Movie $movie)
    {
        $this->authorize('view', $movie);
        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);
        $countries = Country::query()->orderBy('name');
        $genres = Genre::query()->orderBy('name');
        return view('movies.form', [
            'movie' => $movie,
            'countries' => $countries,
            'genres' => $genres
        ]);
    }

    public function update(MovieFormRequest $request, Movie $movie)
    {
        $this->authorize('update', $movie);
        $movie->update($this->getData($request));
        return redirect()->route('movies.show', $movie);
    }

    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);
        $movie->delete();
        return redirect()->route('movies.index');
    }

    protected function uploadImage(MovieFormRequest $request) {
        if(!$request->hasFile('image'))
            return null;

        return $request->file('image')->store('public/images');
    }

    protected function getData(MovieFormRequest $request) {
        $data  = $request->validated();
        $data['image_path'] = $this->uploadImage($request);
        unset($data['image']);
        return $data;
    }
}
