<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#174A2A">
    <title>Forgot Password | OYSCOHEST Student Portal</title>
    <link rel="icon" href="{{ asset('loginback/vendor/images/favicon.png') }}">
    <style>
        :root { --green:#23643A; --deep:#174A2A; --burgundy:#641510; --gold:#D5AA43; --ink:#1d2934; --muted:#62706c; --border:#dfe8e1; --surface:#fff; }
        *,*::before,*::after { box-sizing:border-box; }
        body { margin:0; min-height:100vh; font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif; color:var(--ink); background:#f3f7f3; }
        .fp-page { min-height:100vh; display:grid; place-items:center; padding:32px 18px; position:relative; isolation:isolate; }
        .fp-page::before { content:""; position:absolute; inset:0; z-index:-2; background:linear-gradient(135deg,rgba(14,51,30,.88),rgba(24,68,42,.75)),url("{{ asset('login/images/login-bg.jpg') }}") center/cover no-repeat; }
        .fp-page::after { content:""; position:absolute; z-index:-1; width:330px; height:330px; border:1px solid rgba(255,255,255,.14); border-radius:50%; top:-140px; right:-100px; }
        .fp-card { width:min(100%,880px); min-height:500px; display:grid; grid-template-columns: .88fr 1.12fr; background:var(--surface); border-radius:22px; overflow:hidden; box-shadow:0 24px 70px rgba(0,0,0,.23); }
        .fp-intro { display:flex; flex-direction:column; justify-content:space-between; padding:40px 35px; background:linear-gradient(145deg,rgba(21,69,38,.96),rgba(35,100,58,.92)),url("{{ asset('login/images/form-v7.jpg') }}") center/cover no-repeat; color:#fff; position:relative; }
        .fp-intro::after { content:""; position:absolute; width:200px; height:200px; border:1px solid rgba(255,255,255,.15); border-radius:50%; right:-90px; bottom:-75px; pointer-events:none; }
        .fp-brand { display:flex; align-items:center; gap:12px; font-size:13px; letter-spacing:.035em; font-weight:750; line-height:1.55; position:relative; z-index:1; }
        .fp-brand-icon { width:43px; height:43px; display:grid; place-items:center; background:rgba(255,255,255,.13); border:1px solid rgba(255,255,255,.23); border-radius:13px; flex:none; }
        .fp-brand-icon svg { width:25px; height:25px; }
        .fp-intro-copy { position:relative; z-index:1; }
        .fp-kicker { display:inline-flex; padding:7px 11px; border:1px solid rgba(213,170,67,.58); color:#f5d88d; border-radius:40px; font-size:11px; letter-spacing:.11em; font-weight:750; text-transform:uppercase; }
        .fp-intro h2 { font-size:clamp(27px,3.3vw,37px); line-height:1.15; letter-spacing:-.04em; margin:19px 0 14px; font-weight:800; }
        .fp-intro p { margin:0; color:rgba(255,255,255,.84); font-size:14px; line-height:1.8; }
        .fp-intro-footer { color:rgba(255,255,255,.67); font-size:12px; position:relative; z-index:1; }
        .fp-main { padding:clamp(32px,5vw,58px); display:flex; flex-direction:column; justify-content:center; }
        .fp-step { color:var(--green); font-size:11px; letter-spacing:.13em; text-transform:uppercase; font-weight:800; margin:0 0 13px; }
        .fp-main h1 { font-size:clamp(26px,3vw,34px); line-height:1.2; letter-spacing:-.04em; margin:0 0 12px; color:var(--ink); font-weight:800; }
        .fp-desc { font-size:14px; line-height:1.75; color:var(--muted); margin:0 0 28px; }
        .fp-alert { padding:12px 14px; border-radius:11px; margin:0 0 19px; font-size:13px; line-height:1.55; }
        .fp-alert-error { background:#fff2f0; color:#8e281e; border:1px solid #f5d0cb; }
        .fp-alert-success { background:#eaf6ee; color:#195c32; border:1px solid #c5e3ce; }
        .fp-field { margin-bottom:22px; }
        .fp-field label { display:block; font-size:13px; font-weight:750; color:var(--ink); margin-bottom:9px; }
        .fp-field input { display:block; width:100%; min-height:51px; padding:12px 15px; border:1px solid var(--border); border-radius:11px; outline:none; background:#fff; font:inherit; font-size:15px; color:var(--ink); transition:border-color .2s, box-shadow .2s; }
        .fp-field input:focus { border-color:var(--green); box-shadow:0 0 0 4px rgba(35,100,58,.11); }
        .fp-field input[aria-invalid="true"] { border-color:#c84036; }
        .fp-field .fp-error { display:block; margin-top:7px; color:#a42d26; font-size:12px; }
        .fp-submit { width:100%; min-height:51px; border:0; border-radius:11px; background:var(--green); color:white; font:inherit; font-weight:750; font-size:14px; cursor:pointer; transition:background .2s,transform .2s; }
        .fp-submit:hover { background:var(--deep); }
        .fp-submit:focus-visible,.fp-back:focus-visible { outline:3px solid var(--gold); outline-offset:3px; }
        .fp-submit:active { transform:translateY(1px); }
        .fp-back { display:inline-flex; justify-content:center; align-items:center; gap:8px; align-self:center; margin-top:24px; color:var(--burgundy); text-decoration:none; font-size:13px; font-weight:750; }
        .fp-back:hover { text-decoration:underline; }
        .fp-note { margin-top:26px; padding-top:19px; border-top:1px solid #edf0ed; font-size:12px; color:var(--muted); line-height:1.65; }
        @media(max-width:720px) { .fp-card { max-width:510px; grid-template-columns:1fr; } .fp-intro { min-height:175px; padding:24px 27px; gap:18px; } .fp-intro h2 { font-size:24px; margin:11px 0 5px; } .fp-intro-copy p,.fp-intro-footer { display:none; } .fp-main { padding:32px 27px 37px; } }
        @media(max-width:390px) { .fp-page { padding:14px; } .fp-intro,.fp-main { padding-left:21px; padding-right:21px; } }
    </style>
</head>
<body>
    <main class="fp-page">
        <section class="fp-card" aria-labelledby="forgot-password-title">
            <aside class="fp-intro">
                <div class="fp-brand">
                    <div class="fp-brand-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10.5 12 5l9 5.5-9 5.5-9-5.5Z"/><path d="M7 13.2v4.3c3 2 7 2 10 0v-4.3"/><path d="M21 10.5V17"/></svg>
                    </div>
                    <span>OYO STATE COLLEGE OF HEALTH<br>SCIENCE AND TECHNOLOGY</span>
                </div>
                <div class="fp-intro-copy">
                    <span class="fp-kicker">Student Portal</span>
                    <h2>Secure access to your academic portal.</h2>
                    <p>Start the password recovery process using your registered matriculation number.</p>
                </div>
                <div class="fp-intro-footer">E-Result Portal &bull; Student services</div>
            </aside>

            <div class="fp-main">
                <p class="fp-step">Account recovery</p>
                <h1 id="forgot-password-title">Forgot your password?</h1>
                <p class="fp-desc">Enter your matriculation number below to continue with password recovery.</p>

                @if(session('success'))
                    <div class="fp-alert fp-alert-success" role="status">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="fp-alert fp-alert-error" role="alert">{{ session('error') }}</div>
                @endif

                <form action="{{ route('student.password.verify') }}" method="POST">
                    @csrf
                    <div class="fp-field">
                        <label for="matricNo">Matriculation number</label>
                        <input type="text"
                               id="matricNo"
                               name="matricNo"
                               value="{{ old('matricNo') }}"
                               placeholder="Enter your matriculation number"
                               autocomplete="username"
                               autocapitalize="characters"
                               maxlength="100"
                               aria-invalid="{{ $errors->has('matricNo') ? 'true' : 'false' }}"
                               @error('matricNo') aria-describedby="matricNo-error" @enderror
                               required autofocus>
                        @error('matricNo')
                            <span id="matricNo-error" class="fp-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="fp-submit">Continue</button>
                </form>

                <a class="fp-back" href="{{ route('student-login') }}"><span aria-hidden="true">&larr;</span> Back to Login</a>
                <p class="fp-note">For your security, use only your own student details when requesting account access.</p>
            </div>
        </section>
    </main>
</body>
</html>
