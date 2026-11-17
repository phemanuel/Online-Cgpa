
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('pageTitle', 'OYSCOHEST Result Portal')</title>

    <link rel="icon" href="{{ asset('images/oyscohest-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('login/css/opensans-font.css') }}">
    <link rel="stylesheet" href="{{ asset('login/fonts/line-awesome/css/line-awesome.min.css') }}">

    <style>
       
:root {
    --primary: #23643A;
    --primary-dark: #174A2A;
    --primary-light: #EAF5ED;

    --green: #23643A;
    --green-light: #EAF5ED;

    --brown: #641510;
    --brown-dark: #450C0A;

    --gold: #D5AA43;

    --text: #292B30;
    --muted: #737985;
    --border: #E7E4E2;
    --surface: #FFFDF8;

    --danger: #B42335;
    --success: #167247;
}


        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            min-height: 100dvh;
            font-family: 'Open Sans', Arial, sans-serif;
            color: var(--text);
            background:
                linear-gradient(
                    rgba(250, 247, 244, .94),
                    rgba(250, 247, 244, .96)
                ),
                url("{{ asset('login/images/login-bg.jpg') }}")
                center / cover no-repeat;
            -webkit-font-smoothing: antialiased;
        }

        button,
        input {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        .auth-page {
            min-height: 100vh;
            min-height: 100dvh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 1080px;
        }

        .auth-card {
            display: grid;
            grid-template-columns: 46% 54%;
            min-height: 630px;
            overflow: hidden;
            background: #fff;
            border: 1px solid #efe8e5;
            border-radius: 20px;
            box-shadow:
                0 25px 65px rgba(75, 28, 24, .10),
                0 3px 12px rgba(60, 28, 22, .04);
        }

        /* BRANDING PANEL */

        
.auth-brand-panel {
    position: relative;
    isolation: isolate;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 40px;
    min-width: 0;
    padding: 42px;
    color: #fff;

    background:
        linear-gradient(
            155deg,
            rgba(23, 74, 42, .96),
            rgba(35, 100, 58, .88)
        ),
        url("{{ asset('login/images/form-v7.jpg') }}")
        center / cover no-repeat;
}


        .auth-brand-panel::after {
            content: '';
            position: absolute;
            z-index: -1;
            right: -130px;
            bottom: 75px;
            width: 310px;
            height: 310px;
            border: 1px solid rgba(255,255,255,.13);
            border-radius: 50%;
            box-shadow:
                0 0 0 55px rgba(255,255,255,.025),
                0 0 0 115px rgba(255,255,255,.015);
            pointer-events: none;
        }

        .auth-brand-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 79px;
            height: 85px;
            flex-shrink: 0;
            padding: 6px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 16px rgba(0,0,0,.12);
        }

        .auth-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .auth-brand-title {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .5px;
            line-height: 1.5;
        }

        .auth-brand-caption {
            margin-top: 4px;
            font-size: 11px;
            line-height: 1.6;
            color: rgba(255,255,255,.78);
        }

        .auth-brand-content {
            position: relative;
            z-index: 1;
        }

        .auth-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 30px;
            border: 1px solid rgba(255,255,255,.18);
            background: rgba(255,255,255,.09);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .auth-eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--gold);
        }

        .auth-brand-content h1 {
            max-width: 400px;
            margin: 24px 0 16px;
            font-size: clamp(30px, 3vw, 40px);
            letter-spacing: -1.2px;
            font-weight: 700;
            line-height: 1.25;
        }

        .auth-brand-content p {
            max-width: 370px;
            margin: 0;
            font-size: 13px;
            line-height: 1.95;
            color: rgba(255,255,255,.80);
        }

        .auth-brand-footer {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding-top: 19px;
            border-top: 1px solid rgba(255,255,255,.20);
            color: rgba(255,255,255,.75);
            font-size: 11px;
            line-height: 1.8;
        }

        .auth-brand-footer i {
            margin-top: 2px;
            color: var(--gold);
            font-size: 18px;
        }

        /* LOGIN FORM PANEL */

        .auth-form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 65px;
        }

        .auth-form-container {
            width: 100%;
            max-width: 390px;
        }

        .auth-form-eyebrow {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 12px;
            color: var(--green);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .auth-form-eyebrow::before {
            content: '';
            width: 21px;
            height: 3px;
            background: var(--gold);
            border-radius: 3px;
        }

        .auth-form-heading {
            margin: 0 0 10px;
            font-size: 31px;
            font-weight: 700;
            line-height: 1.3;
            letter-spacing: -1px;
        }

        .auth-form-description {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.85;
        }

        .auth-form {
            margin-top: 34px;
        }

        .auth-field {
            margin-bottom: 22px;
        }

        .auth-label {
            display: block;
            margin-bottom: 9px;
            font-size: 12px;
            font-weight: 700;
            color: #40434b;
        }

        .auth-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .auth-input-icon {
            position: absolute;
            left: 16px;
            font-size: 20px;
            color: #9a9ca4;
            pointer-events: none;
            transition: color .2s ease;
        }

        .auth-input {
            width: 100%;
            height: 54px;
            padding: 0 16px 0 48px;
            background: #fdfcfa;
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 10px;
            outline: none;
            font-size: 13px;
            transition:
                background .2s,
                border-color .2s,
                box-shadow .2s;
        }

        .auth-input::placeholder {
            color: #a3a3a9;
        }

        .auth-input:focus {
            background: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(35, 100, 58, .10);
        }

        .auth-input-wrap:focus-within .auth-input-icon {
            color: var(--primary);
        }

        .auth-input.is-invalid {
            border-color: var(--danger);
        }

        .auth-password-input {
            padding-right: 55px;
        }

        .auth-password-toggle {
            position: absolute;
            right: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 39px;
            height: 39px;
            background: transparent;
            border: 0;
            border-radius: 8px;
            color: #898d95;
            font-size: 20px;
        }

        .auth-password-toggle:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

       .auth-password-toggle:focus-visible,
        .auth-submit:focus-visible,
        .auth-forgot:focus-visible {
            outline: 3px solid rgba(35, 100, 58, .35);
            outline-offset: 3px;
        }

        .auth-field-error {
            display: block;
            margin-top: 8px;
            font-size: 12px;
            line-height: 1.6;
            color: var(--danger);
        }

        .auth-options {
            display: flex;
            justify-content: flex-end;
            margin: 0 0 27px;
        }

        .auth-forgot {
            color: var(--primary);
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
        }

        .auth-forgot:hover {
            text-decoration: underline;
        }

        .auth-submit {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            width: 100%;
            min-height: 54px;
            padding: 13px 20px;
            background: var(--primary);
            color: #fff;
            border: 0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            transition:
                background .2s,
                box-shadow .2s,
                transform .2s;
        }

        .auth-submit:hover:not(:disabled) {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(35, 100, 58, .17);
        }

        .auth-submit:disabled {
            opacity: .75;
            cursor: wait;
        }

        .auth-submit i {
            font-size: 18px;
        }

        /* FEEDBACK */

        .auth-alert {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 14px 15px;
            margin-top: 22px;
            border-radius: 10px;
            border: 1px solid transparent;
            font-size: 12px;
            line-height: 1.7;
        }

        .auth-alert i {
            margin-top: 2px;
            font-size: 18px;
            flex-shrink: 0;
        }

        .auth-alert-success {
            background: var(--green-light);
            border-color: #c9e8d0;
            color: var(--success);
        }

        .auth-alert-danger {
            background: #fff0f0;
            border-color: #f3caca;
            color: var(--danger);
        }

        .auth-alert ul {
            margin: 6px 0 0;
            padding-left: 18px;
        }

        .auth-security {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 27px;
            color: #8a8e96;
            font-size: 11px;
            line-height: 1.7;
            text-align: center;
        }

        .auth-security i {
            color: var(--green);
            font-size: 15px;
        }

        .auth-copyright {
            margin-top: 23px;
            color: #858087;
            text-align: center;
            font-size: 11px;
            line-height: 1.7;
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {
            .auth-card {
                grid-template-columns: 43% 57%;
            }

            .auth-brand-panel {
                padding: 30px;
            }

            .auth-form-panel {
                padding: 48px 38px;
            }

            .auth-brand-content h1 {
                font-size: 31px;
            }
        }

        @media (max-width: 700px) {
            .auth-page {
                padding: 18px 14px;
            }

            .auth-wrapper {
                max-width: 470px;
            }

            .auth-card {
                display: flex;
                flex-direction: column;
                min-height: auto;
                border-radius: 16px;
            }

            .auth-brand-panel {
                gap: 0;
                padding: 22px 25px;
            }

            .auth-logo {
                width: 58px;
                height: 63px;
                padding: 4px;
            }

            .auth-brand-title {
                font-size: 14px;
            }

            .auth-brand-caption {
                font-size: 10px;
            }

            .auth-brand-content,
            .auth-brand-footer {
                display: none;
            }

            .auth-form-panel {
                padding: 38px 29px 42px;
            }

            .auth-form-heading {
                font-size: 27px;
            }

            .auth-form {
                margin-top: 29px;
            }
        }

        @media (max-width: 380px) {
            .auth-page {
                padding: 12px;
            }

            .auth-brand-panel {
                padding: 18px 20px;
            }

            .auth-form-panel {
                padding: 31px 21px 35px;
            }

            .auth-form-heading {
                font-size: 25px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

<main class="auth-page">
    <div class="auth-wrapper">

        <div class="auth-card">

            <!-- SHARED BRAND PANEL -->

            <aside class="auth-brand-panel">

                <div class="auth-brand-header">

                    <div class="auth-logo">
                        <img
                            src="{{ asset('images/oyscohest-logo.png') }}"
                            alt="Oyo State College of Health Science and Technology Logo"
                        >
                    </div>

                    <div>
                        <div class="auth-brand-title">
                            OYSCOHEST
                        </div>

                        <div class="auth-brand-caption">
                            Result Management Portal
                        </div>
                    </div>

                </div>

                <div class="auth-brand-content">

                    <div class="auth-eyebrow">
                        <span class="auth-eyebrow-dot"></span>
                        @yield('portalLabel', 'Official Result Portal')
                    </div>

                    <h1>
                        @yield('brandHeading', 'Your academic results, in one place.')
                    </h1>

                    <p>
                        @yield('brandDescription', 'Welcome to the official result management portal of Oyo State College of Health Science and Technology.')
                    </p>

                </div>

                <div class="auth-brand-footer">
                    <i class="la la-university" aria-hidden="true"></i>
                    <span>
                        Oyo State College of Health Science and Technology
                    </span>
                </div>

            </aside>

            <!-- DYNAMIC FORM PANEL -->

            <section class="auth-form-panel">

                <div class="auth-form-container">

                    <div class="auth-form-eyebrow">
                        @yield('formLabel', 'Account Access')
                    </div>

                    <h2 class="auth-form-heading">
                        @yield('formHeading', 'Welcome back')
                    </h2>

                    <p class="auth-form-description">
                        @yield('formDescription')
                    </p>

                    <!-- SESSION ALERTS -->

                    @if(session('success'))
                        <div class="auth-alert auth-alert-success" role="status">
                            <i class="la la-check-circle" aria-hidden="true"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="auth-alert auth-alert-danger" role="alert">
                            <i class="la la-exclamation-circle" aria-hidden="true"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    @if($errors->has('login'))
                        <div class="auth-alert auth-alert-danger" role="alert">
                            <i class="la la-exclamation-circle" aria-hidden="true"></i>
                            <span>{{ $errors->first('login') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        @php
                            $otherErrors = collect($errors->messages())
                                ->except([
                                    'email',
                                    'matricNo',
                                    'password',
                                    'login'
                                ])
                                ->flatten();
                        @endphp

                        @if($otherErrors->isNotEmpty())
                            <div class="auth-alert auth-alert-danger" role="alert">
                                <i class="la la-exclamation-circle" aria-hidden="true"></i>
                                <div>
                                    <strong>Please check the following:</strong>
                                    <ul>
                                        @foreach($otherErrors as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endif

                    @yield('authForm')

                    <div class="auth-security">
                        <i class="la la-lock" aria-hidden="true"></i>
                        <span>
                            Use your registered account credentials.
                        </span>
                    </div>

                </div>

            </section>

        </div>

        <footer class="auth-copyright">
            &copy; {{ date('Y') }}
            Oyo State College of Health Science and Technology.
            All rights reserved.
        </footer>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // SHARED PASSWORD VISIBILITY

    document.querySelectorAll('[data-password-toggle]').forEach(function (button) {

        button.addEventListener('click', function () {

            const targetId = button.getAttribute('data-password-toggle');
            const input = document.getElementById(targetId);
            const icon = button.querySelector('i');

            if (!input || !icon) return;

            const show = input.type === 'password';

            input.type = show ? 'text' : 'password';

            icon.classList.toggle('la-eye', !show);
            icon.classList.toggle('la-eye-slash', show);

            button.setAttribute(
                'aria-label',
                show ? 'Hide password' : 'Show password'
            );

            button.setAttribute('aria-pressed', show ? 'true' : 'false');

        });

    });

    // SHARED LOGIN SUBMISSION

    document.querySelectorAll('[data-auth-form]').forEach(function (form) {

        let submitting = false;

        form.addEventListener('submit', function (event) {

            if (submitting) {
                event.preventDefault();
                return;
            }

            if (!form.checkValidity()) return;

            submitting = true;

            const submitButton = form.querySelector('[type="submit"]');
            const buttonText = form.querySelector('[data-submit-text]');
            const buttonIcon = form.querySelector('[data-submit-icon]');

            if (submitButton) {
                submitButton.disabled = true;
            }

            if (buttonText) {
                buttonText.textContent = 'Signing In...';
            }

            if (buttonIcon) {
                buttonIcon.className = 'la la-spinner la-spin';
            }

        });

    });

});
</script>

</body>
</html>
