@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-5">Ecco i dettagli di: {{ $item->title }}</h1>

        <div class="card text-center">
            <div class="card-header d-flex justify-content-evenly">
                <span>{{ $item->lenguages }}</span>
                <a class="btn btn-warning" href="{{ route('admin.items.edit', ['item' => $item->id]) }}"><i
                        class="fa-solid fa-pencil"></i></a>
            </div>
            <div class="card-body">
                <h4 class="card-title">TITOLO: {{ $item->title }}</h4>
                <h6>TIPO: <span class="badge text-bg-success">{{ $item->type ? $item->type->name : 'NESSUN TIPO' }}</span>
                </h6>
                <h5>Teconologie:</h5>
                {{-- @dump($item->technologies->isEmpty()) --}}
                @if (!$item->technologies->isEmpty())
                    @foreach ($item->technologies as $tech)
                        <span class="badge text-bg-warning">{{ $tech->name }}</span>
                    @endforeach
                @else
                    <span class="badge text-bg-danger">NESSUNA TECNOLOGIA</span>
                @endif
                <p class="card-text my-5">{{ $item->description }}</p>
                <img class="img-fluid w-25" src="{{ asset('storage/' . $item->img_path) }}" alt="">
                <h5>{{ $item->original_img_name }}</h5>
                <a href="{{ $item->git_link }}" target="_blank" class="btn btn-primary">Vai a GitHub</a>
            </div>
            <div class="card-footer text-muted">
                {{ $item->date }}
            </div>
        </div>
    </div>
@endsection
