@extends('layouts.auth_app')

@section('title', 'Login')

@section('content')
    <div class="p-2 mt-5">
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-user-2-line auti-custom-input-icon"></i>
                <label for="email">{{ __('Email') }}</label>
                <input type="email" class="form-control" id="email" name="email" :value="old('email')" placeholder="Enter username" required autofocus>
            </div>

            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-lock-2-line auti-custom-input-icon"></i>
                <label for="password">{{ __('Password') }}</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required autocomplete="current-password">
            </div>

            {{-- <div class="custom-control custom-checkbox">
                <input id="remember_me" name="remember" type="checkbox" class="custom-control-input">
                <label class="custom-control-label" for="customControlInline">{{ __('Remember me') }}</label>
            </div> --}}

            <div class="mt-4 text-center">
                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">{{ __('Log in') }}</button>
            </div>

            {{-- <div class="mt-4 text-center">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> {{ __('Forgot your password?') }}</a>
                @endif
            </div> --}}
        </form>
    </div>

    <div class="mt-5 text-center">
        {{-- <p>Don't have an account ? <a href="{{ route('register') }}" class="font-weight-medium text-primary"> Register </a> </p> --}}
        <p>© 2020 Nazox. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
    </div>
@endsection