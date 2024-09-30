@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                <small>{{ $error }}</small>
            @endforeach
        @endif --}}
        <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Titolo:</label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="Inserisci il titolo del progetto" value="{{ old('title') }}">
                @error('title')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="type_id">Tipo:</label>
                <select class="form-select" name="type_id" id="types">
                    <option value="">Scegli un'opzione</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{-- Condizione per lasciare selzionato --}}
                            @if (old('type_id') == $type->id) selected @endif>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('type_id')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="lenguages">Linguaggi Usati:</label>
                <input type="text" class="form-control" id="lenguages" name="lenguages"
                    placeholder="Inserisci i linguaggi usati" value="{{ old('lenguages') }}">
                @error('lenguages')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="git_link">Link a GitHub:</label>
                <input type="text" class="form-control" id="git_link" name="git_link"
                    placeholder="Inserisci il link a GitHub" value="{{ old('git_link') }}">
                @error('git_link')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            {{-- Checkbox per technologies --}}
            <div>
                <label for="technologies">Seleziona la tecnologia usata:</label>
            </div>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($technologies as $tech)
                    <input type="checkbox" class="btn-check" name="technologies[]" value="{{ $tech->id }}"
                        @if (in_array($tech->id, old('technologies', []))) checked @endif id="tech-{{ $tech->id }}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="tech-{{ $tech->id }}">{{ $tech->name }}</label>
                @endforeach
            </div>

            <div class="form-group">
                <label for="description">Descrizione:</label>
                <textarea name="description" id="description"> {{ old('description') }}</textarea>

                @error('description')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="date">Data:</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="Inserisci la data"
                    value="{{ old('date') }}">
                @error('date')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="img_path">Carica un'immagine:</label>
                <div class="d-flex">
                    <div class="wrap-img w-25 text-center">
                        <img class="img-fluid" src="/placeholder_img.jpg" id="thumb">
                    </div>
                    <div class="align-self-center ms-2 flex-grow-1">
                        <input type="file" class="form-control" id="img_path" name="img_path"
                            placeholder="Inserisci un'immagine" value="{{ old('img_path') }}" onchange="showImg(event)">
                        @error('img_path')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="container my-5 text-center">
                <button type="submit" class="btn btn-primary">Aggiungi</button>
            </div>
        </form>
    </div>

    <script>
        function showImg(event) {
            console.log(event.target.files[0])
            //recupero del tag img
            const thumb = document.getElementById('thumb');

            //Associazione del tag con URL
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
