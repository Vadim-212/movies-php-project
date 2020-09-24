@auth
    <?php
    if(isset(config('app.admins')[auth()->user()->id])) {
        if(config('app.admins')[auth()->user()->id] == auth()->user()->email) {
            $isAdmin = true;
        }
    }
    ?>
@endauth
<?php
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

    <div>
    <div class="mb-3 d-flex">
        <div>
            @if($actor->image_path)
                <img src="{{ Storage::url($actor->image_path) }}" alt="{{ $actor->name }}"
                     style="width: 200px; height: 300px;">
            @else
                <img src="{{ Storage::url('public/images/image_stub.png') }}" alt="image_stub"
                     style="width: 200px; height: 300px;">
            @endif
        </div>
        <div>
            {{ \Carbon\Carbon::parse($actor->date_of_birth)->format('d.m.Y') }}
            ({{ \Carbon\Carbon::parse($actor->date_of_birth)->diffInYears(today()->diffInYears())}})
        </div>
        <div class="ml-auto">
            {{ $actor->country->name }}
        </div>
    </div>
        <div class="h3"><a href="{{ route('actor.movies', $actor) }}" class="badge badge-primary mr-3">
            Фильмы актёра
        </a></div>

    </div>

    <hr style="border-style: dashed;">
    <div class="d-flex justify-content-end">

    </div>
@endsection

