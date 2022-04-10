@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row row-title-index">
            <h1 class="fw-bold">Your Apartments</h1>
        </div>
        <!--message delate-->
        <div class="row">
            <div class="col">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table border border-danger text-center">
                    <thead>
                        <tr class="table-danger">
                            <th>Title</th>
                            <th>Address</th>
                            <th>Price</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Sponsorship</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                            <tr>
                                <td>{{ $apartment->title }}</td>
                                <td>{{ $apartment->address }}</td>
                                <td>{{ $apartment->price }}&euro;</td>
                                <td>{{ $apartment->created_at }}</td>
                                <td>{{ $apartment->updated_at }}</td>
                                <td><a class="btn btn-danger text-white"
                                        href="{{ route('admin.apartments.show', $apartment->slug) }}">View</a></td>
                                <td>
                                    <a class="btn btn-danger text-white"
                                        href="{{ route('admin.apartments.edit', $apartment->slug) }}">Edit</a>
                                </td>
                                @if ($apartment->end_date)
                                <td><span>Sponsorship end: </span><br>{{ $apartment->end_date }}</td> 
                                @else 
                                    <td><a class="btn btn-danger text-white" href="{{ route('admin.sponsorships.edit', $apartment->id) }}">Sponsorship</a></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
