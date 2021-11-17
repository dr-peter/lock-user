@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <p>{{ __('Hi') }} <strong>{{ $user->name }}</strong>,<p>
            <p>{{ __('Enter your password below to unlock the app.') }}</p>
            @if(session('pass_incorrect'))
                <div class="alert alert-danger" role="alert">
                    {{ session('pass_incorrect') }}
                </div>
            @endif
            <form action="{{ route('unlock-user') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control @error('password'){{ 'is-invalid' }}@enderror" placeholder="{{ __('Enter password') }}" autofocus />
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">{{ __('Unlock') }}</button>
                    </div>
                    <div class="col-md-6 text-end">
                        <a class="btn btn-outline-secondary" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>                                    
                    </div>
                </div>
            </form>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection