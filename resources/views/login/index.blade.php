@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3 form-container">
            <form method="POST" action="/" class="mt-4">
                @csrf
                @include('common.errors', ['errors' => $errors])
                <div class="input-container">
                    <label for="label"><strong>Label</strong></label>
                    <input type="text" class="form-control input-box" id="label" value="{{ old('label') }}"
                           name="label" aria-describedby="labelHelp" placeholder="Enter Label" required>
                </div>
                <div class="input-container">
                    <label for="username"><strong>Username</strong></label>
                    <input type="text" class="form-control input-box" id="username" value="{{ old('username') }}"
                           name="username" aria-describedby="usernameHelp" placeholder="Enter Username" required>
                </div>
                <button type="submit" class="btn btn-primary submit-button">Submit</button>
            </form>
        </div>
    </div>
@endsection
