@extends('layouts.admin')

@section('content')
    <div class="container show ps-5">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        </div>


        <div class="row border border-danger rounded-3 p-3">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <img class="w-100 h-100 rounded-3" src="{{ asset('storage/' . $apartment->image) }}"
                    alt="{{ $apartment->title }}">
            </div>
            <div class="col-sm- 12 col-md-12 col-lg-6">
                <div class="d-flex flex-column">
                    <h3 class="card-title text-danger">{{ $apartment->title }}</h3>
                    <span>Price: {{ $apartment->price }}&euro;</span>
                    <span>Rooms: {{ $apartment->rooms }}</span>
                    <span>Beds: {{ $apartment->beds }}</span>
                    <span>Bathrooms: {{ $apartment->bathrooms }}</span>
                    <span>Services:
                        @foreach ($apartment->services()->get() as $service)
                            <span class="badge rounded-pill bg-danger">
                                {{ $service->name }}
                            </span>
                        @endforeach
                    </span>
                    <span>Square: {{ $apartment->square }}m<sup>3</sup></span>
                    <span>{{ $apartment->address }}</span>
                    <span>Latitude: {{ $apartment->latitude }}</span>
                    <span>Longitude: {{ $apartment->longitude }}</span>
                </div>
            </div>
        </div>




        {{-- <div class="row">
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
        </div> --}}
        <div class="col">
            {{-- <img class="img-fluid" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}"> --}}
        </div>
        <a class="btn btn-danger mt-5" href="{{ route('admin.apartments.index') }}">My Apartments</a>
    </div>
@endsection
