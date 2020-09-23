@if($movies->isNotEmpty())

    @foreach($movies as $movie)
        @include('components.movie-card')
    @endforeach

    {{ $movies->links() }}

@else
    <div class="alert alert-secondary">
        Фильмов нет.
    </div>
@endif
