@extends('layouts.other-pages')

@section('pageTitle', 'CGPA Summary | OYSCOHEST Result Portal')
@section('heading', 'CGPA Summary')
@section('subtitle', 'View cumulative grade point average records by programme and admission year.')

@section('content')
<style>
    /* Scoped to this page so shared dashboard styles and footer remain unaffected. */
    .oys-cgpa-page { --cg-green:#23643A; --cg-deep:#174A2A; --cg-burgundy:#641510; --cg-gold:#D5AA43; --cg-border:#e2eae4; color:#27392d; width:100%; max-width:1060px; margin:0 auto; padding:0 0 45px; display:flow-root; }
    .oys-cgpa-page, .oys-cgpa-page * { box-sizing:border-box; }
    .oys-cgpa-page .cg-heading { margin:0 0 22px; }
    .oys-cgpa-page .cg-eyebrow { display:flex; align-items:center; gap:9px; color:var(--cg-green); text-transform:uppercase; letter-spacing:1.2px; font-size:11px; font-weight:800; margin-bottom:7px; }
    .oys-cgpa-page .cg-eyebrow:before { content:""; background:var(--cg-gold); width:17px; height:3px; border-radius:3px; }
    .oys-cgpa-page .cg-heading h1 { color:#243c2b; font-size:clamp(24px,3vw,30px); line-height:1.25; font-weight:750; margin:0 0 8px; }
    .oys-cgpa-page .cg-heading p { font-size:13px; line-height:1.7; color:#687a6d; margin:0; }
    .oys-cgpa-page .cg-card { background:#fff; border:1px solid var(--cg-border); border-radius:16px; overflow:hidden; box-shadow:0 10px 30px rgba(30,66,40,.05); }
    .oys-cgpa-page .cg-card-header { display:flex; align-items:center; gap:14px; padding:23px 26px; border-bottom:1px solid #e8eee9; background:linear-gradient(110deg,#fff 35%,#f5faf6); }
    .oys-cgpa-page .cg-card-icon { width:47px; height:47px; flex:0 0 47px; border-radius:12px; display:flex; align-items:center; justify-content:center; background:#eaf4ed; color:var(--cg-green); font-size:20px; }
    .oys-cgpa-page .cg-card-header h2 { font-size:17px; line-height:1.4; font-weight:750; color:#2a3b2e; margin:0 0 4px; }
    .oys-cgpa-page .cg-card-header p { color:#6c7e70; font-size:12px; line-height:1.6; margin:0; }
    .oys-cgpa-page .cg-card-body { padding:28px 26px 30px; }
    .oys-cgpa-page .cg-fields { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:22px; }
    .oys-cgpa-page .cg-field { min-width:0; }
    .oys-cgpa-page label.cg-label { font-size:12px; font-weight:750; color:#344b39; display:block; margin:0 0 9px; }
    .oys-cgpa-page label.cg-label i { color:var(--cg-green); margin-right:6px; }
    .oys-cgpa-page .cg-required { color:var(--cg-burgundy); }
    .oys-cgpa-page .cg-select-holder { position:relative; }
    .oys-cgpa-page .cg-select-holder:after { content:""; position:absolute; right:18px; top:47%; width:8px; height:8px; border-right:2px solid var(--cg-green); border-bottom:2px solid var(--cg-green); transform:translateY(-65%) rotate(45deg); pointer-events:none; }
    .oys-cgpa-page select.cg-select { display:block; width:100%; height:50px; padding:10px 39px 10px 14px; background:#fcfdfc; border:1px solid #dce6df; border-radius:10px; color:#2b3e30; appearance:none; -webkit-appearance:none; font-size:13px; line-height:1.5; box-shadow:none; }
    .oys-cgpa-page select.cg-select:focus { outline:0; background:#fff; border-color:var(--cg-green); box-shadow:0 0 0 4px rgba(35,100,58,.1); }
    .oys-cgpa-page select.cg-select.is-invalid { border-color:#be4949; }
    .oys-cgpa-page .cg-error { display:block; margin-top:7px; color:#ab3030; font-size:12px; }
    .oys-cgpa-page .cg-actions { display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap; background:#fbfdfb; border-top:1px solid #e9efeb; padding:20px 26px; }
    .oys-cgpa-page .cg-note { color:#6a7a6d; font-size:12px; line-height:1.65; }
    .oys-cgpa-page .cg-note i { color:var(--cg-green); margin-right:6px; }
    .oys-cgpa-page .cg-submit { display:inline-flex; align-items:center; justify-content:center; gap:10px; min-height:45px; padding:11px 21px; background:var(--cg-green); border:0; border-radius:10px; color:#fff; font-size:12px; font-weight:750; cursor:pointer; }
    .oys-cgpa-page .cg-submit:hover, .oys-cgpa-page .cg-submit:focus { background:var(--cg-deep); color:#fff; }
    .oys-cgpa-page .cg-help { margin-top:20px; display:flex; align-items:flex-start; gap:13px; border:1px solid #dce9df; border-radius:12px; background:#f6faf7; padding:17px 20px; }
    .oys-cgpa-page .cg-help > i { color:var(--cg-green); font-size:19px; margin-top:1px; }
    .oys-cgpa-page .cg-help strong { display:block; font-size:12px; color:var(--cg-deep); margin-bottom:3px; }
    .oys-cgpa-page .cg-help p { font-size:12px; line-height:1.7; color:#657669; margin:0; }
    .oys-cgpa-page .cg-alert { border-radius:10px; padding:12px 15px; margin-bottom:18px; font-size:13px; }
    .oys-cgpa-page .cg-alert-success { background:#e8f6eb; color:#174a2a; border:1px solid #cde8d3; }
    .oys-cgpa-page .cg-alert-error { background:#fff0ee; color:#86241f; border:1px solid #efd0cc; }
    @media(max-width:700px) { .oys-cgpa-page .cg-fields { grid-template-columns:1fr; gap:20px; } .oys-cgpa-page .cg-card-header, .oys-cgpa-page .cg-card-body, .oys-cgpa-page .cg-actions { padding:20px; } .oys-cgpa-page .cg-actions { flex-direction:column; align-items:stretch; } .oys-cgpa-page .cg-submit { width:100%; } }
</style>

<div class="oys-cgpa-page">
    <header class="cg-heading">
        <div class="cg-eyebrow">Academic Records</div>
        <h1>CGPA Result Summary</h1>
        <p>Select a programme and admission year to preview students' cumulative results.</p>
    </header>

    @if(session('success'))
        <div class="cg-alert cg-alert-success" role="status">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="cg-alert cg-alert-error" role="alert">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="cg-alert cg-alert-error" role="alert">Please correct the highlighted fields below.</div>
    @endif

    <div class="cg-card">
        <div class="cg-card-header">
            <div class="cg-card-icon"><i class="fas fa-chart-line" aria-hidden="true"></i></div>
            <div>
                <h2>Find CGPA Summary</h2>
                <p>Use the filters below to retrieve the cumulative academic result summary.</p>
            </div>
        </div>

        <form action="{{ route('cgpa-summary-action') }}" method="POST">
            @csrf
            <div class="cg-card-body">
                <div class="cg-fields">
                    <div class="cg-field">
                        <label class="cg-label" for="programme"><i class="fas fa-graduation-cap" aria-hidden="true"></i> Programme <span class="cg-required">*</span></label>
                        <div class="cg-select-holder">
                            <select name="programme" id="programme" class="cg-select @error('programme') is-invalid @enderror" required>
                                <option value="" disabled {{ old('programme') === null ? 'selected' : '' }}>Select programme</option>
                                @foreach($programmes as $d)
                                    <option value="{{ $d->department }}" {{ old('programme') == $d->department ? 'selected' : '' }}>{{ $d->department }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('programme') <span class="cg-error" role="alert">{{ $message }}</span> @enderror
                    </div>

                    <div class="cg-field">
                        <label class="cg-label" for="acad_session"><i class="fas fa-calendar-alt" aria-hidden="true"></i> Admission Year <span class="cg-required">*</span></label>
                        <div class="cg-select-holder">
                            <select name="acad_session" id="acad_session" class="cg-select @error('acad_session') is-invalid @enderror" required>
                                <option value="" disabled {{ old('acad_session') === null ? 'selected' : '' }}>Select admission year</option>
                                @for($year = 2018; $year <= (int) date('Y'); $year++)
                                    <option value="{{ $year }}" {{ old('acad_session') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        @error('acad_session') <span class="cg-error" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="cg-actions">
                <div class="cg-note"><i class="fas fa-info-circle" aria-hidden="true"></i> Both fields are required to preview the CGPA summary.</div>
                <button type="submit" class="cg-submit"><i class="fas fa-eye" aria-hidden="true"></i> Preview Result <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>

    <aside class="cg-help">
        <i class="fas fa-lightbulb" aria-hidden="true"></i>
        <div>
            <strong>Before you continue</strong>
            <p>Confirm the programme and admission year before generating the CGPA summary report.</p>
        </div>
    </aside>
</div>
@endsection
