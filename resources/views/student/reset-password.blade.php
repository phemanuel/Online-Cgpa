<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password | OYSCOHEST Student Portal</title>
    <link rel="icon" href="{{ asset('loginback/vendor/images/favicon.png') }}">
    <style>
        :root { --green:#23643A; --deep:#174A2A; --wine:#641510; --gold:#D5AA43; --ink:#203329; --muted:#63736a; --line:#dfe8df; --bg:#f3f7f3; }
        *,*::before,*::after { box-sizing:border-box; }
        body { margin:0; min-height:100vh; font-family:Arial,Helvetica,sans-serif; color:var(--ink); background:linear-gradient(115deg,rgba(18,59,36,.86),rgba(100,21,16,.58)),url("{{ asset('login/images/login-bg.jpg') }}") center/cover fixed; }
        .reset-page { min-height:100vh; display:flex; align-items:center; justify-content:center; padding:32px 18px; }
        .reset-shell { display:grid; grid-template-columns:minmax(260px, .92fr) minmax(350px, 1.08fr); width:min(940px,100%); background:#fff; overflow:hidden; border-radius:22px; box-shadow:0 24px 65px rgba(5,31,16,.25); }
        .reset-brand { position:relative; display:flex; min-height:565px; flex-direction:column; justify-content:flex-end; overflow:hidden; padding:42px; background:linear-gradient(to bottom,rgba(11,49,27,.28),rgba(15,56,32,.92)),url("{{ asset('login/images/form-v7.jpg') }}") center/cover, var(--deep); color:#fff; }
        .reset-brand::before { content:""; position:absolute; top:0; left:0; width:86px; height:5px; background:var(--gold); }
        .reset-brand > * { position:relative; z-index:1; }
        .brand-mark { display:inline-flex; align-items:center; gap:10px; align-self:flex-start; margin-bottom:25px; padding:9px 12px; border:1px solid rgba(255,255,255,.45); border-radius:10px; font-size:12px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; }
        .brand-mark span { width:10px; height:10px; background:var(--gold); border-radius:50%; }
        .reset-brand h1 { margin:0 0 14px; font-size:clamp(25px,3vw,36px); line-height:1.2; }
        .reset-brand p { margin:0; max-width:310px; color:rgba(255,255,255,.87); font-size:15px; line-height:1.7; }
        .reset-form-panel { padding:48px 48px 40px; }
        .eyebrow { margin:0 0 12px; color:var(--wine); font-size:12px; font-weight:800; letter-spacing:.13em; text-transform:uppercase; }
        .reset-form-panel h2 { margin:0 0 12px; color:var(--deep); font-size:30px; line-height:1.2; }
        .intro { margin:0 0 29px; color:var(--muted); font-size:14px; line-height:1.7; }
        .notice { padding:12px 14px; border-radius:10px; margin:0 0 18px; font-size:14px; line-height:1.5; }
        .notice-error { background:#fff0ef; border:1px solid #f1c6c2; color:#8c201c; }
        .notice-success { background:#edf8f0; border:1px solid #bbdec5; color:#15592c; }
        .field { margin-bottom:21px; }
        .field label { display:block; margin:0 0 9px; color:var(--ink); font-size:14px; font-weight:700; }
        .password-wrap { display:flex; align-items:stretch; min-width:0; border:1px solid var(--line); border-radius:11px; overflow:hidden; background:#fff; transition:border-color .2s,box-shadow .2s; }
        .password-wrap:focus-within { border-color:var(--green); box-shadow:0 0 0 3px rgba(35,100,58,.12); }
        .password-wrap.has-error { border-color:#c34037; }
        .password-wrap input { width:100%; min-width:0; height:48px; border:0; outline:0; background:transparent; padding:0 14px; color:var(--ink); font:inherit; font-size:15px; }
        .password-toggle { flex-shrink:0; border:0; border-left:1px solid var(--line); background:#f8faf8; padding:0 14px; color:var(--deep); font-size:13px; font-weight:700; cursor:pointer; }
        .password-toggle:hover { background:#eaf2eb; }
        .hint { margin:7px 0 0; font-size:12px; color:var(--muted); line-height:1.6; }
        .field-error { display:block; margin-top:7px; color:#ad2b25; font-size:12px; line-height:1.5; }
        .reset-submit { display:block; width:100%; min-height:50px; border:0; border-radius:11px; background:var(--green); color:#fff; font-size:15px; font-weight:700; cursor:pointer; transition:background .2s,transform .2s; }
        .reset-submit:hover { background:var(--deep); }
        .reset-submit:active { transform:translateY(1px); }
        .back-login { margin:24px 0 0; text-align:center; }
        .back-login a { color:var(--wine); text-decoration:none; font-size:14px; font-weight:700; }
        .back-login a:hover { text-decoration:underline; }
        .footnote { margin:29px 0 0; border-top:1px solid var(--line); padding-top:18px; color:var(--muted); font-size:12px; text-align:center; line-height:1.5; }
        @media(max-width:760px) { .reset-shell { grid-template-columns:1fr; max-width:520px; } .reset-brand { min-height:175px; padding:26px 30px; } .reset-brand h1 { font-size:23px; } .reset-brand p { font-size:13px; } .brand-mark { margin-bottom:13px; } .reset-form-panel { padding:32px 28px; } }
        @media(max-width:420px) { .reset-page { padding:16px 11px; } .reset-form-panel { padding:28px 21px; } .reset-form-panel h2 { font-size:26px; } .reset-brand { padding:24px 21px; } }
    </style>
</head>
<body>
<main class="reset-page">
    <div class="reset-shell">
        <aside class="reset-brand" aria-label="Student portal branding">
            <div class="brand-mark"><span aria-hidden="true"></span> OYSCOHEST Student Portal</div>
            <h1>Secure your student account.</h1>
            <p>Choose a new password to continue accessing your student services safely.</p>
        </aside>

        <section class="reset-form-panel" aria-labelledby="reset-title">
            <p class="eyebrow">Account recovery</p>
            <h2 id="reset-title">Reset Password</h2>
            <p class="intro">Enter and confirm your new password to complete your password reset.</p>

            @if(session('success'))
                <div class="notice notice-success" role="status">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="notice notice-error" role="alert">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="notice notice-error" role="alert">Please correct the highlighted fields below.</div>
            @endif

            <form action="{{ route('student.password.update') }}" method="POST" id="resetPasswordForm">
                @csrf
                <div class="field">
                    <label for="password">New Password</label>
                    <div class="password-wrap @error('password') has-error @enderror">
                        <input type="password" name="password" id="password" minlength="6" autocomplete="new-password" required aria-describedby="passwordHint @error('password') passwordServerError @enderror">
                        <button class="password-toggle" type="button" data-toggle-password="password" aria-label="Show new password" aria-pressed="false">Show</button>
                    </div>
                    <p class="hint" id="passwordHint">Use at least 6 characters.</p>
                    @error('password')<span class="field-error" id="passwordServerError">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="password_confirmation">Confirm New Password</label>
                    <div class="password-wrap @error('password_confirmation') has-error @enderror">
                        <input type="password" name="password_confirmation" id="password_confirmation" minlength="6" autocomplete="new-password" required aria-describedby="confirmationError">
                        <button class="password-toggle" type="button" data-toggle-password="password_confirmation" aria-label="Show confirmation password" aria-pressed="false">Show</button>
                    </div>
                    <span class="field-error" id="confirmationError" role="alert" aria-live="polite">@error('password_confirmation'){{ $message }}@enderror</span>
                </div>
                <button type="submit" class="reset-submit">Reset Password</button>
            </form>
            <p class="back-login"><a href="{{ route('student-login') }}">&larr; Back to Login</a></p>
            <p class="footnote">Oyo State College of Health Science and Technology</p>
        </section>
    </div>
</main>
<script>
(function () {
    'use strict';
    document.querySelectorAll('[data-toggle-password]').forEach(function (button) {
        button.addEventListener('click', function () {
            var input = document.getElementById(button.getAttribute('data-toggle-password'));
            if (!input) return;
            var showing = input.type === 'password';
            input.type = showing ? 'text' : 'password';
            button.textContent = showing ? 'Hide' : 'Show';
            button.setAttribute('aria-pressed', String(showing));
            button.setAttribute('aria-label', (showing ? 'Hide ' : 'Show ') + (input.id === 'password' ? 'new password' : 'confirmation password'));
        });
    });
    var form = document.getElementById('resetPasswordForm');
    var password = document.getElementById('password');
    var confirmation = document.getElementById('password_confirmation');
    var error = document.getElementById('confirmationError');
    function validateConfirmation() {
        var mismatch = !!confirmation.value && password.value !== confirmation.value;
        confirmation.setCustomValidity(mismatch ? 'Passwords do not match.' : '');
        if (error) error.textContent = mismatch ? 'Passwords do not match.' : '';
        return !mismatch;
    }
    if (form && password && confirmation) {
        password.addEventListener('input', validateConfirmation);
        confirmation.addEventListener('input', validateConfirmation);
        form.addEventListener('submit', function (event) {
            if (!validateConfirmation()) {
                event.preventDefault();
                confirmation.reportValidity();
            }
        });
    }
})();
</script>
</body>
</html>
