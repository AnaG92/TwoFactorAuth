@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 success-container">
        <div class="d-inline">
            <span class="hello-word">Hello</span>
            <span class="username-word"><strong>{{ $username }}</strong>,</span>
        </div>
        <div class="mt-3">Your Two-Factor Authentication was successful!</div>
    </div>
</div>
@endsection
