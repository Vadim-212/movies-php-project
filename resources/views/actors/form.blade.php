<?php
    $actor = $actor ?? null;
?>

@extends('layouts.app')

@section('content')

    <div class="h3">
        {{ $actor ? 'Редактирование актёра' : 'Добавить актёра' }}
    </div>

    <div class="row">
        <div class="col-mb-4">
            <form action="{{ $actor ? route('actors.update', $actor) : route('actors.store') }}"
                  class="card card-body" method="post" enctype="multipart/form-data">
                @csrf
                @if($actor) @method('put') @endif
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Введите имя..." value="{{ old('name', $actor->name ?? null)  }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="original_name">Оригинальное имя</label>
                    <input type="text" id="original_name" name="original_name"
                           class="form-control @error('original_name') is-invalid @enderror"
                           placeholder="Введите оригинальное имя..." value="{{ old('original_name', $actor->original_name ?? null)  }}">
                    @error('original_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Дата рождения</label>
                    <input class="form-control"
                           type="date"
                           name="date_of_birth" id="date_of_birth"
                           placeholder="Введите дату рождения..." value="{{ old('date_of_birth', $actor->date_of_birth ?? null) }}">
                </div>
                <div class="form-group">
                    <label for="country_id">Страна</label>
                    <select id="country_id" class="form-control @error('country_id') is-invalid @enderror"
                            name="country_id">
                        @foreach($countries as $country)
                            <option {{ old('country_id', $actor->country_id ?? null) == $country->id ? 'selected' : '' }}
                                    value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Изображение</label>
                    <div class="custom-file is-invalid">
                        <input type="file" accept=".jpg,.png,.bmp,.jpeg,.gif,.webp"
                               class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                        <label class="custom-file-label" for="image">Выберите изображение...</label>
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary">{{ $actor ? 'Изменить' : 'Добавить' }}</button>

            </form>
        </div>
    </div>

@endsection
