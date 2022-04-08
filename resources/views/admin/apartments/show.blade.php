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
        <a class="btn btn-danger mt-5" href="{{ route('admin.apartments.index') }}">My Apartments</a>
        <a class="btn btn-danger mt-5" href="{{ url('/') }}">Home</a>
        @if ($apartment->sponsorship()->get())
        
        @endif
        

        <div class="mt-5 border border-danger rounded-3 p-3">
            <div>
                <h1 class="text-danger">Messages</h1>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Content Message</th>
                        <th>Date Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->text }}</td>
                            <td>{{ $message->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- @foreach ($messages as $message)
            <span>{{ $message->id }}</span> 
            <span>{{ $message->email }}</span> 
            @endforeach --}}
        </div>
    </div>
@endsection
