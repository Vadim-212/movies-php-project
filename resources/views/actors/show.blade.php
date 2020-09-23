<?php
    if(isset(config('app.admins')[auth()->user()->id])) {
        if(config('app.admins')[auth()->user()->id] == auth()->user()->email) {
            $isAdmin = true;
        }
    }
    $isAdmin = $isAdmin ?? null;
?>

@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center">
        <p class="h3 mb-0">{{ $actor->name }}</p>

        <div class="ml-auto">
            <div class="d-flex align-items-center justify-content-end">
                @if($isAdmin)
                    <a href="{{ route('actors.edit', $actor) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('actors.destroy', $actor) }}" method="post">
                        @csrf @method('delete')
                        <button class="btn btn-danger">Удалить</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <p class="h6">{{ $actor->original_name }}</p>

    <hr style="border-style: dashed;">

    @if($actor->image_path)
        <img src="{{ Storage::url($actor->image_path) }}" alt="{{ $actor->name }}">
        <hr style="border-style: dashed;">
    @endif

    <div class="mb-3 d-flex">
        <div>
            {{ $actor->date_of_birth }}
        </div>
        <div class="ml-auto">
            {{ $actor->country->name }}
        </div>
    </div>

    <div class="card card-body lead">
{{--        {!! nl2br($movie->description) !!}--}}
    </div>

    <hr style="border-style: dashed;">

    <div class="d-flex justify-content-end">

    </div>

@endsection
