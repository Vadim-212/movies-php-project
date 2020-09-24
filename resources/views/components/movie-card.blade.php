<div class="card card-body mb-3">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('movies.show', $movie) }}">
            <h2 class="h5 mb-0">{{ $movie->name }}</h2>
        </a>

        <div class="d-flex align-items-center justify-content-end">
            @if($isAdmin)
                <a href="{{ route('movies.edit', $movie) }}" class="mt-3 btn btn-warning btn-sm">
                    Редактировать
                </a>
                <form action="{{ route('movies.destroy', $movie) }}" method="post">
                    @csrf @method('delete')
                    <button class="ml-2 mt-3 btn btn-danger btn-sm">
                        Удалить
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if($movie->image_path)
        <img src="{{ Storage::url($movie->image_path) }}" alt="{{ $movie->title }}" class="img-fluid my-3 rounded">
    @else
        <hr style="border-style: dashed;" />
    @endif

    <div class="text-muted d-flex align-items-center">
        <a href="{{ route('genre.movies', $movie->genre) }}" class="badge badge-secondary mr-3">
            {{ $movie->genre->name }}
        </a>
        <div class="ml-auto">
            {{ $movie->country->name }}, {{ $movie->year }}
        </div>
    </div>

    <hr style="border-style: dashed;" />

    <p class="mb-0">
        {{ Str::words($movie->description, 20) }}
    </p>

    <p class="mb-0">
{{--        {{ Str::words(implode(', ', array_map(function($actor) { return $actor['name']; } ,$movie->actors->toArray())), 20) }}--}}
        @foreach($movie->actors as $actor)
            <a class="badge badge-primary" href="{{ route('actors.show', $actor) }}">{{ $actor->name }}</a>
        @endforeach
    </p>

    <div class="text-right">
        <a class="btn btn-primary" href="{{ route('movies.show', $movie) }}">
            Подробнее...
        </a>
    </div>

</div>
