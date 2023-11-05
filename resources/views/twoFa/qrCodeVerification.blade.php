@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3 qr-container">
            <div class="input-container">
                <label for="label"><strong>Label</strong></label>
                <input type="text" class="form-control input-box" id="label"
                       name="label" aria-describedby="labelHelp"
                       placeholder="Enter Label" value="{{ $label }}" disabled>
            </div>
            <div class="input-container">
                <label for="username"><strong>Username</strong></label>
                <input type="text" class="form-control input-box" id="username"
                       name="username" aria-describedby="usernameHelp"
                       placeholder="Enter Username" value="{{ $username }}" disabled>
            </div>
            <div class="d-flex justify-content-center mt-5">
                {!! $qrCode !!}
            </div>
        </div>
    </div>
@endsection
