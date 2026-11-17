@extends('layouts.other-pages')

@section('pageTitle', 'Semester Result Summary | OYSCOHEST Result Portal')

@section('content')
<style>
    .oys-semester-page { --sr-green:#23643A; --sr-dark:#174A2A; --sr-brown:#641510; --sr-gold:#D5AA43; --sr-border:#e1e9e3; --sr-muted:#6b7a70; max-width:1120px; margin:0 auto; padding-bottom:36px; color:#273a2e; }
    .oys-semester-page * { box-sizing:border-box; }
    .oys-semester-page .sr-heading { display:flex; align-items:flex-start; justify-content:space-between; gap:18px; flex-wrap:wrap; margin-bottom:25px; }
    .oys-semester-page .sr-eyebrow { color:var(--sr-green); text-transform:uppercase; letter-spacing:1.2px; font-size:11px; font-weight:800; margin-bottom:8px; }
    .oys-semester-page .sr-eyebrow::before { content:''; display:inline-block; width:16px; height:3px; border-radius:4px; background:var(--sr-gold); vertical-align:middle; margin-right:9px; }
    .oys-semester-page h1 { margin:0 0 8px; color:#25382a; font-size:clamp(24px,3vw,30px); line-height:1.3; font-weight:750; }
    .oys-semester-page .sr-description { font-size:13px; color:var(--sr-muted); line-height:1.8; margin:0; }
    .oys-semester-page .sr-card { background:#fff; border:1px solid var(--sr-border); border-radius:17px; overflow:hidden; box-shadow:0 10px 30px rgba(25,70,40,.05); }
    .oys-semester-page .sr-card-head { padding:23px 27px; border-bottom:1px solid #e8eee9; background:linear-gradient(110deg,#fff 35%,#f5faf6); display:flex; align-items:center; gap:15px; }
    .oys-semester-page .sr-card-icon { width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; flex:none; color:var(--sr-green); background:#eaf5ed; font-size:20px; }
    .oys-semester-page .sr-card-head h2 { margin:0 0 5px; font-size:17px; font-weight:750; color:#27392c; }
    .oys-semester-page .sr-card-head p { margin:0; font-size:12px; line-height:1.6; color:var(--sr-muted); }
    .oys-semester-page .sr-card-body { padding:28px 27px 30px; }
    .oys-semester-page .sr-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:23px; }
    .oys-semester-page .sr-field { min-width:0; }
    .oys-semester-page .sr-label { display:block; font-weight:750; font-size:12px; color:#35453a; margin-bottom:9px; }
    .oys-semester-page .sr-label i { color:var(--sr-green); margin-right:6px; }
    .oys-semester-page .sr-label .sr-required { color:var(--sr-brown); }
    .oys-semester-page .sr-select-wrap { position:relative; }
    .oys-semester-page .sr-select-wrap:after { content:''; position:absolute; top:49%; right:18px; width:8px; height:8px; border-right:2px solid var(--sr-green); border-bottom:2px solid var(--sr-green); transform:translateY(-70%) rotate(45deg); pointer-events:none; }
    .oys-semester-page select.sr-select { display:block; width:100%; height:50px; min-height:50px; padding:10px 40px 10px 14px; border:1px solid #dce6df; border-radius:10px; background:#fcfdfc; color:#2d4031; font-size:13px; line-height:1.5; appearance:none; -webkit-appearance:none; box-shadow:none; transition:box-shadow .2s,border-color .2s; }
    .oys-semester-page select.sr-select:focus { outline:0; border-color:var(--sr-green); background:#fff; box-shadow:0 0 0 4px rgba(35,100,58,.1); }
    .oys-semester-page select.sr-select.is-invalid { border-color:#c84747; }
    .oys-semester-page .sr-error { display:block; margin-top:7px; font-size:12px; color:#b22f36; }
    .oys-semester-page .sr-actions { padding:21px 27px; display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; border-top:1px solid #e9efeb; background:#fbfdfb; }
    .oys-semester-page .sr-note { font-size:12px; line-height:1.6; color:var(--sr-muted); }
    .oys-semester-page .sr-note i { color:var(--sr-green); margin-right:7px; }
    .oys-semester-page .sr-submit { min-height:46px; border:0; background:var(--sr-green); color:#fff; font-size:12px; font-weight:750; padding:12px 21px; border-radius:10px; display:inline-flex; gap:11px; align-items:center; justify-content:center; cursor:pointer; transition:background .2s,box-shadow .2s; }
    .oys-semester-page .sr-submit:hover { color:#fff; background:var(--sr-dark); box-shadow:0 7px 18px rgba(35,100,58,.16); }
    .oys-semester-page .sr-submit:focus-visible { outline:3px solid rgba(35,100,58,.3); outline-offset:3px; }
    .oys-semester-page .sr-help { margin-top:20px; border:1px solid #dae9de; border-radius:12px; background:#f5faf6; padding:18px 20px; display:flex; gap:13px; align-items:flex-start; }
    .oys-semester-page .sr-help > i { flex:none; color:var(--sr-green); font-size:19px; margin-top:2px; }
    .oys-semester-page .sr-help strong { display:block; font-size:12px; margin-bottom:4px; color:var(--sr-dark); }
    .oys-semester-page .sr-help p { font-size:12px; line-height:1.75; color:#617366; margin:0; }
    .oys-semester-page .sr-alert { padding:12px 15px; margin-bottom:18px; border-radius:10px; font-size:13px; }
    .oys-semester-page .sr-alert-success { color:#174a2a; background:#e8f6eb; border:1px solid #cde8d3; }
    .oys-semester-page .sr-alert-danger { color:#86241f; background:#fff0ee; border:1px solid #f0d2ce; }
    @media(max-width:700px) { .oys-semester-page .sr-grid { grid-template-columns:1fr; gap:19px; } .oys-semester-page .sr-card-head { padding:20px; } .oys-semester-page .sr-card-body { padding:22px 20px; } .oys-semester-page .sr-actions { padding:20px; flex-direction:column; align-items:stretch; } .oys-semester-page .sr-submit { width:100%; } }
</style>

<div class="oys-semester-page">
    <div class="sr-heading">
        <div>
            <div class="sr-eyebrow">Academic Records</div>
            <h1>Semester Result Summary</h1>
            <p class="sr-description">Choose a programme, admission year and academic level to preview the semester result summary.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="sr-alert sr-alert-success" role="status">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="sr-alert sr-alert-danger" role="alert">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="sr-alert sr-alert-danger" role="alert">Please correct the highlighted fields before proceeding.</div>
    @endif

    <div class="sr-card">
        <div class="sr-card-head">
            <div class="sr-card-icon"><i class="fas fa-chart-bar" aria-hidden="true"></i></div>
            <div>
                <h2>Find Semester Result Summary</h2>
                <p>Choose the programme, admission year and academic level to view the result summary.</p>
            </div>
        </div>

        <form action="{{ route('semester-summary-action') }}" method="POST">
            @csrf
            <div class="sr-card-body">
                <div class="sr-grid">
                    <div class="sr-field">
                        <label class="sr-label" for="programme"><i class="fas fa-graduation-cap" aria-hidden="true"></i> Programme <span class="sr-required">*</span></label>
                        <div class="sr-select-wrap">
                            <select class="sr-select @error('programme') is-invalid @enderror" name="programme" id="programme" required>
                                <option value="" disabled {{ old('programme') === null ? 'selected' : '' }}>Select programme</option>
                                @foreach($programmes as $d)
                                    <option value="{{ $d->department }}" {{ old('programme') == $d->department ? 'selected' : '' }}>{{ $d->department }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('programme') <span class="sr-error" role="alert">{{ $message }}</span> @enderror
                    </div>

                    <div class="sr-field">
                        <label class="sr-label" for="acad_session"><i class="fas fa-calendar-alt" aria-hidden="true"></i> Admission Year <span class="sr-required">*</span></label>
                        <div class="sr-select-wrap">
                            <select class="sr-select @error('acad_session') is-invalid @enderror" name="acad_session" id="acad_session" required>
                                <option value="" disabled {{ old('acad_session') === null ? 'selected' : '' }}>Select admission year</option>
                                @for($year = (int) date('Y'); $year >= 2018; $year--)
                                    <option value="{{ $year }}" {{ old('acad_session') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        @error('acad_session') <span class="sr-error" role="alert">{{ $message }}</span> @enderror
                    </div>

                    <div class="sr-field">
                        <label class="sr-label" for="stdLevel"><i class="fas fa-layer-group" aria-hidden="true"></i> Academic Level <span class="sr-required">*</span></label>
                        <div class="sr-select-wrap">
                            <select class="sr-select @error('stdLevel') is-invalid @enderror" name="stdLevel" id="stdLevel" required>
                                <option value="" disabled {{ old('stdLevel') === null ? 'selected' : '' }}>Select academic level</option>
                                @foreach($allLevel as $d)
                                    <option value="{{ $d->level }}" {{ old('stdLevel') == $d->level ? 'selected' : '' }}>{{ $d->level }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('stdLevel') <span class="sr-error" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="sr-actions">
                <div class="sr-note"><i class="fas fa-info-circle" aria-hidden="true"></i> All three fields are required to preview the result summary.</div>
                <button type="submit" class="sr-submit"><i class="fas fa-eye" aria-hidden="true"></i> Preview Result <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>

    <div class="sr-help">
        <i class="fas fa-lightbulb" aria-hidden="true"></i>
        <div><strong>Before you continue</strong><p>Check the selected programme, admission year and level carefully before generating the result summary.</p></div>
    </div>
</div>
@endsection
