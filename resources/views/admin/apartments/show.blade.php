@extends('layouts.admin')

@section('content')
    <div class="container show p-5">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <h1>{{ $apartment->title }}</h1>
                <img src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}"
                    class="img-fluid">
                <h3>Price: {{ $apartment->price }}&euro;</h3>
                <h3>Rooms: {{ $apartment->rooms }}</h3>
                <h3>Beds: {{ $apartment->beds }}</h3>
                <h3>Bathrooms: {{ $apartment->bathrooms }}</h3>
                <h3>Services:</h3>
                @foreach ($apartment->services()->get() as $service)
                <span class="badge rounded-pill bg-secondary">
                    {{ $service->name }}
                </span>
                @endforeach
                <h3>Square: {{ $apartment->square }}m<sup>3</sup></h3>
                <h3>{{ $apartment->address }}</h3>
                <h3>Latitude: {{ $apartment->latitude }}</h3>
                <h3>Longitude: {{ $apartment->longitude }}</h3>
            </div>
        </div>
        <div class="col">
            {{-- <img class="img-fluid" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}"> --}}
        </div>
        <a class="btn btn-primary mt-5" href="{{ route('admin.apartments.index') }}">My Apartments</a>
    </div>
@endsection
