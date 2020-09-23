@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center">
        <div class="h3">Список стран</div>

        @can('create', \App\Models\Country::class)
            <a href="{{ route('countries.create') }}" class="btn btn-success ml-auto">Добавить страну</a>
        @endcan
    </div>

    @if($countries->isNotEmpty())
        <div class="row">
            @foreach($countries as $country)
                <div class="col-md-3">
                    <div class="card card-body">
                        <div class="mb-3">
                            {{ $country->name }}
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                            @can('update', $country)
                                <a href="{{ route('countries.edit', $country) }}" class="mt-3 btn btn-warning btn-sm">Ред.</a>
                            @endcan
                            @can('delete', $country)
                                <form action="{{ route('countries.destroy', $country) }}" method="post">
                                    @csrf @method('delete')
                                    <button class="mt-3 btn btn-danger btn-sm">Удалить</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $countries->links() }}
        </div>
    @else
        <div class="alert alert-secondary">
            Списко стран пуст.
        </div>
    @endif

@endsection
