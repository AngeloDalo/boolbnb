@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row row-title-index">
            <h1 class="h1 text-uppercase">Admin - All Apartments</h1>
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
                <table class="table table-primary">
                    <thead>
                        <tr class="table-primary">
                            <th>Title</th>
                            <th>Address</th>
                            <th>Price</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>View</th>
                            <th>Update</th>
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
                                <td><a class="btn btn-primary"
                                        href="{{ route('admin.apartments.show', $apartment->slug) }}">View</a></td>
                                <td>
                                    <a class="btn btn-primary"
                                        href="{{ route('admin.apartments.edit', $apartment->slug) }}">Update</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
