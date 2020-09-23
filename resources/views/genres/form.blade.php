<?php
    $genre = $genre ?? null;
?>

@extends('layouts.app')

@section('content')

    <div class="h3 mb-3">
        {{ $genre ? 'Редактировать жанр' : 'Добавить жанр' }}
    </div>

    <div class="row">
        <div class="col-md-4">

            <form class="card card-body"
                  action="{{ $genre ? route('genres.update', $genre) : route('genres.store') }}"
                  method="post">
                @csrf
                @if($genre)
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="name">Название</label>
                    <input id="name" name="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Введите название..." value="{{ old('name', $genre->name ?? null) }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button class="btn btn-primary">{{ $genre ? 'Изменить' : 'Добавить' }}</button>
            </form>
        </div>
    </div>

@endsection
