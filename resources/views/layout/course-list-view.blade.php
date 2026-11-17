@extends('layouts.other-pages')

@section('pageTitle', 'Course List | OYSCOHEST Result Portal')
@section('heading', 'Course Curriculum')
@section('subtitle', 'Manage courses, instructor assignments and score sheets.')

@push('styles')
<style>
.oys-courses{--oc-green:#23643A;--oc-dark:#174A2A;--oc-burgundy:#641510;--oc-gold:#D5AA43;--oc-line:#e1e9e3;--oc-muted:#68796d;color:#293b2f;max-width:1600px;margin:0 auto 36px;min-width:0}
.oys-courses *, .oys-courses *::before, .oys-courses *::after{box-sizing:border-box}
.oys-courses .oc-head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;margin:0 0 20px}
.oys-courses .oc-kicker{color:var(--oc-green);font-weight:800;letter-spacing:1.3px;font-size:11px;text-transform:uppercase;margin-bottom:7px}
.oys-courses .oc-kicker:before{content:"";display:inline-block;background:var(--oc-gold);width:16px;height:3px;vertical-align:middle;margin-right:8px;border-radius:3px}
.oys-courses h1{font-size:clamp(23px,2.7vw,29px);color:#263a2b;font-weight:800;margin:0 0 8px}
.oys-courses .oc-sub{font-size:13px;color:var(--oc-muted);margin:0;line-height:1.65}
.oys-courses .oc-actions{display:flex;gap:9px;flex-wrap:wrap;align-items:center}
.oys-courses .oc-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:41px;padding:10px 14px;border-radius:9px;font-size:12px;font-weight:750;cursor:pointer;text-decoration:none;border:1px solid transparent;line-height:1.35;transition:.15s}
.oys-courses .oc-btn:hover{text-decoration:none;filter:brightness(.95)}
.oys-courses .oc-btn-primary{color:#fff;background:var(--oc-green)}
.oys-courses .oc-btn-primary:hover{color:#fff;background:var(--oc-dark)}
.oys-courses .oc-btn-outline{border-color:#cddfd2;color:var(--oc-green);background:#fff}
.oys-courses .oc-btn-outline:hover{color:var(--oc-dark);background:#f4faf5}
.oys-courses .oc-btn-danger{border-color:#ead0d0;color:#9e2525;background:#fff}
.oys-courses .oc-btn-small{min-height:32px;padding:7px 10px;font-size:11px;border-radius:7px}
.oys-courses .oc-metric{display:flex;align-items:center;gap:15px;border:1px solid #dce9df;border-radius:13px;background:#f6faf7;padding:16px 19px;margin-bottom:18px}
.oys-courses .oc-metric-icon{display:grid;place-items:center;background:#e5f3e9;color:var(--oc-green);width:46px;height:46px;border-radius:11px;font-size:20px;flex:none}
.oys-courses .oc-metric b{display:block;font-size:23px;color:var(--oc-dark);line-height:1.15}
.oys-courses .oc-metric small{font-size:12px;color:var(--oc-muted)}
.oys-courses .oc-card{border:1px solid var(--oc-line);border-radius:15px;overflow:hidden;background:#fff;box-shadow:0 10px 28px rgba(22,65,33,.045)}
.oys-courses .oc-card-top{padding:18px 21px;display:flex;gap:15px;justify-content:space-between;align-items:center;flex-wrap:wrap;background:linear-gradient(110deg,#fff,#f7fbf8);border-bottom:1px solid var(--oc-line)}
.oys-courses .oc-card-top h2{font-size:16px;margin:0 0 5px;font-weight:800;color:#2b3f30}
.oys-courses .oc-card-top p{margin:0;color:var(--oc-muted);font-size:12px}
.oys-courses .oc-search{position:relative;width:min(100%,290px)}
.oys-courses .oc-search input{display:block;width:100%;height:42px;padding:9px 12px 9px 36px;border:1px solid #dbe6de;border-radius:9px;background:#fff;font-size:12px;outline:none}
.oys-courses .oc-search input:focus{border-color:var(--oc-green);box-shadow:0 0 0 3px #e0f0e5}
.oys-courses .oc-search i{position:absolute;top:14px;left:13px;color:#819487;font-size:12px}
.oys-courses .oc-table-scroll{width:100%;max-height:70vh;overflow:auto;overscroll-behavior:contain}
.oys-courses table.oc-table{border-collapse:separate;border-spacing:0;width:100%;min-width:890px;font-size:12px;margin:0}
.oys-courses .oc-table th{position:sticky;top:0;z-index:2;background:#eef5f0;color:#365442;font-size:11px;font-weight:800;letter-spacing:.2px;text-align:left;padding:14px 12px;border-bottom:1px solid #dce7df;white-space:nowrap}
.oys-courses .oc-table td{border-bottom:1px solid #ecf0ed;padding:12px;vertical-align:middle;color:#33483a}
.oys-courses .oc-table tbody tr:hover td{background:#fafdfa}
.oys-courses .oc-table td:nth-child(2){font-weight:700;min-width:200px}
.oys-courses .oc-table td:nth-child(3){white-space:nowrap}
.oys-courses .oc-table .oc-row-actions{display:flex;gap:6px;align-items:center;white-space:nowrap}
.oys-courses .oc-tag{font-size:11px;border-radius:100px;padding:6px 10px;display:inline-flex;gap:6px;align-items:center;max-width:240px;text-align:left}
.oys-courses button.oc-tag{cursor:pointer;border:0}
.oys-courses .oc-tag-assigned{background:#e7f6ea;color:#18552c}
.oys-courses .oc-tag-unassigned{background:#fff1f0;color:#9b2923}
.oys-courses .oc-table tfoot td{background:#f5faf6;font-weight:800;border-top:1px solid #dfe9e0;border-bottom:0}
.oys-courses .oc-notice{padding:13px 16px;border-radius:10px;margin-bottom:17px;font-size:12px}
.oys-courses .oc-success{background:#eaf8ed;border:1px solid #cfebd5;color:#19562b}
.oys-courses .oc-error{background:#fff0ed;border:1px solid #eed3d0;color:#91281e}
.oys-courses .oc-empty{padding:35px;text-align:center;color:var(--oc-muted)}
.oys-courses dialog.oc-modal{position:fixed;inset:0;margin:auto;max-width:min(94vw,670px);width:100%;max-height:min(92vh,860px);border:1px solid #d9e6db;border-radius:15px;box-shadow:0 18px 60px #12241b45;padding:0;color:#293c30;background:#fff;overflow:hidden}
.oys-courses dialog.oc-modal::backdrop{background:rgba(14,35,22,.56)}
.oys-courses .oc-modal-head,.oys-courses .oc-modal-foot{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:17px 22px;background:#f7fbf8}
.oys-courses .oc-modal-head{border-bottom:1px solid #e0e9e2}
.oys-courses .oc-modal-head h2{font-size:17px;font-weight:800;margin:0;color:var(--oc-dark)}
.oys-courses .oc-modal-foot{border-top:1px solid #e0e9e2}
.oys-courses .oc-modal-body{padding:23px;max-height:calc(92vh - 143px);overflow-y:auto}
.oys-courses .oc-close{border:0;background:#e8f0e9;color:#345b3b;width:33px;height:33px;border-radius:8px;cursor:pointer;font-size:17px}
.oys-courses .oc-fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:15px}
.oys-courses .oc-field{min-width:0}
.oys-courses .oc-field.wide{grid-column:1/-1}
.oys-courses .oc-field label{display:block;margin:0 0 6px;font-size:12px;font-weight:800}
.oys-courses .oc-field input,.oys-courses .oc-field select{display:block;width:100%;min-height:43px;border-radius:9px;border:1px solid #d9e4dc;padding:9px 11px;background:#fff;color:#293c30;font-size:13px}
.oys-courses .oc-field input:focus,.oys-courses .oc-field select:focus{outline:0;border-color:var(--oc-green);box-shadow:0 0 0 3px #e8f3eb}
.oys-courses .oc-field .oc-validation{display:block;margin-top:5px;color:#a52424;font-size:11px}
.oys-courses .oc-person{text-align:center;padding-bottom:13px}
.oys-courses .oc-avatar{width:84px;height:84px;border-radius:50%;object-fit:cover;border:3px solid #e3eee6}
.oys-courses .oc-info{width:100%;border-collapse:collapse}
.oys-courses .oc-info th,.oys-courses .oc-info td{font-size:12px;padding:11px 9px;text-align:left;border-bottom:1px solid #e8eeea;overflow-wrap:anywhere}
.oys-courses .oc-info th{width:30%;color:#607365}
@media(max-width:700px){.oys-courses .oc-card-top{padding:16px}.oys-courses .oc-actions{width:100%}.oys-courses .oc-search{width:100%}.oys-courses .oc-fields{grid-template-columns:1fr}.oys-courses .oc-modal-body{padding:16px}.oys-courses .oc-modal-head,.oys-courses .oc-modal-foot{padding:14px 16px}}
</style>
@endpush

@section('content')
<div class="oys-courses" id="oysCoursesPage">
    <div class="oc-head">
        <div>
            <div class="oc-kicker">Academic Management</div>
            <h1>Course Curriculum</h1>
            <p class="oc-sub">{{ $programme }} · {{ $studentLevel }} Level · {{ ucfirst(strtolower($semester)) }} Semester</p>
        </div>
        <div class="oc-actions">
            <a href="{{ route('course-setup') }}" class="oc-btn oc-btn-outline"><i class="fas fa-arrow-left"></i> Back to Curriculum</a>
            <button type="button" class="oc-btn oc-btn-outline" id="ocPrintAll"><i class="fas fa-print"></i> Print All</button>
            <button type="button" class="oc-btn oc-btn-outline" data-oc-open="ocPrintSheet"><i class="fas fa-file-pdf"></i> Print Imputation Sheet</button>
            <button type="button" class="oc-btn oc-btn-primary" data-oc-open="ocAddCourse"><i class="fas fa-plus-circle"></i> Add Course</button>
        </div>
    </div>

    @if(session('success'))<div class="oc-notice oc-success" role="status">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="oc-notice oc-error" role="alert">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="oc-notice oc-error" role="alert">Please correct the highlighted fields below. @if($errors->has('courseTitle') || $errors->has('courseCode') || $errors->has('courseUnit'))The Add Course form has been reopened.@endif</div>@endif

    @php
        $totalUnits = $courses->sum(fn ($c) => (float) $c->course_unit);
        $courseCount = $courses->count();
    @endphp
    <div class="oc-metric">
        <div class="oc-metric-icon"><i class="fas fa-book-open"></i></div>
        <div><b>{{ $courseCount }}</b><small>Courses · {{ $totalUnits + 0 }} total course units</small></div>
    </div>

    <div class="oc-card">
        <div class="oc-card-top">
            <div><h2>Course List</h2><p>Review course details, manage assignments and update records.</p></div>
            <div class="oc-search"><i class="fas fa-search"></i><input type="search" id="searchInput" placeholder="Search courses or instructors" aria-label="Search courses or instructors" autocomplete="off"></div>
        </div>
        <div class="oc-table-scroll" tabindex="0" aria-label="Scrollable course list">
            <table class="oc-table" id="courseListTable">
                <thead><tr><th>#</th><th>Course Title</th><th>Course Code</th><th>Course Unit</th><th>Assigned Status</th><th>Instructor Assignment</th><th>Action</th></tr></thead>
                <tbody>
                @forelse($courses as $c)
                    <tr class="oc-data-row">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c->course_title }}</td>
                        <td>{{ $c->course_code }}</td>
                        <td>{{ $c->course_unit }}</td>
                        <td>
                            @if($c->instructor)
                                <button type="button" class="oc-tag oc-tag-assigned" data-oc-instructor="{{ $c->instructor->instructor_id }}" title="View instructor details"><i class="fas fa-check-circle"></i> Assigned to: {{ $c->instructor->instructor_name }}</button>
                            @else
                                <span class="oc-tag oc-tag-unassigned"><i class="fas fa-exclamation-circle"></i> Not Assigned</span>
                            @endif
                        </td>
                        <td><a href="{{ route('course-assign', ['id' => $c->id]) }}" class="oc-btn oc-btn-small oc-btn-outline"><i class="fas {{ $c->instructor ? 'fa-exchange-alt' : 'fa-user-plus' }}"></i> {{ $c->instructor ? 'Re-assign' : 'Assign' }}</a></td>
                        <td><div class="oc-row-actions">
                            <a href="{{ route('course-edit', ['id' => $c->id]) }}" class="oc-btn oc-btn-small oc-btn-outline" aria-label="Edit {{ $c->course_code }}" title="Edit course"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('course-delete', ['id' => $c->id]) }}" class="oc-btn oc-btn-small oc-btn-danger" onclick="return confirm('Are you sure you want to delete this course?');" aria-label="Delete {{ $c->course_code }}" title="Delete course"><i class="fas fa-trash-alt"></i></a>
                        </div></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="oc-empty">No courses found for this selection.</td></tr>
                @endforelse
                </tbody>
                <tfoot><tr><td colspan="3" style="text-align:right">Total Course Units</td><td>{{ $totalUnits + 0 }}</td><td colspan="3"></td></tr></tfoot>
            </table>
        </div>
        <div id="ocNoMatches" class="oc-empty" hidden>No courses match your search.</div>
    </div>

    {{-- This printable table retains the original set of seven data columns. --}}
    <div id="allCoursesTable" hidden>
        <h3>{{ $programme }} {{ $studentLevel }} Level Course List for {{ $semester }} Semester</h3>
        <table>
            <thead><tr><th>#</th><th>Course Title</th><th>Course Code</th><th>Course Unit</th><th>Programme</th><th>Level</th><th>Assigned Status</th></tr></thead>
            <tbody>
            @forelse($courses as $c)
                <tr><td>{{ $loop->iteration }}</td><td>{{ $c->course_title }}</td><td>{{ $c->course_code }}</td><td>{{ $c->course_unit }}</td><td>{{ $c->course }}</td><td>{{ $c->level }}</td><td>{{ $c->instructor ? 'Assigned to: '.$c->instructor->instructor_name : 'Not Assigned' }}</td></tr>
            @empty
                <tr><td colspan="7">No courses found.</td></tr>
            @endforelse
            </tbody>
            <tfoot><tr><td colspan="3">Total Units</td><td>{{ $totalUnits + 0 }}</td><td colspan="3"></td></tr></tfoot>
        </table>
    </div>

    {{-- Native dialogs avoid conflicts between Bootstrap 4 and Bootstrap 5 modal APIs. --}}
    <dialog class="oc-modal" id="ocInstructorDetails" aria-labelledby="ocInstructorTitle">
        <div class="oc-modal-head"><h2 id="ocInstructorTitle">Instructor Details</h2><button type="button" class="oc-close" data-oc-close aria-label="Close">&times;</button></div>
        <div class="oc-modal-body" id="modal-body-content" aria-live="polite">Select an assigned instructor to view details.</div>
        <div class="oc-modal-foot"><span></span><button type="button" class="oc-btn oc-btn-outline" data-oc-close>Close</button></div>
    </dialog>

    <dialog class="oc-modal" id="ocAddCourse" aria-labelledby="ocAddCourseTitle">
        <form action="{{ route('course-add.action') }}" method="POST">
            @csrf
            <div class="oc-modal-head"><h2 id="ocAddCourseTitle">Add Course</h2><button type="button" class="oc-close" data-oc-close aria-label="Close">&times;</button></div>
            <div class="oc-modal-body"><div class="oc-fields">
                <div class="oc-field"><label for="ocProgramme">Programme</label><select name="programme" id="ocProgramme" required><option value="{{ $programme }}">{{ $programme }}</option></select>@error('programme')<span class="oc-validation">{{ $message }}</span>@enderror</div>
                <div class="oc-field"><label for="ocLevel">Academic Level</label><select name="stdLevel" id="ocLevel" required><option value="{{ $studentLevel }}">{{ $studentLevel }}</option></select>@error('stdLevel')<span class="oc-validation">{{ $message }}</span>@enderror</div>
                <div class="oc-field"><label for="ocSemester">Semester</label><select name="semester" id="ocSemester" required><option value="{{ $semester }}">{{ $semester }}</option></select>@error('semester')<span class="oc-validation">{{ $message }}</span>@enderror</div>
                <div class="oc-field"><label for="ocAcadSession">Academic Session</label><select name="acadSession" id="ocAcadSession" required>
                    @for($year=2018; $year <= (int) date('Y'); $year++)<option value="{{ $year }}/{{ $year + 1 }}" @selected(old('acadSession') === ($year . '/' . ($year + 1)))>{{ $year }}/{{ $year + 1 }}</option>@endfor
                </select>@error('acadSession')<span class="oc-validation">{{ $message }}</span>@enderror</div>
                <div class="oc-field wide"><label for="ocCourseTitle">Course Title</label><input id="ocCourseTitle" type="text" name="courseTitle" value="{{ old('courseTitle') }}" required>@error('courseTitle')<span class="oc-validation">{{ $message }}</span>@enderror</div>
                <div class="oc-field"><label for="ocCourseCode">Course Code</label><input id="ocCourseCode" type="text" name="courseCode" value="{{ old('courseCode') }}" required>@error('courseCode')<span class="oc-validation">{{ $message }}</span>@enderror</div>
                <div class="oc-field"><label for="ocCourseUnit">Course Unit</label><input id="ocCourseUnit" type="text" name="courseUnit" value="{{ old('courseUnit') }}" required>@error('courseUnit')<span class="oc-validation">{{ $message }}</span>@enderror</div>
            </div></div>
            <div class="oc-modal-foot"><button type="button" class="oc-btn oc-btn-outline" data-oc-close>Cancel</button><button type="submit" class="oc-btn oc-btn-primary"><i class="fas fa-save"></i> Submit Course</button></div>
        </form>
    </dialog>

    <dialog class="oc-modal" id="ocPrintSheet" aria-labelledby="ocPrintSheetTitle">
        <form action="{{ route('print-score-sheet') }}" method="GET" target="_blank">
            <input type="hidden" name="programme" value="{{ $programme }}">
            <input type="hidden" name="studentLevel" value="{{ $studentLevel }}">
            <input type="hidden" name="semester" value="{{ $semester }}">
            <div class="oc-modal-head"><h2 id="ocPrintSheetTitle">Generate Imputation Sheet</h2><button type="button" class="oc-close" data-oc-close aria-label="Close">&times;</button></div>
            <div class="oc-modal-body"><div class="oc-field"><label for="ocAdmissionYear">Admission Year</label><select name="admission_year" id="ocAdmissionYear" required><option value="">Select Admission Year</option>@for($year=2018; $year <= (int) date('Y'); $year++)<option value="{{ $year }}">{{ $year }}</option>@endfor</select></div></div>
            <div class="oc-modal-foot"><button type="button" class="oc-btn oc-btn-outline" data-oc-close>Cancel</button><button type="submit" class="oc-btn oc-btn-primary"><i class="fas fa-file-pdf"></i> Generate PDF</button></div>
        </form>
    </dialog>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    const page = document.getElementById('oysCoursesPage');
    if (!page) return;
    const dialogs = {
        ocAddCourse: page.querySelector('#ocAddCourse'),
        ocPrintSheet: page.querySelector('#ocPrintSheet'),
        ocInstructorDetails: page.querySelector('#ocInstructorDetails')
    };
    function openDialog(dialog) {
        if (!dialog) return;
        if (typeof dialog.showModal === 'function') dialog.showModal();
        else dialog.setAttribute('open', '');
    }
    page.querySelectorAll('[data-oc-open]').forEach(button => {
        button.addEventListener('click', () => openDialog(dialogs[button.dataset.ocOpen]));
    });
    page.querySelectorAll('[data-oc-close]').forEach(button => {
        button.addEventListener('click', () => {
            const dialog = button.closest('dialog');
            if (dialog) typeof dialog.close === 'function' ? dialog.close() : dialog.removeAttribute('open');
        });
    });
    page.querySelectorAll('dialog.oc-modal').forEach(dialog => {
        dialog.addEventListener('click', event => {
            if (event.target === dialog) dialog.close();
        });
    });

    const search = page.querySelector('#searchInput');
    const rows = Array.from(page.querySelectorAll('#courseListTable tbody tr.oc-data-row'));
    const noMatches = page.querySelector('#ocNoMatches');
    if (search) search.addEventListener('input', () => {
        const q = search.value.trim().toLowerCase();
        let visible = 0;
        rows.forEach(row => {
            const matched = row.textContent.toLowerCase().includes(q);
            row.hidden = !matched;
            if (matched) visible++;
        });
        noMatches.hidden = !rows.length || visible > 0;
    });

    page.querySelectorAll('[data-oc-instructor]').forEach(button => {
        button.addEventListener('click', async () => {
            const instructorId = button.dataset.ocInstructor;
            const content = page.querySelector('#modal-body-content');
            content.textContent = 'Loading instructor details…';
            openDialog(dialogs.ocInstructorDetails);
            try {
                const response = await fetch('/admin/instructor-details/' + encodeURIComponent(instructorId), {
                    headers: {'Accept': 'application/json'}, credentials: 'same-origin'
                });
                if (!response.ok) throw new Error('Unable to retrieve instructor details.');
                const data = await response.json();
                content.textContent = '';
                const avatarWrap = document.createElement('div');
                avatarWrap.className = 'oc-person';
                const avatar = document.createElement('img');
                avatar.className = 'oc-avatar';
                avatar.alt = 'Instructor photo';
                avatar.src = data.image ? @json(asset('profile_pictures')).replace(/\/$/, '') + '/' + encodeURIComponent(data.image) : @json(asset('uploads/blank.jpg'));
                avatar.onerror = () => { avatar.onerror = null; avatar.src = @json(asset('uploads/blank.jpg')); };
                avatarWrap.appendChild(avatar);
                content.appendChild(avatarWrap);
                const table = document.createElement('table');
                table.className = 'oc-info';
                [['Name', data.name], ['Email', data.email], ['Department', data.department]].forEach(([label, value]) => {
                    const row = table.insertRow();
                    const th = document.createElement('th');
                    th.scope = 'row';
                    th.textContent = label;
                    const td = document.createElement('td');
                    td.textContent = value ?? '—';
                    row.appendChild(th);
                    row.appendChild(td);
                });
                content.appendChild(table);
            } catch (error) {
                content.textContent = error.message || 'Error loading instructor details.';
            }
        });
    });

    page.querySelector('#ocPrintAll')?.addEventListener('click', () => {
        const source = page.querySelector('#allCoursesTable');
        if (!source) return;
        const frame = document.createElement('iframe');
        frame.style.cssText = 'position:fixed;left:-10000px;top:0;width:1px;height:1px;border:0';
        frame.title = 'Course List Print';
        document.body.appendChild(frame);
        const doc = frame.contentDocument;
        doc.open();
        doc.write('<!doctype html><html><head><title>Course List</title><style>@page{size:A4 landscape;margin:12mm}body{font:12px Arial,sans-serif;color:#111}h3{text-align:center}table{width:100%;border-collapse:collapse;margin-top:16px}th,td{border:1px solid #555;padding:7px;text-align:left}th{background:#edf4ee}tr{break-inside:avoid}</style></head><body>' + source.innerHTML + '</body></html>');
        doc.close();
        const runPrint = () => { frame.contentWindow.focus(); frame.contentWindow.print(); };
        if (doc.readyState === 'complete') runPrint(); else frame.onload = runPrint;
        frame.contentWindow.addEventListener('afterprint', () => frame.remove(), { once:true });
    });

    @if($errors->has('courseTitle') || $errors->has('courseCode') || $errors->has('courseUnit') || $errors->has('acadSession'))
    openDialog(dialogs.ocAddCourse);
    @endif
})();
</script>
@endpush
