@extends('layouts.other-pages')

@section('pageTitle', 'Edit Course | OYSCOHEST Result Portal')

@section('content')
<style>
    .oys-course-edit { --ce-green:#23643A; --ce-deep:#174A2A; --ce-burgundy:#641510; --ce-gold:#D5AA43; --ce-border:#e2eae4; --ce-muted:#667669; max-width:1120px; margin:0 auto; padding:0 0 42px; color:#293b2e; }
    .oys-course-edit, .oys-course-edit * { box-sizing:border-box; }
    .oys-course-edit .ce-top { display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:16px; margin-bottom:25px; }
    .oys-course-edit .ce-kicker { color:var(--ce-green); text-transform:uppercase; letter-spacing:1.2px; font-size:11px; font-weight:800; margin-bottom:8px; }
    .oys-course-edit .ce-kicker:before { content:''; display:inline-block; width:17px; height:3px; background:var(--ce-gold); border-radius:3px; vertical-align:middle; margin-right:9px; }
    .oys-course-edit h1 { margin:0 0 7px; font-size:clamp(24px, 3vw, 31px); font-weight:750; line-height:1.25; color:#233a2a; }
    .oys-course-edit .ce-subtitle { margin:0; color:var(--ce-muted); font-size:13px; line-height:1.7; }
    .oys-course-edit .ce-back { display:inline-flex; align-items:center; gap:9px; padding:11px 16px; border:1px solid #dce7df; background:#fff; color:var(--ce-deep); text-decoration:none; border-radius:10px; font-size:12px; font-weight:750; }
    .oys-course-edit .ce-back:hover { background:#f2f8f3; color:var(--ce-deep); text-decoration:none; }
    .oys-course-edit .ce-panel { background:white; border:1px solid var(--ce-border); border-radius:17px; overflow:hidden; box-shadow:0 9px 32px rgba(22,71,36,.055); }
    .oys-course-edit .ce-panel-head { background:linear-gradient(110deg,#fff 30%,#f4faf5); border-bottom:1px solid #e5ede7; padding:22px 26px; display:flex; align-items:center; gap:14px; }
    .oys-course-edit .ce-head-icon { width:47px; height:47px; border-radius:12px; display:flex; align-items:center; justify-content:center; background:#e8f4eb; color:var(--ce-green); font-size:19px; flex:none; }
    .oys-course-edit .ce-panel-head h2 { font-size:17px; margin:0 0 5px; font-weight:750; color:#273b2e; }
    .oys-course-edit .ce-panel-head p { font-size:12px; color:var(--ce-muted); margin:0; line-height:1.6; }
    .oys-course-edit .ce-body { padding:27px 26px 30px; }
    .oys-course-edit .ce-group-title { margin:0 0 19px; font-size:12px; text-transform:uppercase; letter-spacing:.65px; font-weight:800; color:var(--ce-green); }
    .oys-course-edit .ce-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:21px 23px; }
    .oys-course-edit .ce-field { min-width:0; }
    .oys-course-edit .ce-field.ce-span { grid-column:1/-1; }
    .oys-course-edit .ce-field label { display:block; font-size:12px; font-weight:750; color:#304536; margin-bottom:9px; }
    .oys-course-edit .ce-field label i { color:var(--ce-green); margin-right:6px; }
    .oys-course-edit .ce-field .ce-input { display:block; width:100%; height:48px; padding:11px 14px; border-radius:10px; border:1px solid #dce6de; background:#fcfdfc; color:#243d2a; font-size:13px; outline:0; box-shadow:none; transition:border-color .2s,box-shadow .2s; }
    .oys-course-edit .ce-field .ce-input:focus { border-color:var(--ce-green); background:#fff; box-shadow:0 0 0 4px rgba(35,100,58,.1); }
    .oys-course-edit .ce-field .ce-input.is-invalid { border-color:#c94d4d; }
    .oys-course-edit .ce-field .ce-select-wrap { position:relative; }
    .oys-course-edit .ce-field select.ce-input { appearance:none; -webkit-appearance:none; padding-right:40px; }
    .oys-course-edit .ce-field .ce-select-wrap:after { content:''; position:absolute; right:17px; top:45%; height:8px; width:8px; border-right:2px solid var(--ce-green); border-bottom:2px solid var(--ce-green); transform:rotate(45deg); pointer-events:none; }
    .oys-course-edit .ce-note { font-size:11px; line-height:1.5; color:var(--ce-muted); margin:7px 0 0; }
    .oys-course-edit .ce-error { display:block; font-size:12px; color:#b22c30; margin-top:7px; }
    .oys-course-edit .ce-divider { border:0; height:1px; background:#e7eee9; margin:25px 0; }
    .oys-course-edit .ce-alert { font-size:13px; line-height:1.6; border-radius:10px; padding:12px 15px; margin-bottom:18px; }
    .oys-course-edit .ce-alert-success { color:#174a2a; border:1px solid #cde7d2; background:#eaf7ed; }
    .oys-course-edit .ce-alert-error { color:#7f241e; border:1px solid #edc9c5; background:#fff2f0; }
    .oys-course-edit .ce-actions { background:#fbfdfb; border-top:1px solid #e8efea; padding:20px 26px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:14px; }
    .oys-course-edit .ce-hint { color:var(--ce-muted); font-size:12px; line-height:1.6; }
    .oys-course-edit .ce-hint i { color:var(--ce-green); margin-right:6px; }
    .oys-course-edit .ce-primary { display:inline-flex; align-items:center; justify-content:center; gap:9px; min-height:45px; padding:11px 21px; background:var(--ce-green); border:0; border-radius:10px; color:#fff; font-size:13px; font-weight:750; cursor:pointer; }
    .oys-course-edit .ce-primary:hover { background:var(--ce-deep); color:#fff; }
    @media(max-width:700px) { .oys-course-edit .ce-grid { grid-template-columns:1fr; gap:19px; } .oys-course-edit .ce-field.ce-span { grid-column:auto; } .oys-course-edit .ce-panel-head,.oys-course-edit .ce-body,.oys-course-edit .ce-actions { padding:20px; } .oys-course-edit .ce-actions { align-items:stretch; flex-direction:column; } .oys-course-edit .ce-primary { width:100%; } }
</style>

<div class="oys-course-edit">
    <div class="ce-top">
        <div>
            <div class="ce-kicker">Course Management</div>
            <h1>Edit Course</h1>
            <p class="ce-subtitle">Update the course details and save your changes to the academic curriculum.</p>
        </div>
        <a class="ce-back" href="{{ route('course-setup') }}"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back to Courses</a>
    </div>

    @if(session('success'))
        <div class="ce-alert ce-alert-success" role="status">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="ce-alert ce-alert-error" role="alert">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="ce-alert ce-alert-error" role="alert">Please review the highlighted fields and try again.</div>
    @endif

    <div class="ce-panel">
        <div class="ce-panel-head">
            <div class="ce-head-icon"><i class="fas fa-book-open" aria-hidden="true"></i></div>
            <div>
                <h2>Course Information</h2>
                <p>Editing {{ $course->course_code ?: 'selected course' }}</p>
            </div>
        </div>
        <form action="{{ route('course-edit.action', ['id' => $course->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="ce-body">
                <h3 class="ce-group-title">Programme &amp; Placement</h3>
                <div class="ce-grid">
                    <div class="ce-field ce-span">
                        <label for="ce-programme"><i class="fas fa-graduation-cap" aria-hidden="true"></i> Programme</label>
                        <div class="ce-select-wrap">
                            <select class="ce-input @error('programme') is-invalid @enderror" name="programme" id="ce-programme" required>
                                <option value="{{ $course->course }}" selected>{{ $course->course }}</option>
                            </select>
                        </div>
                        <p class="ce-note">Programme is fixed for this course in the current workflow.</p>
                        @error('programme')<span class="ce-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="ce-field">
                        <label for="ce-level"><i class="fas fa-layer-group" aria-hidden="true"></i> Academic Level</label>
                        <div class="ce-select-wrap">
                            <select class="ce-input @error('stdLevel') is-invalid @enderror" name="stdLevel" id="ce-level" required>
                                <option value="{{ $course->level }}" selected>{{ $course->level }}</option>
                            </select>
                        </div>
                        @error('stdLevel')<span class="ce-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="ce-field">
                        <label for="ce-semester"><i class="fas fa-calendar-alt" aria-hidden="true"></i> Semester</label>
                        <div class="ce-select-wrap">
                            <select class="ce-input @error('semester') is-invalid @enderror" name="semester" id="ce-semester" required>
                                <option value="{{ $course->semester }}" selected>{{ $course->semester }}</option>
                            </select>
                        </div>
                        @error('semester')<span class="ce-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="ce-field ce-span">
                        <label for="ce-session"><i class="fas fa-calendar-check" aria-hidden="true"></i> Academic Session</label>
                        <div class="ce-select-wrap">
                            <select class="ce-input @error('acadSession') is-invalid @enderror" name="acadSession" id="ce-session" required>
                                @php
                                    $selectedSession = old('acadSession', $course->session1);
                                    $sessionOptions = [];
                                    if (filled($selectedSession)) $sessionOptions[] = $selectedSession;
                                    for ($year = 2018; $year <= (int) date('Y'); $year++) {
                                        $sessionOptions[] = $year . '/' . ($year + 1);
                                    }
                                    $sessionOptions = array_unique($sessionOptions);
                                @endphp
                                @foreach($sessionOptions as $sessionOption)
                                    <option value="{{ $sessionOption }}" {{ (string) $selectedSession === (string) $sessionOption ? 'selected' : '' }}>{{ $sessionOption }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('acadSession')<span class="ce-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                </div>

                <hr class="ce-divider">
                <h3 class="ce-group-title">Course Details</h3>
                <div class="ce-grid">
                    <div class="ce-field ce-span">
                        <label for="ce-title"><i class="fas fa-book" aria-hidden="true"></i> Course Title</label>
                        <input class="ce-input @error('courseTitle') is-invalid @enderror" type="text" name="courseTitle" id="ce-title" value="{{ old('courseTitle', $course->course_title) }}" required>
                        @error('courseTitle')<span class="ce-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="ce-field">
                        <label for="ce-code"><i class="fas fa-hashtag" aria-hidden="true"></i> Course Code</label>
                        <input class="ce-input @error('courseCode') is-invalid @enderror" type="text" name="courseCode" id="ce-code" value="{{ old('courseCode', $course->course_code) }}" required>
                        @error('courseCode')<span class="ce-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="ce-field">
                        <label for="ce-unit"><i class="fas fa-list-ol" aria-hidden="true"></i> Course Unit</label>
                        <input class="ce-input @error('courseUnit') is-invalid @enderror" type="number" min="0" step="1" name="courseUnit" id="ce-unit" value="{{ old('courseUnit', $course->course_unit) }}" required>
                        @error('courseUnit')<span class="ce-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="ce-actions">
                <span class="ce-hint"><i class="fas fa-info-circle" aria-hidden="true"></i> Review the information before saving.</span>
                <button type="submit" class="ce-primary"><i class="fas fa-save" aria-hidden="true"></i> Update Course</button>
            </div>
        </form>
    </div>
</div>
@endsection
