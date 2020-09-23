<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorFormRequest;
use App\Models\Actor;
use App\Models\Country;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::query()
            ->latest()
            ->paginate(5);

        return view('actors.index', [
            'actors' => $actors
        ]);
    }

    public function create()
    {
        $this->authorize('create', Actor::class);
        $countries = Country::query()->orderBy('name')->get();
        return view('actors.form', [
            'countries' => $countries
        ]);
    }

    public function store(ActorFormRequest $request)
    {
        $this->authorize('create', Actor::class);
        $actor = Actor::query()->create($this->getData($request));
        return redirect()->route('actors.show', $actor);
    }

    public function show(Actor $actor)
    {
        $this->authorize('view', $actor);
        return view('actors.show', [
            'actor' => $actor
        ]);
    }

    public function edit(Actor $actor)
    {
        $this->authorize('update', $actor);
        $countries = Country::query()->orderBy('name');
        return view('actors.form', [
            'actor' => $actor,
            'countries' => $countries
        ]);
    }

    public function update(ActorFormRequest $request, Actor $actor)
    {
        $this->authorize('update', $actor);
        $actor->update($this->getData($request));
        return redirect()->route('actors.show', $actor);
    }

    public function destroy(Actor $actor)
    {
        $this->authorize('delete', $actor);
        $actor->delete();
        return redirect()->route('actors.index');
    }

    protected function uploadImage(ActorFormRequest $request) {
        if(!$request->hasFile('image'))
            return null;

        return $request->file('image')->store('public/images');
    }

    protected function getData(ActorFormRequest $request) {
        $data  = $request->validated();
        $data['image_path'] = $this->uploadImage($request);
        unset($data['image']);
        return $data;
    }
}
