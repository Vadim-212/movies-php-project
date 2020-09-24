<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieFormRequest;
use App\Models\Actor;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $perPage = 10;

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

        return view('movies.by-genre', [
            'movies' => $movies,
            'genre' => $genre
        ]);
    }

    public function byActor(Actor $actor) {
        $movies = $actor->movies()->latest()->paginate($this->perPage);

        return view('movies.by-actor', [
            'movies' => $movies,
            'actor' => $actor
        ]);
    }

    public function create()
    {
        $this->authorize('create', Movie::class);
        $countries = Country::query()->orderBy('name')->get();
        $genres = Genre::query()->orderBy('name')->get();
        $actors = Actor::query()->orderBy('name')->get();
        return view('movies.form', [
            'countries' => $countries,
            'genres' => $genres,
            'actors' => $actors
        ]);
    }

    public function store(MovieFormRequest $request)
    {
        $this->authorize('create', Movie::class);
        //dd($request->validated());
        $data = $this->getData($request);
        $movie = Movie::query()->create($data);
        $movie->actors()->sync($data['actors']);
        return redirect()->route('movies.show', $movie);
    }

    public function show(Movie $movie)
    {
        //$this->authorize('view', $movie);
        //$movie->actors()->save(Actor::query()->find(1));
        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);
        $countries = Country::query()->orderBy('name')->get();
        $genres = Genre::query()->orderBy('name')->get();
        $actors = Actor::query()->orderBy('name')->get();
        return view('movies.form', [
            'movie' => $movie,
            'countries' => $countries,
            'genres' => $genres,
            'actors' => $actors
        ]);
    }

    public function update(MovieFormRequest $request, Movie $movie)
    {
        $this->authorize('update', $movie);
        $data = $this->getData($request);
        $movie->update($data);
        $movie->actors()->sync($data['actors']);
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
