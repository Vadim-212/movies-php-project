@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center mb-3">

        <h1 class="h1 mb-0">
            Главная
        </h1>

    </div>

    <div class="row">

        <div class="col-md-9">

            <a class="card card-body mb-3 index-link" href="{{ route('movies.index') }}">
                <div class="h4">
                    Фильмы
                </div>
            </a>
            @auth
                <a class="card card-body mb-3 index-link" href="{{ route('actors.index') }}">
                    <div class="h4">
                        Актёры
                    </div>
                </a>
            @endauth

        </div>

        <div class="col-md-3">

        </div>

    </div>

@endsection
