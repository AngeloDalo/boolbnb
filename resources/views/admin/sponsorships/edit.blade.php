@extends('layouts.admin')

@section('content')

<div class="content container col-xs-12 col-md-6">
    <form method="post" id="payment-form" action="{{route('admin.sponsorships.update', $apartment->id)}}">
        
        @csrf
        @method('PATCH')
        <section>

        <input type="hidden" name="apartment" value="{{$apartment->id}}">


        <div class="d-flex justify-content-center align-items-center">
            @foreach ($sponsorships as $sponsorship )
                <div class="card p-3 d-flex justify-content-center align-items-center">
                <i class="fas fa-medal @if ($sponsorship->type === 'silver')
                    silver
                    @elseif ($sponsorship->name === 'gold')
                    gold
                    @else
                    platinum
                    @endif card-img-top text-center"></i>
                    <div class="card-body">
                    <label for="{{$sponsorship->name}}">
                        <p>Type: {{$sponsorship->name}}</p>
                        <p>Price: {{$sponsorship->price}}€</p>
                        <p>Duration: {{$sponsorship->time}} Hours</p>
                    </label>
                    </div>
                    <input id= "{{$sponsorship->id}}" checked name="Sponsorship" type="radio" value="{{$sponsorship->id}}">
                </div>
            @endforeach
        </div>

        <div class="bt-drop-in-wrapper">
            <div id="bt-dropin"></div>
        </div>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <div class="pay text-center"><button class="btn btn-danger text-white" type="submit"><span>Pay now</span></button></div>
    </form>
</div>



<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
<script>
  var form = document.querySelector('#payment-form');
  var client_token = "sandbox_tv8hnj3n_sff9x6cz2smm8qhq";
  braintree.dropin.create({
    authorization: client_token,
    selector: '#bt-dropin',
  }, function (createErr, instance) {
    if (createErr) {
      console.log('Create Error', createErr);
      return;
    }
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      instance.requestPaymentMethod(function (err, payload) {
        if (err) {
          // console.log('Request Payment Method Error', err);
          return;
        }
        // Add the nonce to the form and submit
        document.querySelector('#nonce').value = payload.nonce;
        form.submit();
      });
    });
  });
</script>
</div>

@endsection