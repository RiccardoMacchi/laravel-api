@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <div class="form-group">
            <form action="{{ route('admin.items.index') }}" method="GET">

                <label for="search">Cerca tra i lavori:</label>
                <input type="text" class="form-control" id="search" name="search" placeholder="Effettua la ricerca"
                    value="{{ request('search') }}">
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <a href="{{ route('admin.items.index', ['direction' => $direction, 'column' => 'id']) }}">ID</a>
                    </th>
                    <th scope="col">
                        <a
                            href="{{ route('admin.items.index', ['direction' => $direction, 'column' => 'title']) }}">Nome</a>
                    </th>
                    <th scope="col">Preview</th>
                    <th scope="col">Type</th>
                    <th scope="col">Link a GitHub</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Tecnologia</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
                        <td>{{ $item->title }}</td>
                        <td><img class="img-fluid thumb" src="{{ asset('storage/' . $item->img_path) }}" alt=""
                                onerror="this.src='/placeholder_img.jpg'"></td>
                        <td>
                            <a class="badge
                            @if ($item->type?->name == 'PHP' || $item->type?->name == 'CSS') text-bg-primary
                            @elseif ($item->type?->name == 'HTML') text-bg-danger
                            @elseif ($item->type?->name == 'SASS') text-bg-secondary
                            @elseif ($item->type?->name == 'JavaScript') text-bg-warning
                            @elseif ($item->type?->name == 'SQL') text-bg-dark
                            @else text-bg-danger @endif"
                                href="{{ route('admin.itemsTypes') }}">{{ $item->type ? $item->type->name : 'NESSUN TIPO' }}
                            </a>
                        </td>
                        <td>{{ $item->git_link }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            @if (!$item->technologies->isEmpty())
                                @foreach ($item->technologies as $tech)
                                    <span class="badge text-bg-warning">{{ $tech->name }}</span>
                                @endforeach
                            @else
                                <span class="badge text-bg-danger">NESSUNA TECNOLOGIA</span>
                            @endif
                        </td>
                        {{-- Colonna azioni --}}
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.items.show', ['item' => $item->id]) }}"><i
                                    class="fa-solid fa-eye"></i></a>
                            {{-- Form delete incluso --}}
                            @include('admin.partials.formdelete', [
                                'route' => route('admin.items.destroy', ['item' => $item->id]),
                                'message' => "vuoi veramente eliminare $item->tilte",
                            ])

                            <a class="btn btn-warning" href="{{ route('admin.items.edit', ['item' => $item->id]) }}"><i
                                    class="fa-solid fa-pencil"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container d-flex justify-content-center">
            {{ $items->links() }}
        </div>
    </div>
@endsection
