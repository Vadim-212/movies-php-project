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
        <p class="h3 mb-0">{{ $movie->name }}</p>

        <div class="ml-auto">
            <div class="d-flex align-items-center justify-content-end">
                @if($isAdmin)
                    <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning">Редактировать</a>
                    <form action="{{ route('movies.destroy', $movie) }}" method="post">
                        @csrf @method('delete')
                        <button class="btn btn-danger">Удалить</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <p class="h6">{{ $movie->original_name }}</p>

    <hr style="border-style: dashed;">

    @if($movie->image_path)
        <img src="{{ Storage::url($movie->image_path) }}" alt="{{ $movie->name }}"
             style="width: 200px; height: 300px;">
    @else
        <img src="{{ Storage::url('public/images/image_stub.png') }}" alt="image_stub"
             style="width: 200px; height: 300px;">
    @endif

    <hr style="border-style: dashed;">

    <div class="mb-3 d-flex">
        <div>
            {{ $movie->genre->name }}, {{ $movie->country->name }}
        </div>
        <div class="ml-auto">
            {{ $movie->year }}
        </div>
    </div>

    <div class="card card-body lead">
        {!! nl2br($movie->description) !!}
        <div class="d-flex align-items-center">
            @foreach($movie->actors as $actor)
                <div>
                    {{ $actor->name }},
                </div>
            @endforeach
        </div>
    </div>

    <hr style="border-style: dashed;">

    <div class="d-flex justify-content-end">

    </div>

@endsection
