@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 qr-container">
        <form method="POST" action="/code/validate" class="mt-4">
            @csrf
            @include('common.errors', ['errors' => $errors])
            <div class="input-container">
                <label for="username"><strong>Username</strong></label>
                <input type="text" class="form-control input-box" id="username" value="{{ old('username') }}"
                       name="username" aria-describedby="usernameHelp" placeholder="Enter Username" required>
            </div>
            <div class="input-container">
                <label for="code"><strong>Enter your code here:</strong></label>
                <input type="text"
                       class="form-control input-box"
                       id="code"
                       name="code"
                       maxlength="6"
                       minlength="6"
                       pattern="\d*"
                       aria-describedby="codeHelp"
                       placeholder="Enter Code"
                       value="{{ old('code') }}"
                       required>
            </div>
            <button type="submit" class="btn btn-primary submit-button">Validate</button>
        </form>
    </div>
</div>
@endsection
