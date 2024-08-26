@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a class="" href="{{route('admin.trips.create')}}"><button class="mt-md-0 mt-3 create-button ">Nuovo Viaggio</button></a>
            </div>
        </div>
    </div>
@endsection