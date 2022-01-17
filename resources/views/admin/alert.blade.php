@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="list-style: none; padding: 0; margin: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if (Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif


@if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('status'))
    <div class="alert alert-success">
        {{ Session::get('status') }}
    </div>
@endif
