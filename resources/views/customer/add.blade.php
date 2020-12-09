@extends('layout')
@section('content')
    <div class="container border border-secondary bg-light">
        <div class="m-3">
            <form method="post">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Name" name="name" value="" autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </form>
        </div>
    </div>
@endsection
