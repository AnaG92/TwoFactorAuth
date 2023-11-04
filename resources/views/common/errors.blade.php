@if($errors->any())
    <div class="alert alert-danger" role="alert">
        Warning:
        <ul class="mt-2">
            @foreach($errors->all(':message') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
