@extends('layouts.web.dashboard')

@section('content')

<div class="row p-4 mt-2">
    <div class="col-md-12">
        @if($profile->is_agreed == 0)
        <center><h6>Your application is still pending</h6></center>
        @endif
    </div>
</div>

@endsection
