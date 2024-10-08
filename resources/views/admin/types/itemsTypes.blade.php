@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">LAVORI SUDDIVISI PER LINGUAGGIO</h1>
    <div class="container d-flex flex-wrap justify-content-center gap-3">
        @foreach ($types as $type)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5
                        class="fs-6 badge
                            @if ($type->name == 'Front End') text-bg-primary
                            @elseif ($type->name == 'Back End') text-bg-danger
                            @elseif ($type->name == 'Full Stack') text-bg-secondary
                            @elseif ($type->name == 'Database') text-bg-warning
                            @else text-bg-danger @endif">
                        {{ $type->name }}</h5>
                    <ul>
                        @foreach ($type->items as $item)
                            <li class="d-flex justify-content-between">{{ $item->title }}
                                <a class="text-success" href="{{ route('admin.items.show', $item) }}"><i
                                        class="fa-solid fa-eye"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
