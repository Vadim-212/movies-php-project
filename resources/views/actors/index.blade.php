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
            Актёры
        </h1>

        @if($isAdmin)
            <a href="{{ route('actors.create') }}" class="ml-auto btn btn-success">
                Добавить актёра
            </a>
        @endif

    </div>

    <div class="row">

        <div class="col-md-9">

            @include('components.actors-list')

        </div>

        <div class="col-md-3">
            <div class="mb-3">

            </div>
        </div>

    </div>

@endsection
