@extends('layouts.other-pages')

@section('pageTitle', 'Edit HOD | OYSCOHEST E-Result')
@section('heading', 'Edit HOD')
@section('subtitle', 'Update Head of Department details and signature')

@section('content')
<style>
    .hod-edit-page { --he-green:#23643A; --he-deep:#174A2A; --he-burgundy:#641510; --he-gold:#D5AA43; --he-text:#172b22; --he-muted:#66756e; max-width:1120px; margin:0 auto; padding:8px 0 36px; color:var(--he-text); }
    .hod-edit-page * { box-sizing:border-box; }
    .hod-edit-page .he-topline { display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; margin-bottom:23px; }
    .hod-edit-page .he-eyebrow { color:var(--he-green); text-transform:uppercase; font-size:11px; font-weight:800; letter-spacing:.14em; margin-bottom:7px; }
    .hod-edit-page h1 { font-size:clamp(24px,3vw,33px); line-height:1.2; font-weight:800; margin:0 0 7px; color:var(--he-deep); }
    .hod-edit-page .he-description { font-size:14px; line-height:1.6; color:var(--he-muted); margin:0; }
    .hod-edit-page .he-back { display:inline-flex; gap:9px; align-items:center; justify-content:center; background:white; border:1px solid #dce8e0; color:var(--he-deep); border-radius:11px; padding:11px 16px; font-size:13px; font-weight:750; text-decoration:none; white-space:nowrap; transition:.2s; }
    .hod-edit-page .he-back:hover { color:var(--he-green); background:#f1f7f3; text-decoration:none; }
    .hod-edit-page .he-card { background:white; border:1px solid #e2ebe5; border-radius:19px; overflow:hidden; box-shadow:0 12px 36px rgba(20,66,38,.065); }
    .hod-edit-page .he-card-head { display:flex; align-items:center; gap:13px; padding:22px 26px; border-bottom:1px solid #e9eee9; background:linear-gradient(110deg,#f6faf7,#fff); }
    .hod-edit-page .he-icon { display:grid; place-items:center; flex-shrink:0; height:45px; width:45px; border-radius:13px; background:#e4f1e7; color:var(--he-green); font-size:20px; }
    .hod-edit-page .he-card-head h2 { margin:0 0 4px; font-size:17px; font-weight:800; color:var(--he-deep); }
    .hod-edit-page .he-card-head p { font-size:12px; color:var(--he-muted); margin:0; }
    .hod-edit-page .he-card-body { padding:27px 26px 16px; }
    .hod-edit-page .he-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:20px; }
    .hod-edit-page .he-field { min-width:0; }
    .hod-edit-page .he-field--full { grid-column:1/-1; }
    .hod-edit-page .he-label { display:block; color:#263b30; font-size:13px; font-weight:750; margin:0 0 9px; }
    .hod-edit-page .he-required { color:var(--he-burgundy); }
    .hod-edit-page .he-control { display:block; width:100%; height:46px; border:1px solid #d9e4dc; border-radius:10px; background:#fff; color:var(--he-text); padding:10px 13px; font-size:14px; outline:none; transition:border-color .15s,box-shadow .15s; }
    .hod-edit-page .he-control:focus { border-color:var(--he-green); box-shadow:0 0 0 3px rgba(35,100,58,.12); }
    .hod-edit-page .he-control[readonly] { background:#f5f8f5; color:#55695d; }
    .hod-edit-page .he-control[type=file] { height:auto; min-height:46px; padding:9px 12px; }
    .hod-edit-page .he-note { font-size:12px; line-height:1.5; color:var(--he-muted); margin:8px 0 0; }
    .hod-edit-page .he-invalid { border-color:#c34b48; }
    .hod-edit-page .he-error { display:block; margin-top:7px; font-size:12px; color:#a12d2a; font-weight:600; }
    .hod-edit-page .he-signature-area { display:flex; gap:20px; align-items:flex-start; flex-wrap:wrap; padding:18px; border-radius:13px; background:#f7faf8; border:1px dashed #ccdbd0; }
    .hod-edit-page .he-signature-preview { display:grid; place-items:center; width:235px; min-height:120px; max-width:100%; padding:12px; background:#fff; border:1px solid #e2e9e3; border-radius:10px; }
    .hod-edit-page .he-signature-preview img { max-height:100px; width:100%; object-fit:contain; }
    .hod-edit-page .he-signature-preview span { font-size:12px; color:var(--he-muted); text-align:center; }
    .hod-edit-page .he-signature-input { flex:1; min-width:210px; }
    .hod-edit-page .he-section-title { margin:0 0 15px; font-weight:800; font-size:14px; color:var(--he-deep); }
    .hod-edit-page .he-divider { height:1px; background:#edf1ed; margin:24px 0; }
    .hod-edit-page .he-actions { display:flex; align-items:center; justify-content:flex-end; flex-wrap:wrap; gap:12px; padding:20px 26px; background:#fbfcfb; border-top:1px solid #e9eee9; }
    .hod-edit-page .he-btn { display:inline-flex; justify-content:center; align-items:center; gap:9px; min-height:44px; padding:11px 22px; border-radius:10px; font-weight:750; font-size:13px; text-decoration:none; cursor:pointer; transition:.2s; }
    .hod-edit-page .he-btn-secondary { background:white; border:1px solid #d8e3da; color:var(--he-deep); }
    .hod-edit-page .he-btn-primary { background:var(--he-green); border:1px solid var(--he-green); color:white; }
    .hod-edit-page .he-btn-primary:hover { background:var(--he-deep); color:white; }
    .hod-edit-page .he-btn-secondary:hover { background:#f0f5f1; color:var(--he-green); text-decoration:none; }
    .hod-edit-page .he-alert { display:flex; align-items:flex-start; gap:10px; border-radius:11px; padding:14px 16px; font-size:13px; margin-bottom:20px; line-height:1.55; }
    .hod-edit-page .he-alert-success { color:#155a30; background:#ecf8ef; border:1px solid #c9e8d1; }
    .hod-edit-page .he-alert-error { color:#8c2727; background:#fff0ee; border:1px solid #f0c9c5; }
    @media(max-width:700px) { .hod-edit-page .he-grid { grid-template-columns:1fr; } .hod-edit-page .he-card-head,.hod-edit-page .he-card-body,.hod-edit-page .he-actions { padding-left:17px; padding-right:17px; } .hod-edit-page .he-actions .he-btn { flex:1; } .hod-edit-page .he-signature-input { min-width:100%; } }
</style>

<div class="hod-edit-page">
    <div class="he-topline">
        <div>
            <div class="he-eyebrow">Academic Administration / HOD Management</div>
            <h1>Edit Head of Department</h1>
            <p class="he-description">Update the HOD's name and signature while keeping their current department and programme.</p>
        </div>
        <a class="he-back" href="{{ route('hod-setup') }}"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back to HOD List</a>
    </div>

    @if(session('success'))
        <div class="he-alert he-alert-success" role="status"><i class="fas fa-check-circle" aria-hidden="true"></i> <span>{{ session('success') }}</span></div>
    @endif
    @if(session('error'))
        <div class="he-alert he-alert-error" role="alert"><i class="fas fa-exclamation-circle" aria-hidden="true"></i> <span>{{ session('error') }}</span></div>
    @endif
    @if($errors->any())
        <div class="he-alert he-alert-error" role="alert"><i class="fas fa-exclamation-triangle" aria-hidden="true"></i> <span>Please review the highlighted fields and try again.</span></div>
    @endif

    <div class="he-card">
        <div class="he-card-head">
            <div class="he-icon"><i class="fas fa-user-tie" aria-hidden="true"></i></div>
            <div><h2>HOD Information</h2><p>Make changes to the record below, then save your updates.</p></div>
        </div>

        <form method="POST" action="{{ route('hod-edit.action', ['id' => $hod->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="he-card-body">
                <h3 class="he-section-title">Department &amp; Programme</h3>
                <div class="he-grid">
                    <div class="he-field">
                        <label class="he-label" for="hod-department">Department <span class="he-required">*</span></label>
                        <select id="hod-department" name="department" class="he-control @error('department') he-invalid @enderror" required>
                            <option value="{{ $hod->dept }}" selected>{{ $hod->dept }}</option>
                        </select>
                        <p class="he-note">The current department is retained, as in the existing form.</p>
                        @error('department')<span class="he-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="he-field">
                        <label class="he-label" for="hod-programme">Programme <span class="he-required">*</span></label>
                        <select id="hod-programme" name="programme" class="he-control @error('programme') he-invalid @enderror" required>
                            <option value="{{ $hod->course }}" selected>{{ $hod->course }}</option>
                        </select>
                        <p class="he-note">The current programme is retained, as in the existing form.</p>
                        @error('programme')<span class="he-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="he-field he-field--full">
                        <label class="he-label" for="hod-fullname">Full Name <span class="he-required">*</span></label>
                        <input id="hod-fullname" name="fullName" type="text" class="he-control @error('fullName') he-invalid @enderror" value="{{ old('fullName', $hod->hod_name) }}" placeholder="Enter HOD's full name" autocomplete="name" required>
                        @error('fullName')<span class="he-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="he-divider"></div>
                <h3 class="he-section-title">Signature</h3>
                <div class="he-signature-area">
                    <div class="he-signature-preview" id="hod-signature-preview">
                        @if(!empty($hod->sign))
                            <img src="{{ asset('signature/' . $hod->sign) }}" alt="Current HOD signature" id="hod-signature-image">
                        @else
                            <span id="hod-signature-placeholder">No signature uploaded yet</span>
                        @endif
                    </div>
                    <div class="he-signature-input">
                        <label class="he-label" for="hod-signature">Replace Signature (optional)</label>
                        <input id="hod-signature" type="file" name="signature" class="he-control @error('signature') he-invalid @enderror" accept="image/*">
                        <p class="he-note">Leave this field empty to keep the current signature. Select a new image to preview it before saving.</p>
                        @error('signature')<span class="he-error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="he-actions">
                <a href="{{ route('hod-setup') }}" class="he-btn he-btn-secondary">Cancel</a>
                <button type="submit" class="he-btn he-btn-primary"><i class="fas fa-save" aria-hidden="true"></i> Update HOD</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('hod-signature');
    var preview = document.getElementById('hod-signature-preview');
    if (!input || !preview) return;
    input.addEventListener('change', function () {
        var file = input.files && input.files[0];
        if (!file || !file.type.startsWith('image/')) return;
        var reader = new FileReader();
        reader.onload = function (event) {
            preview.textContent = '';
            var img = document.createElement('img');
            img.alt = 'New HOD signature preview';
            img.src = event.target.result;
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endsection
