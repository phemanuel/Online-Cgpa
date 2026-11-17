
@extends('layouts.auth')

@section('pageTitle', 'Student Login | OYSCOHEST Result Portal')

@section('portalLabel', 'Student Access')

@section('brandHeading', 'Your academic journey, at your fingertips.')

@section('brandDescription')
    Welcome to the official Student Result Portal of
    Oyo State College of Health Science and Technology.
    Access your account and available academic results.
@endsection

@section('formLabel', 'Student Account Access')

@section('formHeading', 'Welcome back')

@section('formDescription')
    Enter your matriculation number and password
    to access your student account.
@endsection

@section('authForm')

<form
    class="auth-form"
    action="{{ route('student-login.action') }}"
    method="POST"
    id="myform"
    data-auth-form
>
    @csrf

    <!-- MATRICULATION NUMBER -->

    <div class="auth-field">

        <label for="matricNo" class="auth-label">
            Matriculation Number
        </label>

        <div class="auth-input-wrap">

            <i class="la la-id-card-o auth-input-icon" aria-hidden="true"></i>

            <input
                type="text"
                name="matricNo"
                id="matricNo"
                class="auth-input @error('matricNo') is-invalid @enderror"
                placeholder="Enter your matric number"
                value="{{ old('matricNo') }}"
                autocomplete="username"
                autocapitalize="off"
                spellcheck="false"
                required
                autofocus
                @error('matricNo')
                    aria-invalid="true"
                    aria-describedby="matric-error"
                @enderror
            >

        </div>

        @error('matricNo')
            <span class="auth-field-error" id="matric-error" role="alert">
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
            href="{{ route('student.password.request') }}"
            class="auth-forgot"
        >
            Forgot Password?
        </a>
    </div>

    <!-- LOGIN BUTTON -->

    <button type="submit" class="auth-submit">

        <span data-submit-text>
            Sign In to Student Portal
        </span>

        <i
            class="la la-arrow-right"
            data-submit-icon
            aria-hidden="true"
        ></i>

    </button>

</form>

@endsection
