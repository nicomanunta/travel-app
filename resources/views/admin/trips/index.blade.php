@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a class="" href="{{route('admin.trips.create')}}"><button class="mt-md-0 mt-3 create-button ">Nuovo Viaggio</button></a>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="my-4 text-center">I Tuoi Viaggi</h1>
    

            <div class="list-group">
                @foreach ($trips as $trip)
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $trip->id }}" class="list-group-item list-group-item-action">
                        <h3 class="mb-1">{{ $trip->title }}</h3>
                        <p class="mb-1 text-first">{{ \Illuminate\Support\Str::limit($trip->description, 100) }}</p>
                        <p class="text-secondary ">
                            Data Inizio: {{ \Carbon\Carbon::parse($trip->start_date)->format('d-m-Y')}}
                            <br>
                            Data Fine: {{ \Carbon\Carbon::parse($trip->end_date)->format('d-m-Y') }}
                        </p>
                    </a>
                    
                @endforeach
            </div>
        
    </div>
    @foreach ($trips as $trip)
        @include('admin.trips.partials.modal_show', ['trip_id' => $trip->id])
    @endforeach
@endsection