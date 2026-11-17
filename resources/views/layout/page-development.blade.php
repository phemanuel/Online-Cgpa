@extends('layouts.other-pages')

@section('pageTitle', 'Under Development | OYSCOHEST E-Result')
@section('heading', 'Under Development')
@section('subtitle', 'This section of the E-Result Portal is being prepared.')

@section('content')
<style>
    .oys-development { --forest:#23643A; --deep:#174A2A; --burgundy:#641510; --gold:#D5AA43; --ink:#18291f; --muted:#657369; width:100%; padding:24px 0 42px; }
    .oys-development * { box-sizing:border-box; }
    .oys-development .dev-card { position:relative; max-width:790px; margin:0 auto; overflow:hidden; background:#fff; border:1px solid #e1eae3; border-radius:22px; box-shadow:0 14px 45px rgba(26,64,39,.07); text-align:center; }
    .oys-development .dev-card:before { content:""; position:absolute; top:0; left:0; right:0; height:5px; background:linear-gradient(90deg,var(--forest) 0%,var(--forest) 66%,var(--gold) 66%,var(--gold) 83%,var(--burgundy) 83%); }
    .oys-development .dev-inner { padding:clamp(28px,6vw,64px) clamp(20px,5vw,60px); }
    .oys-development .dev-icon { display:flex; align-items:center; justify-content:center; width:86px; height:86px; margin:0 auto 24px; border-radius:24px; color:var(--forest); background:#edf5ee; border:1px solid #d9e9dd; font-size:36px; }
    .oys-development .dev-eyebrow { display:inline-block; margin-bottom:12px; font-size:11px; font-weight:800; letter-spacing:1.8px; color:var(--burgundy); text-transform:uppercase; }
    .oys-development h2 { margin:0 0 14px; color:var(--deep); font-size:clamp(25px,4vw,37px); font-weight:800; line-height:1.2; }
    .oys-development .dev-description { max-width:540px; margin:0 auto; color:var(--muted); font-size:15px; line-height:1.85; }
    .oys-development .dev-rule { width:55px; height:3px; margin:26px auto; background:var(--gold); border-radius:4px; }
    .oys-development .dev-media { margin:0 auto 25px; max-width:380px; }
    .oys-development .dev-media img { width:100%; max-height:245px; display:block; margin:auto; object-fit:contain; }
    .oys-development .dev-action { display:inline-flex; align-items:center; justify-content:center; gap:10px; min-height:46px; padding:12px 22px; border:1px solid var(--forest); border-radius:11px; background:var(--forest); color:white!important; font-weight:700; font-size:14px; text-decoration:none!important; transition:background .15s ease,transform .15s ease; }
    .oys-development .dev-action:hover,.oys-development .dev-action:focus { background:var(--deep); transform:translateY(-1px); }
    .oys-development .dev-note { display:block; margin-top:17px; font-size:12px; color:#829086; }
    @media(max-width:575px){ .oys-development {padding:10px 0 28px;} .oys-development .dev-card{border-radius:15px;} .oys-development .dev-icon{width:72px;height:72px;font-size:30px;} }
</style>

<div class="oys-development">
    <section class="dev-card" aria-labelledby="development-heading">
        <div class="dev-inner">
            <div class="dev-icon" aria-hidden="true"><i class="fas fa-tools"></i></div>
            <span class="dev-eyebrow">E-Result Portal Update</span>
            <h2 id="development-heading">This Page Is Under Development</h2>
            <p class="dev-description">
                This section isn't available yet. We're working to make it ready for you.
                Please return to your dashboard to continue using the available portal features.
            </p>
            <div class="dev-rule" aria-hidden="true"></div>
            <div class="dev-media">
                <img src="{{ asset('dashboard/assets/img/development.jpg') }}"
                     alt="Illustration showing a page under development"
                     loading="lazy"
                     onerror="this.closest('.dev-media').style.display='none'">
            </div>
            <a href="{{ route('admin-dashboard') }}" class="dev-action">
                <i class="fas fa-arrow-left" aria-hidden="true"></i> Back to Dashboard
            </a>
            <span class="dev-note">Oyo State College of Health Science and Technology</span>
        </div>
    </section>
</div>
@endsection
