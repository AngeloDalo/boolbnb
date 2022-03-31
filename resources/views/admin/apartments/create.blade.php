@extends('layouts.admin')

@section('content')
<div class="container p-5">
    <div class="row">
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="row">
        <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data" id="MyForm">
            <a class="btn btn-primary" href="{{url()->previous()}}">CANCEL</a>
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="title" class="form-label text-uppercase fw-bold">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <p id="demo1"></p>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="image" class="form-label text-uppercase fw-bold">Image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            @error('image')
                <div class="alert alert-danger mt-3"> {{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="price" class="form-label text-uppercase fw-bold">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div>
            <p id="demo2"></p>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="rooms" class="form-label text-uppercase fw-bold">Rooms</label>
            <input type="text" class="form-control" id="rooms" name="rooms" value="{{ old('rooms') }}">
            </div>
            <p id="demo3"></p>
            @error('rooms')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="beds" class="form-label text-uppercase fw-bold">Beds</label>
            <input type="text" class="form-control" id="beds" name="beds" value="{{ old('beds') }}">
            </div>
            <p id="demo4"></p>
            @error('beds')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="bathrooms" class="form-label text-uppercase fw-bold">Bathrooms</label>
            <input type="text" class="form-control" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}">
            </div>
            <p id="demo5"></p>
            @error('bathrooms')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @error('services.*')  
            <div class="alert alert-danger mt-3">
                {{ $message }}
            </div>
            @enderror
            <fieldset class="mb-3">
                <legend>Services</legend>
                @foreach ($services as $service)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $service->id }}" name="services[]"
                        {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $service->name }}
                        </label>
                </div>
                @endforeach
            </fieldset>

            <div class="mb-3">
                <label for="square" class="form-label text-uppercase fw-bold">Square</label>
            <input type="text" class="form-control" id="square" name="square" value="{{ old('square') }}">
            </div>
            <p id="demo6"></p>
            @error('square')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="address" class="form-label text-uppercase fw-bold">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>
            <p id="demo7"></p>
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="latitude" class="form-label text-uppercase fw-bold">Latitude</label>
            <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}">
            </div>
            <p id="demo8"></p>
            @error('latitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="longitude" class="form-label text-uppercase fw-bold">Longitude</label>
            <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}">
            </div>
            <p id="demo9"></p>
            @error('longitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-check">
                <input class="form-check-input" type="radio" name="visible" id="available" value="1" checked>
                <label class="form-check-label" for="available">
                    Available
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="visible" id="notAvailable" value="0">
                <label class="form-check-label" for="notAvailable">
                    Not Available
                </label>
            </div>


            <button type="button" class="btn btn-primary" onclick="validationForm()" value="Submit form">Save</button>
        </form>
    </div>
</div>

<script>
function validationForm() {
    let title = document.getElementById('title').value;
    let error1 = document.getElementById('demo1');
    let price = document.getElementById('price').value;
    let error2 = document.getElementById('demo2');
    let rooms = document.getElementById('rooms').value;
    let error3 = document.getElementById('demo3');
    let beds = document.getElementById('beds').value;
    let error4 = document.getElementById('demo4');
    let bathrooms = document.getElementById('bathrooms').value;
    let error5 = document.getElementById('demo5');
    let square = document.getElementById('square').value;
    let error6 = document.getElementById('demo6');
    let address = document.getElementById('address').value;
    let error7 = document.getElementById('demo7');
    let latitude = document.getElementById('latitude').value;
    let error8 = document.getElementById('demo8');
    let longitude = document.getElementById('longitude').value;
    let error9 = document.getElementById('demo9');
    
    let message = "";
    let error = 0;

    if (!title || !title.trim()) {
        message = 'title not valid';
        error = 1;
        error1.innerHTML = message;
        error1.classList.add("alert");
        error1.classList.add("alert-danger");
    } else {
        error1.innerHTML = "";
        error1.classList.remove("alert");
        error1.classList.remove("alert-danger");
    }

    if (price < 0 || !price || isNaN(price)) {
        message = 'price not valid';
        error = 1;
        error2.innerHTML = message;
        error2.classList.add("alert");
        error2.classList.add("alert-danger");
    } else {
        error2.innerHTML = "";
        error2.classList.remove("alert");
        error2.classList.remove("alert-danger");
    }

    if (rooms < 0 || !rooms || isNaN(rooms)) {
        message = 'Rooms must be at least one';
        error = 1;
        error3.innerHTML = message;
        error3.classList.add("alert");
        error3.classList.add("alert-danger");
    } else {
        error3.innerHTML = "";
        error3.classList.remove("alert");
        error3.classList.remove("alert-danger");
    }

    if (beds < 0 || !beds || isNaN(beds)) {
        message = 'Beds must be at least one';
        error = 1;
        error4.innerHTML = message;
        error4.classList.add("alert");
        error4.classList.add("alert-danger");
    } else {
        error4.innerHTML = "";
        error4.classList.remove("alert");
        error4.classList.remove("alert-danger");
    }

    if (bathrooms < 0 || !bathrooms || isNaN(bathrooms)) {
        message = 'Bathrooms must be at least one';
        error = 1;
        error5.innerHTML = message;
        error5.classList.add("alert");
        error5.classList.add("alert-danger");
    } else {
        error5.innerHTML = "";
        error5.classList.remove("alert");
        error5.classList.remove("alert-danger");
    }

    if (square < 0 || !square || isNaN(square)) {
        message = 'Square not valid';
        error = 1;
        error6.innerHTML = message;
        error6.classList.add("alert");
        error6.classList.add("alert-danger");
    } else {
        error6.innerHTML = "";
        error6.classList.remove("alert");
        error6.classList.remove("alert-danger");
    }

    if (!address || !address.trim()) {
        message = 'Address not valid';
        error = 1;
        error7.innerHTML = message;
        error7.classList.add("alert");
        error7.classList.add("alert-danger");
    } else {
        error7.innerHTML = "";
        error7.classList.remove("alert");
        error7.classList.remove("alert-danger");
    }

    if (latitude < -90 || latitude > 90 || !latitude ) {
        message = 'Latitude not valid';
        error = 1;
        error8.innerHTML = message;
        error8.classList.add("alert");
        error8.classList.add("alert-danger");
    } else {
        error8.innerHTML = "";
        error8.classList.remove("alert");
        error8.classList.remove("alert-danger");
    }

    if (longitude < -180 || longitude > 180 || !longitude ) {
        message = 'Longitude not valid';
        error = 1;
        error9.innerHTML = message;
        error9.classList.add("alert");
        error9.classList.add("alert-danger");
    } else {
        error9.innerHTML = "";
        error9.classList.remove("alert");
        error9.classList.remove("alert-danger");
    }

    if (error == 0) {
        message = "";
        document.getElementById('MyForm').submit();
        return true;
    } else {
        return false;
    }
}
</script>
@endsection