@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a class="mt-5" href="{{ route('admin.trips.create') }}">
                    <button class="mt-4 btn-green btn">Nuovo Viaggio</button>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="mb-4 text-center">I Tuoi Viaggi</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Descrizione</th>
                    <th>Data Inizio</th>
                    <th>Data Fine</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trips as $trip)
                    <tr>
                        <td>{{ $trip->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($trip->description, 30) }}</td>
                        <td>{{ \Carbon\Carbon::parse($trip->start_date)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($trip->end_date)->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#showModal{{ $trip->id }}" data-trip-id="{{ $trip->id }}">
                                Visualizza
                            </button>
                            <a class="btn btn-warning btn-sm" href="{{ route('admin.trips.edit', ['trip' => $trip->id]) }}">
                                Modifica
                            </a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $trip->id }}">
                                Elimina
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($trips as $trip)
        @include('admin.trips.partials.modal_show', ['trip' => $trip])
        @include('admin.trips.partials.modal_delete', ['trip_id' => $trip->id])
    @endforeach
@endsection
