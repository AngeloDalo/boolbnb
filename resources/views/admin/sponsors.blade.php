@extends('layouts.admin')

@section('content')
    <div class="container">
        <table class="table mt-4 table-striped">
            <thead>
                <tr>
                    <td>Title</td>
                    <td>Address</td>
                    <td>Visibility</td>
                    <td colspan="3">Sponsors</td>          
                </tr>
            </thead>
            <tbody >
                @foreach ($apartments as $apartment)
                    <tr>
                        <td> {{ $apartment->title }} </td>
                        <td> {{ $apartment->address }} </td>
                        <td>
                            <form action="{{route('admin.sponsorship.update', $apartment->id)}}" method="get">
                                @csrf
                                @method('PATCH')
                                <select name="sponsors" id="sponsors">
                                    @foreach ($sponsorships as $sponsorship)
                                        <option value="{{ $sponsorship->id }}">
                                            {{ $sponsorship->name }} | {{ $sponsorship->time }}hours | {{ $sponsorship->price }}€
                                        </option>
                                    @endforeach
                                </select>
                                <input type="submit" class="btn btn-primary" value="SUBMIT">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection