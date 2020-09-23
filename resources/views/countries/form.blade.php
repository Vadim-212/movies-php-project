<?php
    $country = $country ?? null;
?>

@extends('layouts.app')

@section('content')

    <div class="h3 mb-3">
        {{ $country ? 'Редактировать страну' : 'Добавить страну' }}
    </div>

    <div class="row">
        <div class="col-md-4">

            <form class="card card-body"
                  action="{{ $country ? route('countries.update', $country) : route('countries.store') }}"
                  method="post">
                @csrf
                @if($country)
                    @method('put')
                @endif
                <div class="form-group">
                    <label for="name">Название</label>
                    <input id="name" name="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Введите название..." value="{{ old('name', $country->name ?? null) }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button class="btn btn-primary">{{ $country ? 'Изменить' : 'Добавить' }}</button>
            </form>
        </div>
    </div>

@endsection
