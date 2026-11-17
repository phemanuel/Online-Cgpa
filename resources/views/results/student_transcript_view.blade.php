@extends('layouts.other-pages')

@section('pageTitle', 'Student Transcript Records | OYSCOHEST Result Portal')
@section('heading', 'Student Transcript Records')
@section('subtitle', 'Select a student to view their academic transcript.')

@push('styles')
<style>
    .oys-transcript-list { --tl-green:#23643A;--tl-dark:#174A2A;--tl-burgundy:#641510;--tl-gold:#D5AA43;--tl-border:#e0e9e3;--tl-muted:#6b7b70; width:100%;margin:0 auto;padding-bottom:48px;color:#27392e;display:flow-root; }
    .oys-transcript-list, .oys-transcript-list * { box-sizing:border-box; }
    .oys-transcript-list .tl-heading { margin-bottom:22px; }
    .oys-transcript-list .tl-eyebrow { text-transform:uppercase;letter-spacing:1.2px;font-weight:800;font-size:11px;color:var(--tl-green);margin-bottom:8px; }
    .oys-transcript-list .tl-eyebrow:before { content:"";display:inline-block;vertical-align:middle;width:17px;height:3px;border-radius:3px;background:var(--tl-gold);margin-right:9px; }
    .oys-transcript-list h1 { margin:0 0 7px;font-size:clamp(23px,3vw,30px);line-height:1.3;font-weight:750;color:#243c2b; }
    .oys-transcript-list .tl-description { font-size:13px;line-height:1.7;color:var(--tl-muted);margin:0; }
    .oys-transcript-list .tl-context { display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin:0 0 21px; }
    .oys-transcript-list .tl-context-pill { display:inline-flex;align-items:center;gap:9px;background:#eef6f0;border:1px solid #dcebdd;color:var(--tl-dark);border-radius:9px;padding:10px 13px;font-size:12px;font-weight:650;max-width:100%;overflow-wrap:anywhere; }
    .oys-transcript-list .tl-context-pill i {color:var(--tl-green);}
    .oys-transcript-list .tl-card { background:#fff;border:1px solid var(--tl-border);border-radius:16px;box-shadow:0 10px 30px rgba(30,66,40,.05);overflow:hidden; }
    .oys-transcript-list .tl-toolbar { display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;padding:20px 23px;border-bottom:1px solid #e8efe9;background:linear-gradient(110deg,#fff 35%,#f7fbf8); }
    .oys-transcript-list .tl-toolbar-title { display:flex;align-items:center;gap:12px; }
    .oys-transcript-list .tl-icon { width:43px;height:43px;border-radius:11px;display:flex;align-items:center;justify-content:center;color:var(--tl-green);background:#eaf4ed;font-size:18px;flex:0 0 43px; }
    .oys-transcript-list .tl-toolbar h2 { font-size:16px;line-height:1.35;font-weight:750;color:#293e2f;margin:0 0 3px; }
    .oys-transcript-list .tl-toolbar .tl-small { font-size:12px;color:var(--tl-muted);margin:0; }
    .oys-transcript-list .tl-search { position:relative;min-width:230px;width:min(100%,330px); }
    .oys-transcript-list .tl-search i { position:absolute;top:50%;left:14px;transform:translateY(-50%);color:#7a8e7e;pointer-events:none; }
    .oys-transcript-list .tl-search input {display:block;width:100%;height:43px;border:1px solid #d9e4dc;border-radius:10px;background:#fff;padding:10px 35px 10px 40px;font-size:13px;color:#304333;box-shadow:none;}
    .oys-transcript-list .tl-search input:focus {outline:none;border-color:var(--tl-green);box-shadow:0 0 0 3px rgba(35,100,58,.1);}
    .oys-transcript-list .tl-search-clear { position:absolute;top:50%;right:8px;transform:translateY(-50%);border:0;background:transparent;color:#7a8e7e;cursor:pointer;padding:7px 9px;display:none; }
    .oys-transcript-list .tl-table-scroll {width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;}
    .oys-transcript-list table {width:100%;min-width:760px;border-collapse:separate;border-spacing:0;margin:0;}
    .oys-transcript-list th {padding:15px 17px;background:#f6f9f7;color:#53685a;font-size:11px;letter-spacing:.35px;text-transform:uppercase;font-weight:800;border-bottom:1px solid #e3eae4;white-space:nowrap;}
    .oys-transcript-list td {padding:13px 17px;border-bottom:1px solid #edf1ee;font-size:13px;color:#304333;vertical-align:middle;}
    .oys-transcript-list tbody tr:last-child td {border-bottom:0;}
    .oys-transcript-list tbody tr:hover {background:#fafdfa;}
    .oys-transcript-list .tl-portrait {width:43px;height:43px;object-fit:cover;border-radius:11px;background:#e8eeea;border:1px solid #dce7df;display:block;}
    .oys-transcript-list .tl-student-name {font-weight:750;color:#273b2c;}
    .oys-transcript-list .tl-admission {font-weight:650;color:#304b38;white-space:nowrap;}
    .oys-transcript-list .tl-level {display:inline-block;border:1px solid #dce8df;border-radius:8px;padding:5px 9px;background:#f5faf6;color:var(--tl-dark);font-size:12px;white-space:nowrap;}
    .oys-transcript-list .tl-view {display:inline-flex;align-items:center;gap:8px;padding:9px 13px;border-radius:9px;background:var(--tl-green);color:#fff;font-size:12px;font-weight:750;text-decoration:none;white-space:nowrap;transition:background .18s;}
    .oys-transcript-list .tl-view:hover,.oys-transcript-list .tl-view:focus {background:var(--tl-dark);color:#fff;text-decoration:none;}
    .oys-transcript-list .tl-alert {margin-bottom:18px;border-radius:10px;padding:12px 15px;font-size:13px;}
    .oys-transcript-list .tl-success {background:#e8f6eb;border:1px solid #cde8d3;color:#174a2a;}
    .oys-transcript-list .tl-error {background:#fff0ee;border:1px solid #efd0cc;color:#86241f;}
    .oys-transcript-list .tl-empty {text-align:center;padding:42px 22px!important;color:#667a6b!important;font-size:13px;}
    .oys-transcript-list .tl-empty i {display:block;font-size:26px;color:#8dab95;margin-bottom:12px;}
    .oys-transcript-list .tl-table-footer {padding:14px 23px;border-top:1px solid #edf1ee;color:var(--tl-muted);font-size:12px;}
    .oys-transcript-list .tl-table-footer strong {color:var(--tl-dark);}
    @media (max-width:700px) { .oys-transcript-list .tl-toolbar {padding:18px;align-items:stretch;flex-direction:column;} .oys-transcript-list .tl-search {width:100%;max-width:none;} .oys-transcript-list .tl-context {gap:8px;} }
</style>
@endpush

@section('content')
<div class="oys-transcript-list">
    <div class="tl-heading">
        <div class="tl-eyebrow">Academic Records</div>
        <h1>Student Transcript Records</h1>
        <p class="tl-description">Find a student from the selected programme and admission year to open their transcript.</p>
    </div>

    @if(session('success'))
        <div class="tl-alert tl-success" role="status">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="tl-alert tl-error" role="alert">{{ session('error') }}</div>
    @endif

    <div class="tl-context">
        <span class="tl-context-pill"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{ $programme }}</span>
        <span class="tl-context-pill"><i class="fas fa-calendar-alt" aria-hidden="true"></i> Admission Year: {{ $admissionYear }}</span>
        <span class="tl-context-pill"><i class="fas fa-user-graduate" aria-hidden="true"></i> {{ $students->count() }} {{ $students->count() === 1 ? 'Student' : 'Students' }}</span>
    </div>

    <div class="tl-card">
        <div class="tl-toolbar">
            <div class="tl-toolbar-title">
                <div class="tl-icon"><i class="fas fa-file-alt" aria-hidden="true"></i></div>
                <div>
                    <h2>Student List</h2>
                    <p class="tl-small">Select View Transcript to open an individual academic record.</p>
                </div>
            </div>
            <div class="tl-search">
                <i class="fas fa-search" aria-hidden="true"></i>
                <input type="search" id="searchInput" placeholder="Search by name or admission no." aria-label="Search students" autocomplete="off">
            </div>
        </div>

        <div class="tl-table-scroll">
            <table id="classListTable">
                <thead>
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Admission No.</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Start Level</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        @php
                            // Preserve original transcript page's image path resolution.
                            $picture = public_path('uploads/' . $student->picture_dir . '.jpg');
                            $pictureUrl = file_exists($picture)
                                ? asset('public/uploads/' . $student->picture_dir . '.jpg')
                                : asset('public/uploads/blank.jpg');
                            $fullName = trim(implode(' ', array_filter([$student->surname, $student->first_name, $student->other_name])));
                        @endphp
                        <tr class="tl-student-row">
                            <td><img class="tl-portrait" src="{{ $pictureUrl }}" alt="{{ $fullName }}" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('public/uploads/blank.jpg') }}';"></td>
                            <td class="tl-admission">{{ $student->admission_no }}</td>
                            <td class="tl-student-name">{{ $fullName }}</td>
                            <td><span class="tl-level">{{ $student->class }}</span></td>
                            <td>
                                <a class="tl-view" href="{{ route('student-transcript.preview', ['stdLevel' => $student->class, 'acad_session' => $student->admission_year, 'programme' => $student->course, 'admission_no' => $student->admission_no]) }}">
                                    <i class="fas fa-file-alt" aria-hidden="true"></i> View Transcript
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="tl-empty"><i class="fas fa-folder-open" aria-hidden="true"></i>No students found for the selected programme and admission year.</td></tr>
                    @endforelse
                    <tr id="tlNoMatches" style="display:none"><td colspan="5" class="tl-empty"><i class="fas fa-search" aria-hidden="true"></i>No students match your search.</td></tr>
                </tbody>
            </table>
        </div>
        <div class="tl-table-footer">Showing <strong id="tlVisibleCount">{{ $students->count() }}</strong> of <strong>{{ $students->count() }}</strong> students</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    var searchInput = document.getElementById('searchInput');
    var table = document.getElementById('classListTable');
    var count = document.getElementById('tlVisibleCount');
    var noMatches = document.getElementById('tlNoMatches');
    if (!searchInput || !table) return;
    var rows = Array.prototype.slice.call(table.querySelectorAll('tbody tr.tl-student-row'));
    function filterTable() {
        var term = searchInput.value.trim().toLocaleLowerCase();
        var visible = 0;
        rows.forEach(function (row) {
            var cells = row.cells;
            var text = ((cells[1] ? cells[1].textContent : '') + ' ' + (cells[2] ? cells[2].textContent : '') + ' ' + (cells[3] ? cells[3].textContent : '')).toLocaleLowerCase();
            var matches = !term || text.indexOf(term) !== -1;
            row.style.display = matches ? '' : 'none';
            if (matches) visible++;
        });
        if (count) count.textContent = visible;
        if (noMatches) noMatches.style.display = rows.length && !visible ? '' : 'none';
    }
    searchInput.addEventListener('input', filterTable);
})();
</script>
@endpush
