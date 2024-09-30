@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            BENVENUTO: {{ Auth::user()->name }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">DASHBOARD USER: {{ Auth::user()->id }}</div>
                    <div class=card-body>
                        <h3>SONO PRESENTI: {{ $item_count }} LAVORI</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-warning" href="{{ route('admin.items.create') }}">AGGIUNGI UN LAVORO</a>
                        <a class="btn btn-primary" href="{{ route('admin.items.index') }}">VAI A TUTTI I LAVORI</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
