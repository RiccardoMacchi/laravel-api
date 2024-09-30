@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                <small>{{ $error }}</small>
            @endforeach
        @endif --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <ul class="list-group list-group-flush my_list">
            @foreach ($types as $type)
                <li class="d-flex justify-content-between list-group-item">
                    <form id="update-{{ $type->id }}" action="{{ route('admin.types.update', $type) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input class="input-edit form-control @if ($errors->any() && old('id') == $type->id) is-invalid @endif"
                            name="name" value="{{ $type->name }}">
                        {{-- input per la verifica di quale genera errore --}}
                        <input type="hidden" name="id" value="{{ $type->id }}">
                    </form>
                    <div>
                        <button type="submit" class="btn btn-warning" onclick="submitUpdate({{ $type->id }})"><i
                                class="fa-solid fa-pencil"></i></button>
                        @include('admin.partials.formdelete', [
                            'route' => route('admin.types.destroy', $type),
                            'title' => "vuoi veramente eliminare $type->name",
                        ])
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="my-5">
            @error('name')
                <small>{{ $message }}</small>
            @enderror
            <form action="{{ route('admin.types.store') }}" method="POST">
                @csrf
                <label for="name">INSERISCI UN NUOVO TIPO:</label>
                <input type="text" name="name" placeholder="Inserisci un nuovo tipo"
                    value="@if ($errors->any() && old('id') == $type->id) {{ old('name') }} @endif">
                <input type="hidden" name="id" value="{{ $type->id }}">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
    {{-- Funzione per associazione btn modifica con form tramite id --}}
    <script>
        function submitUpdate(id) {
            let form = document.getElementById(`update-${id}`)
            // Effettuiamo il submit sul bottone
            form.submit();
        }
    </script>
@endsection
