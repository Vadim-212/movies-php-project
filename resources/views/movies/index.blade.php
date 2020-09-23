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

    <div class="d-flex align-items-center mb-3">

        <h1 class="h3 mb-0">
            Фильмы
        </h1>

        @if($isAdmin)
            <a href="{{ route('movies.create') }}" class="ml-auto btn btn-success">
                Добавить фильм
            </a>
        @endif

    </div>

    <div class="row">

        <div class="col-md-9">

            @include('components.movies-list')

        </div>

        <div class="col-md-3">
            <div class="mb-3">

            </div>
        </div>

    </div>

@endsection
