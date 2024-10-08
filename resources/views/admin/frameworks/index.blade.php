@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column">
        {{-- Titolo e errori --}}
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
        {{-- Lista elementi --}}


        <ul class="list-group list-group-flush my_list">
            @foreach ($frameworks as $framework)
                <li class="d-flex justify-content-between list-group-item">
                    <form id="update-{{ $framework->id }}" action="{{ route('admin.frameworks.update', $framework) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <input class="input-edit form-control @if ($errors->any() && old('id') == $framework->id) is-invalid @endif"
                            type="text" name="name" value="{{ $framework->name }}">
                        {{-- Input hidden per salvare id in old e fare verifica --}}
                        <input type="hidden" name="id" value="{{ $framework->id }}">
                    </form>
                    <div>
                        <button type="submit" class="btn btn-warning" onclick="submitUpdate({{ $framework->id }})"><i
                                class="fa-solid fa-pencil"></i></button>
                        @include('admin.partials.formdelete', [
                            'route' => route('admin.frameworks.destroy', $framework),
                            'title' => "vuoi veramente eliminare $framework->name",
                        ])
                    </div>
                </li>
            @endforeach
        </ul>

        {{-- Input nuovo --}}
        <div class="my-5">
            @error('name')
                <small>{{ $message }}</small>
            @enderror
            <form action="{{ route('admin.frameworks.store') }}" method="POST">
                @csrf
                <label for="name">INSERISCI UN NUOVO TIPO:</label>
                <input type="text" name="name" placeholder="Inserisci un nuovo tipo"
                    value="@if ($errors->any() && old('id') == $framework->id) {{ old('name') }} @endif">
                <input type="hidden" name="id" value="{{ $framework->id }}">
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
