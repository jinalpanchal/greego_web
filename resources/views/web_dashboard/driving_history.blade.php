@extends('layouts.web.dashboard')

@section('content')
<div class="row p-3">
    <div class="col-12">
        <center>
            <h4 class="mt-4">
                <b>Current Total Earning</b>
            </h4>            
            <h1 class="green-color mt-2">
                <b>$0.00</b>
            </h1>
        </center>

    </div>
</div>
<div class="row">
    <div class="col-12 p-5">
        <h4 class="ride_text">Ride History</h4>
        <ul class="list-group" id="ride_history">
            @foreach($ride_history as $history)
            <a href="{{ route('driver.ride_history',$history->year) }}">
                <li class="list-group-item text-center">
                    {{ $history->year }}
                </li>
            </a>
            @endforeach
        </ul>
    </div>

</div>


@endsection

@section('js')
<script>

</script>
@endsection