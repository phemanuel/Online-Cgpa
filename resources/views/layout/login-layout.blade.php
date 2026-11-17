
@extends('layouts.auth')

@section('pageTitle', 'Staff Login | OYSCOHEST Result Portal')

@section('portalLabel', 'Staff Access')

@section('brandHeading', 'Academic records, professionally managed.')

@section('brandDescription')
    Access the official result management portal of
    Oyo State College of Health Science and Technology.
@endsection

@section('formLabel', 'Staff Account Access')

@section('formHeading', 'Welcome back')

@section('formDescription')
    Sign in with your registered staff email address
    and password to continue.
@endsection

@section('authForm')

<form
    class="auth-form"
    action="{{ route('login.action') }}"
    method="POST"
    id="myform"
    data-auth-form
>
    @csrf

    <!-- EMAIL ADDRESS -->

    <div class="auth-field">

        <label for="email" class="auth-label">
            Email Address
        </label>

        <div class="auth-input-wrap">

            <i class="la la-envelope-o auth-input-icon" aria-hidden="true"></i>

            <input
                type="email"
                name="email"
                id="email"
                class="auth-input @error('email') is-invalid @enderror"
                placeholder="Enter your email address"
                value="{{ old('email') }}"
                autocomplete="username"
                maxlength="255"
                required
                autofocus
                @error('email')
                    aria-invalid="true"
                    aria-describedby="email-error"
                @enderror
            >

        </div>

        @error('email')
            <span class="auth-field-error" id="email-error" role="alert">
                {{ $message }}
            </span>
        @enderror

    </div>

    <!-- PASSWORD -->

    <div class="auth-field">

        <label for="password" class="auth-label">
            Password
        </label>

        <div class="auth-input-wrap">

            <i class="la la-lock auth-input-icon" aria-hidden="true"></i>

            <input
                type="password"
                name="password"
                id="password"
                class="auth-input auth-password-input @error('password') is-invalid @enderror"
                placeholder="Enter your password"
                autocomplete="current-password"
                required
                @error('password')
                    aria-invalid="true"
                    aria-describedby="password-error"
                @enderror
            >

            <button
                type="button"
                class="auth-password-toggle"
                data-password-toggle="password"
                aria-label="Show password"
                aria-controls="password"
                aria-pressed="false"
            >
                <i class="la la-eye" aria-hidden="true"></i>
            </button>

        </div>

        @error('password')
            <span class="auth-field-error" id="password-error" role="alert">
                {{ $message }}
            </span>
        @enderror

    </div>

    <!-- PASSWORD RESET -->

    <div class="auth-options">
        <a
            href="{{ route('password.request') }}"
            class="auth-forgot"
        >
            Forgot Password?
        </a>
    </div>

    <!-- LOGIN BUTTON -->

    <button type="submit" class="auth-submit">

        <span data-submit-text>
            Sign In to Portal
        </span>

        <i
            class="la la-arrow-right"
            data-submit-icon
            aria-hidden="true"
        ></i>

    </button>

</form>

@endsection
