@extends('layouts.other-pages')

@section('pageTitle', 'Add HOD')
@section('heading', 'Add Head of Department')
@section('subtitle', 'Register a Head of Department and upload their official signature.')

@section('content')
<style>
    .hod-create-page { --hod-green:#23643A; --hod-deep:#174A2A; --hod-burgundy:#641510; --hod-gold:#D5AA43; --hod-ink:#1c3025; --hod-muted:#68756e; --hod-line:#e7ede8; color:var(--hod-ink); }
    .hod-create-page * { box-sizing:border-box; }
    .hod-create-page .hc-top { display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; margin-bottom:22px; }
    .hod-create-page .hc-eyebrow { display:inline-flex; align-items:center; gap:8px; color:var(--hod-green); font-size:12px; font-weight:800; letter-spacing:.09em; text-transform:uppercase; margin-bottom:8px; }
    .hod-create-page .hc-title { font-size:clamp(24px,3vw,32px); font-weight:800; letter-spacing:-.025em; line-height:1.15; margin:0 0 7px; color:var(--hod-deep); }
    .hod-create-page .hc-subtitle { color:var(--hod-muted); font-size:14px; margin:0; line-height:1.6; }
    .hod-create-page .hc-back { display:inline-flex; align-items:center; gap:8px; border:1px solid #dfe6e0; border-radius:11px; background:#fff; color:var(--hod-deep); font-size:13px; font-weight:700; padding:11px 15px; text-decoration:none; transition:.2s ease; }
    .hod-create-page .hc-back:hover { color:var(--hod-green); border-color:var(--hod-green); text-decoration:none; }
    .hod-create-page .hc-shell { max-width:980px; margin:0 auto; }
    .hod-create-page .hc-card { border:1px solid var(--hod-line); background:#fff; border-radius:19px; box-shadow:0 14px 35px rgba(20,58,34,.055); overflow:hidden; }
    .hod-create-page .hc-card-head { background:linear-gradient(110deg,#f3f8f4,#fff 70%); border-bottom:1px solid var(--hod-line); display:flex; align-items:center; gap:13px; padding:23px 28px; }
    .hod-create-page .hc-card-icon { flex:none; width:46px; height:46px; display:grid; place-items:center; background:#e2efe5; color:var(--hod-green); border-radius:13px; font-size:19px; }
    .hod-create-page .hc-card-head h2 { margin:0 0 4px; font-size:17px; color:var(--hod-deep); font-weight:800; }
    .hod-create-page .hc-card-head p { margin:0; color:var(--hod-muted); font-size:13px; }
    .hod-create-page .hc-form { padding:28px; }
    .hod-create-page .hc-section { display:flex; align-items:center; gap:10px; margin-bottom:19px; }
    .hod-create-page .hc-section-icon { width:32px; height:32px; flex:none; display:grid; place-items:center; border-radius:9px; color:var(--hod-burgundy); background:#fbefee; }
    .hod-create-page .hc-section h3 { margin:0; font-size:15px; font-weight:800; color:var(--hod-ink); }
    .hod-create-page .hc-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:20px; }
    .hod-create-page .hc-field { min-width:0; }
    .hod-create-page .hc-full { grid-column:1/-1; }
    .hod-create-page .hc-label { display:block; color:var(--hod-ink); font-size:13px; font-weight:750; margin-bottom:9px; }
    .hod-create-page .hc-required { color:var(--hod-burgundy); }
    .hod-create-page .hc-control { display:block; width:100%; min-height:48px; padding:11px 14px; background:#fff; border:1px solid #dce5de; border-radius:11px; color:var(--hod-ink); font-size:14px; transition:border-color .15s ease,box-shadow .15s ease; }
    .hod-create-page .hc-control:focus { outline:0; border-color:var(--hod-green); box-shadow:0 0 0 3px rgba(35,100,58,.12); }
    .hod-create-page .hc-control.is-invalid { border-color:#b83d35; }
    .hod-create-page .hc-help { margin:8px 0 0; color:var(--hod-muted); font-size:12px; line-height:1.55; }
    .hod-create-page .hc-error { color:#b4322c; font-size:12px; display:block; margin-top:7px; }
    .hod-create-page .hc-divider { height:1px; background:var(--hod-line); margin:28px 0; }
    .hod-create-page .hc-upload { display:flex; align-items:center; gap:18px; padding:18px; border:1px dashed #bed5c5; background:#f8fbf8; border-radius:13px; }
    .hod-create-page .hc-preview { width:128px; height:84px; flex:none; background:#fff; border:1px solid #e4e9e5; border-radius:9px; display:flex; align-items:center; justify-content:center; overflow:hidden; color:#98aaa0; font-size:12px; text-align:center; padding:8px; }
    .hod-create-page .hc-preview img { width:100%; height:100%; object-fit:contain; display:none; }
    .hod-create-page .hc-preview.has-image img { display:block; }
    .hod-create-page .hc-preview.has-image span { display:none; }
    .hod-create-page .hc-upload-main { flex:1; min-width:0; }
    .hod-create-page .hc-upload .hc-control { height:auto; min-height:0; background:#fff; padding:9px; }
    .hod-create-page .hc-actions { display:flex; gap:11px; justify-content:flex-end; flex-wrap:wrap; margin-top:30px; padding-top:22px; border-top:1px solid var(--hod-line); }
    .hod-create-page .hc-button { border:0; padding:12px 19px; border-radius:11px; font-size:14px; font-weight:800; display:inline-flex; align-items:center; justify-content:center; gap:9px; text-decoration:none; cursor:pointer; transition:.2s ease; }
    .hod-create-page .hc-button-primary { color:#fff; background:var(--hod-green); box-shadow:0 5px 15px rgba(35,100,58,.15); }
    .hod-create-page .hc-button-primary:hover { background:var(--hod-deep); color:#fff; }
    .hod-create-page .hc-button-light { color:var(--hod-ink); background:#f1f5f2; }
    .hod-create-page .hc-button-light:hover { color:var(--hod-green); background:#e6eee8; }
    .hod-create-page .hc-alert { padding:14px 17px; border-radius:12px; margin-bottom:19px; border:1px solid; font-size:13px; }
    .hod-create-page .hc-alert-success { color:#14562d; background:#edf9f0; border-color:#c7e5ce; }
    .hod-create-page .hc-alert-error { color:#85241f; background:#fff0ed; border-color:#f3c9c5; }
    .hod-create-page .hc-alert ul { margin:7px 0 0 18px; padding:0; }
    @media(max-width:650px) { .hod-create-page .hc-grid { grid-template-columns:1fr; } .hod-create-page .hc-card-head,.hod-create-page .hc-form { padding:19px; } .hod-create-page .hc-upload { align-items:stretch; flex-direction:column; } .hod-create-page .hc-preview { width:100%; height:110px; } .hod-create-page .hc-actions .hc-button { flex:1; } }
</style>

<div class="hod-create-page">
    <div class="hc-shell">
        <div class="hc-top">
            <div>
                <div class="hc-eyebrow"><i class="fas fa-user-tie" aria-hidden="true"></i> HOD Management</div>
                <h1 class="hc-title">Add Head of Department</h1>
                <p class="hc-subtitle">Enter the HOD's details and upload their official signature.</p>
            </div>
            <a class="hc-back" href="{{ route('hod-setup') }}"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back to HOD List</a>
        </div>

        @if(session('success'))
            <div class="hc-alert hc-alert-success" role="status"><i class="fas fa-check-circle" aria-hidden="true"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="hc-alert hc-alert-error" role="alert"><i class="fas fa-exclamation-circle" aria-hidden="true"></i> {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="hc-alert hc-alert-error" role="alert">
                <strong>Please review the highlighted fields.</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="hc-card">
            <div class="hc-card-head">
                <div class="hc-card-icon"><i class="fas fa-user-plus" aria-hidden="true"></i></div>
                <div>
                    <h2>HOD Registration</h2>
                    <p>Fields marked * are required.</p>
                </div>
            </div>

            <form class="hc-form" action="{{ route('hod-add.action') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="hc-section">
                    <span class="hc-section-icon"><i class="fas fa-building" aria-hidden="true"></i></span>
                    <h3>Department &amp; Programme</h3>
                </div>
                <div class="hc-grid">
                    <div class="hc-field">
                        <label class="hc-label" for="hcDepartment">Department <span class="hc-required">*</span></label>
                        <select id="hcDepartment" name="department" required class="hc-control @error('department') is-invalid @enderror">
                            <option value="">Select department</option>
                            @foreach($allDepartment as $department)
                                <option value="{{ $department->dept_name }}" {{ old('department') == $department->dept_name ? 'selected' : '' }}>{{ $department->dept_name }}</option>
                            @endforeach
                        </select>
                        @error('department') <span class="hc-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="hc-field">
                        <label class="hc-label" for="hcProgramme">Programme <span class="hc-required">*</span></label>
                        <select id="hcProgramme" name="programme" required class="hc-control @error('programme') is-invalid @enderror">
                            <option value="">Select programme</option>
                            {{-- Retain the original backend value mapping: $course->department. --}}
                            @foreach($allCourse as $course)
                                <option value="{{ $course->department }}" {{ old('programme') == $course->department ? 'selected' : '' }}>{{ $course->department }}</option>
                            @endforeach
                        </select>
                        @error('programme') <span class="hc-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="hc-divider"></div>
                <div class="hc-section">
                    <span class="hc-section-icon"><i class="fas fa-id-card" aria-hidden="true"></i></span>
                    <h3>HOD Information</h3>
                </div>
                <div class="hc-grid">
                    <div class="hc-field hc-full">
                        <label class="hc-label" for="hcFullName">Full Name <span class="hc-required">*</span></label>
                        <input id="hcFullName" type="text" name="fullName" value="{{ old('fullName') }}" required maxlength="255" autocomplete="name" placeholder="Enter full name" class="hc-control @error('fullName') is-invalid @enderror">
                        @error('fullName') <span class="hc-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="hc-field hc-full">
                        <label class="hc-label" for="hcSignature">Official Signature <span class="hc-required">*</span></label>
                        <div class="hc-upload">
                            <div class="hc-preview" id="hcSignaturePreview" aria-label="Signature preview">
                                <span><i class="fas fa-signature fa-lg" aria-hidden="true"></i><br>Signature preview</span>
                                <img id="hcSignatureImage" alt="Selected signature preview">
                            </div>
                            <div class="hc-upload-main">
                                <input id="hcSignature" name="signature" type="file" accept="image/*" required class="hc-control @error('signature') is-invalid @enderror">
                                <p class="hc-help">Select the image file containing the HOD's signature. The preview is only displayed locally until you submit the form.</p>
                                @error('signature') <span class="hc-error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hc-actions">
                    <a class="hc-button hc-button-light" href="{{ route('hod-setup') }}">Cancel</a>
                    <button type="submit" class="hc-button hc-button-primary"><i class="fas fa-save" aria-hidden="true"></i> Save HOD</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
(function () {
    'use strict';
    var input = document.getElementById('hcSignature');
    var preview = document.getElementById('hcSignaturePreview');
    var image = document.getElementById('hcSignatureImage');
    if (!input || !preview || !image) return;
    var currentUrl = null;
    input.addEventListener('change', function () {
        if (currentUrl) { URL.revokeObjectURL(currentUrl); currentUrl = null; }
        preview.classList.remove('has-image');
        image.removeAttribute('src');
        var file = input.files && input.files[0];
        if (file && file.type.indexOf('image/') === 0) {
            currentUrl = URL.createObjectURL(file);
            image.src = currentUrl;
            preview.classList.add('has-image');
        }
    });
    window.addEventListener('pagehide', function () { if (currentUrl) URL.revokeObjectURL(currentUrl); });
})();
</script>
@endsection
