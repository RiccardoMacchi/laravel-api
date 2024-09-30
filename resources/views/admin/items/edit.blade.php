@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h1>Modifica del Progetto: {{ $item->title }}</h1> --}}
        <h1>{{ $title }}</h1>
        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                <small>{{ $error }}</small>
            @endforeach
        @endif --}}
        <form action="{{ route('admin.items.update', $item) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Titolo:</label>
                <input type="text" class="form-control" id="title" name="title"
                    placeholder="Inserisci il titolo del progetto" value="{{ old('title', $item->title) }}">
                @error('title')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="type_id">TIPO:</label>
                <select class="form-select" name="type_id" id="types">
                    <option value="">Scegli un'opzione</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{-- Condizione per lasciare selzionato --}}
                            @if (old('type_id', $item->type_id) == $type->id) selected @endif>
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
                    placeholder="Inserisci i linguaggi usati" value="{{ old('lenguages', $item->lenguages) }}">
                @error('lenguages')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="git_link">Link a GitHub:</label>
                <input type="text" class="form-control" id="git_link" name="git_link"
                    placeholder="Inserisci il link a GitHub" value="{{ old('git_link', $item->git_link) }}">
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
                        @if (
                            ($errors->any() && in_array($tech->id, old('technologies', []))) ||
                                (!$errors->any() && $item->technologies->contains($tech))) checked @endif id="tech-{{ $tech->id }}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="tech-{{ $tech->id }}">{{ $tech->name }}</label>
                @endforeach
            </div>

            <div class="form-group">
                <label for="description">Descrizione:</label>
                <textarea name="description" id="description"> {{ old('description', $item->description) }}</textarea>
                @error('description')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="date">Data:</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="Inserisci la data"
                    value="{{ old('date', $item->date) }}">
                @error('date')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            {{-- Form immagine --}}
            <div class="form-group">
                <label for="img_path">Carica un'immagine:</label>
                <div class="d-flex">
                    <div class="wrap-img w-25 text-center">
                        <img class="img-fluid" id="thumb" src="{{ asset('storage/' . $item->img_path) }}"
                            onerror="this.src='/placeholder_img.jpg'" alt="{{ $item->original_img_name }}">
                        {{-- Btn delete attaccato a form esterno --}}
                        <button class="btn btn-danger my-1" @if ($item->img_path == null) disabled @endif type="button"
                            onclick="submitDeleteForm()">CANCELLA IMMAGINE <i class="fa-solid fa-eraser"></i></button>
                    </div>
                    <div class="align-self-center ms-2 flex-grow-1">
                        <input type="file" class="form-control" id="img_path" name="img_path"
                            placeholder="Inserisci un'immagine" value="{{ old('img_path', $item->original_img_name) }}"
                            onchange="showImg(event)">
                    </div>
                </div>
                @error('img_path')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="container my-5 text-center">
                <button type="submit" class="btn btn-primary">Modifica</button>
            </div>
        </form>
        <form id="delete_img" class="d-inline" action="{{ route('admin.deleteImg', $item) }}" method="POST"
            onsubmit="return confirm('Vuoi eliminare {{ $item->original_img_name }}')">
            @csrf
            @method('DELETE')
        </form>

    </div>

    <script>
        function submitDeleteForm() {
            let form = document.getElementById(`delete_img`);
            // Effettuiamo il submit sul bottone
            form.submit();
        }

        function showImg(event) {
            console.log(event.target.files[0])
            //recupero del tag img
            const thumb = document.getElementById('thumb');

            //Associazione del tag con URL
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
