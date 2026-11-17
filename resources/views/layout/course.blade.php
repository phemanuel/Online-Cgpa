@extends('layouts.other-pages')

@section('pageTitle', 'Course Curriculum | OYSCOHEST Result Portal')
@section('heading', 'Course Curriculum')
@section('subtitle', 'Select a programme, level and semester to view its curriculum.')

@section('content')
<style>
    .oys-curriculum { --cc-green:#23643A; --cc-dark:#174A2A; --cc-burgundy:#641510; --cc-gold:#D5AA43; --cc-muted:#657467; --cc-border:#e0e9e2; width:100%; max-width:1120px; margin:0 auto; padding:0 0 48px; color:#263c2b; }
    .oys-curriculum, .oys-curriculum * { box-sizing:border-box; }
    .oys-curriculum .cc-eyebrow { display:flex; align-items:center; gap:9px; margin-bottom:8px; font-size:11px; font-weight:800; letter-spacing:1.2px; text-transform:uppercase; color:var(--cc-green); }
    .oys-curriculum .cc-eyebrow:before { content:''; width:17px; height:3px; border-radius:5px; background:var(--cc-gold); }
    .oys-curriculum .cc-title { margin:0 0 7px; font-size:clamp(23px,3vw,31px); font-weight:800; color:#233a2b; line-height:1.25; }
    .oys-curriculum .cc-subtitle { margin:0 0 26px; font-size:13px; line-height:1.8; color:var(--cc-muted); }
    .oys-curriculum .cc-card { border:1px solid var(--cc-border); border-radius:16px; background:#fff; overflow:hidden; box-shadow:0 9px 28px rgba(25,70,40,.05); }
    .oys-curriculum .cc-card-header { display:flex; align-items:center; gap:14px; padding:23px 27px; border-bottom:1px solid #e8eee9; background:linear-gradient(105deg,#fff 40%,#f4faf6); }
    .oys-curriculum .cc-card-icon { height:47px; width:47px; flex:none; display:flex; align-items:center; justify-content:center; border-radius:12px; background:#eaf5ed; color:var(--cc-green); font-size:20px; }
    .oys-curriculum .cc-card-header h2 { margin:0 0 5px; font-size:17px; font-weight:800; color:#263d2d; }
    .oys-curriculum .cc-card-header p { margin:0; font-size:12px; line-height:1.6; color:var(--cc-muted); }
    .oys-curriculum .cc-body { padding:27px; }
    .oys-curriculum .cc-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:22px; }
    .oys-curriculum .cc-field { min-width:0; }
    .oys-curriculum .cc-field--wide { grid-column:1/-1; }
    .oys-curriculum .cc-label { display:block; margin:0 0 9px; font-size:12px; font-weight:750; color:#334b39; }
    .oys-curriculum .cc-required { color:var(--cc-burgundy); }
    .oys-curriculum .cc-input, .oys-curriculum .cc-select { display:block; width:100%; min-height:49px; padding:11px 13px; font-size:13px; font-family:inherit; color:#2b4031; border:1px solid #d9e5dc; border-radius:10px; background:#fcfdfc; box-shadow:none; }
    .oys-curriculum .cc-input:focus, .oys-curriculum .cc-select:focus { outline:none; border-color:var(--cc-green); box-shadow:0 0 0 3px rgba(35,100,58,.11); background:#fff; }
    .oys-curriculum .cc-invalid { border-color:#b73535; }
    .oys-curriculum .cc-error { display:block; color:#a52731; font-size:12px; margin-top:7px; }
    .oys-curriculum .cc-inline-action { display:inline-flex; align-items:center; gap:7px; border:0; background:transparent; padding:10px 0 0; color:var(--cc-green); font-size:12px; font-weight:750; cursor:pointer; }
    .oys-curriculum .cc-inline-action:hover { text-decoration:underline; color:var(--cc-dark); }
    .oys-curriculum .cc-footer { padding:19px 27px; border-top:1px solid #e8eee9; background:#fbfdfb; display:flex; align-items:center; justify-content:space-between; gap:15px; flex-wrap:wrap; }
    .oys-curriculum .cc-note { color:var(--cc-muted); font-size:12px; }
    .oys-curriculum .cc-note i { color:var(--cc-green); margin-right:6px; }
    .oys-curriculum .cc-button { display:inline-flex; align-items:center; justify-content:center; gap:10px; min-height:45px; padding:11px 20px; border:0; border-radius:10px; background:var(--cc-green); color:#fff; font-size:12px; font-weight:750; cursor:pointer; text-decoration:none; }
    .oys-curriculum .cc-button:hover { background:var(--cc-dark); color:#fff; }
    .oys-curriculum .cc-button--light { background:#f1f5f2; color:#344d3b; border:1px solid #d9e5dc; }
    .oys-curriculum .cc-button--light:hover { color:#263c2b; background:#e7eeea; }
    .oys-curriculum .cc-alert { border-radius:10px; padding:13px 15px; margin-bottom:18px; font-size:13px; line-height:1.5; }
    .oys-curriculum .cc-alert--success { background:#e8f6ed; color:#174a2a; border:1px solid #c7e8d0; }
    .oys-curriculum .cc-alert--error { background:#fff0ee; color:#8d241d; border:1px solid #efcbc8; }
    .oys-curriculum .cc-help { display:flex; align-items:flex-start; gap:12px; margin-top:19px; padding:16px 18px; border:1px solid #dcecdf; border-radius:11px; background:#f6faf7; color:#637366; font-size:12px; line-height:1.7; }
    .oys-curriculum .cc-help i { color:var(--cc-green); font-size:17px; margin-top:2px; }
    .oys-curriculum .cc-dialog { width:min(510px,calc(100vw - 24px)); max-height:calc(100vh - 36px); padding:0; border:1px solid var(--cc-border); border-radius:16px; box-shadow:0 25px 90px rgba(0,0,0,.25); color:#283b2d; overflow:auto; }
    .oys-curriculum .cc-dialog::backdrop { background:rgba(12,31,18,.62); }
    .oys-curriculum .cc-dialog-header { padding:21px 24px; display:flex; justify-content:space-between; align-items:flex-start; gap:15px; border-bottom:1px solid var(--cc-border); background:#f7fbf8; }
    .oys-curriculum .cc-dialog-header h2 { margin:0 0 5px; font-size:18px; font-weight:800; }
    .oys-curriculum .cc-dialog-header p { margin:0; font-size:12px; color:var(--cc-muted); }
    .oys-curriculum .cc-close { width:33px; height:33px; flex:none; display:grid; place-items:center; border:1px solid #dce7df; border-radius:8px; background:white; color:#3b4c40; cursor:pointer; }
    .oys-curriculum .cc-dialog-body { padding:23px 24px; display:grid; gap:17px; }
    .oys-curriculum .cc-dialog-footer { padding:17px 24px; display:flex; justify-content:flex-end; gap:11px; border-top:1px solid var(--cc-border); }
    @media(max-width:700px) { .oys-curriculum .cc-grid { grid-template-columns:1fr; gap:18px; } .oys-curriculum .cc-body { padding:21px; } .oys-curriculum .cc-card-header { padding:20px; } .oys-curriculum .cc-footer { padding:19px 21px; flex-direction:column; align-items:stretch; } .oys-curriculum .cc-footer .cc-button { width:100%; } }
</style>

<div class="oys-curriculum" id="courseCurriculumPage">
    <div class="cc-eyebrow">Academic Setup</div>
    <h1 class="cc-title">Course Curriculum</h1>
    <p class="cc-subtitle">Choose a programme, academic level and semester to view its courses, or register a new programme.</p>

    @if(session('success'))
        <div class="cc-alert cc-alert--success" role="status">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="cc-alert cc-alert--error" role="alert">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="cc-alert cc-alert--error" role="alert">Please review the fields below and correct any errors.</div>
    @endif

    <div class="cc-card">
        <div class="cc-card-header">
            <div class="cc-card-icon"><i class="fas fa-book-open" aria-hidden="true"></i></div>
            <div>
                <h2>Find Course Curriculum</h2>
                <p>Select the programme, level and semester to preview the course list.</p>
            </div>
        </div>

        {{-- Original course-list route is a GET request; do not change it to POST. --}}
        <form action="{{ route('course-list') }}" method="GET">
            <div class="cc-body">
                <div class="cc-grid">
                    <div class="cc-field cc-field--wide">
                        <label class="cc-label" for="programme">Programme <span class="cc-required">*</span></label>
                        <select name="programme" id="programme" class="cc-select @error('programme') cc-invalid @enderror" required>
                            <option value="">Select programme</option>
                            @foreach($programmes as $d)
                                <option value="{{ $d->department }}" {{ old('programme', request('programme')) == $d->department ? 'selected' : '' }}>{{ $d->department }}</option>
                            @endforeach
                        </select>
                        @error('programme') <span class="cc-error">{{ $message }}</span> @enderror
                        <button type="button" class="cc-inline-action" id="openCreateProgramme"><i class="fas fa-plus-circle" aria-hidden="true"></i> Create Programme</button>
                    </div>

                    <div class="cc-field">
                        <label class="cc-label" for="stdLevel">Academic Level <span class="cc-required">*</span></label>
                        <select name="stdLevel" id="stdLevel" class="cc-select @error('stdLevel') cc-invalid @enderror" required>
                            <option value="">Select academic level</option>
                            @foreach($allLevel as $d)
                                <option value="{{ $d->level }}" {{ old('stdLevel', request('stdLevel')) == $d->level ? 'selected' : '' }}>{{ $d->level }}</option>
                            @endforeach
                        </select>
                        @error('stdLevel') <span class="cc-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="cc-field">
                        <label class="cc-label" for="semester">Semester <span class="cc-required">*</span></label>
                        <select name="semester" id="semester" class="cc-select @error('semester') cc-invalid @enderror" required>
                            <option value="FIRST" {{ old('semester', request('semester', 'FIRST')) === 'FIRST' ? 'selected' : '' }}>FIRST</option>
                            <option value="SECOND" {{ old('semester', request('semester')) === 'SECOND' ? 'selected' : '' }}>SECOND</option>
                        </select>
                        @error('semester') <span class="cc-error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="cc-footer">
                <div class="cc-note"><i class="fas fa-info-circle" aria-hidden="true"></i>Select all three fields to preview the curriculum.</div>
                <button type="submit" class="cc-button"><i class="fas fa-eye" aria-hidden="true"></i> Preview Curriculum <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>

    <div class="cc-help"><i class="fas fa-lightbulb" aria-hidden="true"></i><div>To create a programme, use <strong>Create Programme</strong>. The new programme is saved using the existing programme registration endpoint.</div></div>

    <dialog class="cc-dialog" id="createProgrammeModal" aria-labelledby="createProgrammeLabel">
        <form method="POST" action="{{ route('programme.store') }}" id="createProgrammeForm">
            @csrf
            <div class="cc-dialog-header">
                <div><h2 id="createProgrammeLabel">Create Programme</h2><p>Enter the programme details to add it to the college's records.</p></div>
                <button type="button" class="cc-close" id="closeCreateProgramme" aria-label="Close"><i class="fas fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="cc-dialog-body">
                <div class="cc-field">
                    <label for="dept" class="cc-label">Department <span class="cc-required">*</span></label>
                    <select id="dept" name="dept" class="cc-select @error('dept') cc-invalid @enderror" required>
                        <option value="">Select department</option>
                        @foreach($department as $d)
                            <option value="{{ $d->dept_name }}" {{ old('dept') == $d->dept_name ? 'selected' : '' }}>{{ $d->dept_name }}</option>
                        @endforeach
                    </select>
                    @error('dept') <span class="cc-error">{{ $message }}</span> @enderror
                </div>
                <div class="cc-field">
                    <label class="cc-label" for="dept_name">Programme Name <span class="cc-required">*</span></label>
                    <input class="cc-input @error('dept_name') cc-invalid @enderror" id="dept_name" name="dept_name" type="text" value="{{ old('dept_name') }}" required>
                    @error('dept_name') <span class="cc-error">{{ $message }}</span> @enderror
                </div>
                <div class="cc-field">
                    <label class="cc-label" for="dept_duration">Programme Duration <span class="cc-required">*</span></label>
                    <input class="cc-input @error('dept_duration') cc-invalid @enderror" id="dept_duration" name="dept_duration" type="text" value="{{ old('dept_duration') }}" required>
                    @error('dept_duration') <span class="cc-error">{{ $message }}</span> @enderror
                </div>
                <div class="cc-field">
                    <label class="cc-label" for="dept_abbr">Abbreviation <span class="cc-required">*</span></label>
                    <input class="cc-input @error('dept_abbr') cc-invalid @enderror" id="dept_abbr" name="dept_abbr" type="text" value="{{ old('dept_abbr') }}" required>
                    @error('dept_abbr') <span class="cc-error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="cc-dialog-footer">
                <button type="button" class="cc-button cc-button--light" id="cancelCreateProgramme">Cancel</button>
                <button type="submit" class="cc-button"><i class="fas fa-save" aria-hidden="true"></i> Save Programme</button>
            </div>
        </form>
    </dialog>
</div>

<script>
(function () {
    'use strict';
    var root = document.getElementById('courseCurriculumPage');
    if (!root) return;
    var modal = root.querySelector('#createProgrammeModal');
    var open = root.querySelector('#openCreateProgramme');
    if (!modal || !open) return;
    function show() { if (!modal.open) modal.showModal(); }
    function close() { if (modal.open) modal.close(); }
    open.addEventListener('click', show);
    ['closeCreateProgramme', 'cancelCreateProgramme'].forEach(function (id) {
        var element = root.querySelector('#' + id);
        if (element) element.addEventListener('click', close);
    });
    modal.addEventListener('click', function (event) {
        if (event.target === modal) close();
    });
    @if($errors->has('dept') || $errors->has('dept_name') || $errors->has('dept_duration') || $errors->has('dept_abbr'))
        show();
    @endif
})();
</script>
@endsection
