@extends('layouts.other-pages')

@section('pageTitle', 'Enter Student Scores | OYSCOHEST Result Portal')
@section('heading', 'Student Score Entry')
@section('subtitle', 'Review and update course scores for the selected class.')
@section('headerCaption', 'Academic Results')

@push('styles')
<style>
/* All scroll and sticky rules are scoped to this page. Do not wrap the grid in Bootstrap .table-responsive. */
.oys-entry{--g:#23643a;--gd:#174a2a;--br:#641510;--gold:#d5aa43;--line:#e1e9e4;--ink:#27372d;--muted:#718078;min-width:0;max-width:100%;}
.oys-entry *, .oys-entry *::before,.oys-entry *::after{box-sizing:border-box}
.oys-entry-head{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:18px}
.oys-entry-eyebrow{color:var(--g);font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.9px;margin-bottom:9px}
.oys-entry-title{font-size:19px;font-weight:800;color:var(--ink);margin:0 0 7px}
.oys-entry-caption{font-size:12px;color:var(--muted);line-height:1.8;margin:0}
.oys-entry-actions{display:flex;gap:9px;flex-wrap:wrap;align-items:center}
.oys-entry-btn{display:inline-flex;align-items:center;justify-content:center;gap:9px;padding:11px 15px;border:1px solid #cee2d3;border-radius:9px;background:#fff;color:var(--g)!important;font-size:12px;font-weight:700;text-decoration:none!important;cursor:pointer;min-height:41px}
.oys-entry-btn:hover{background:#ebf5ee}
.oys-entry-btn.primary{background:var(--g);color:#fff!important;border-color:var(--g)}
.oys-entry-btn.primary:hover{background:var(--gd)}
.oys-entry-stats{display:flex;gap:12px;flex-wrap:wrap;margin-bottom:17px}
.oys-entry-stat{display:flex;align-items:center;gap:11px;padding:13px 16px;background:#fff;border:1px solid var(--line);border-radius:11px;min-width:160px}
.oys-entry-stat i{color:var(--g);font-size:17px}
.oys-entry-stat strong{font-size:18px;color:var(--ink);display:block;line-height:1.2}
.oys-entry-stat small{font-size:11px;color:var(--muted)}
.oys-entry-panel{border:1px solid var(--line);background:#fff;border-radius:15px;box-shadow:0 7px 28px rgba(36,76,45,.045);min-width:0}
.oys-entry-toolbar{padding:17px 19px;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap}
.oys-entry-toolbar-title{font-size:14px;font-weight:800;color:var(--ink);margin:0 0 4px}
.oys-entry-toolbar p{color:var(--muted);font-size:11px;margin:0}
.oys-entry-search{display:flex;align-items:center;gap:9px;padding:0 12px;border:1px solid #d6e3d9;border-radius:9px;min-width:230px;background:#fcfdfc}
.oys-entry-search i{color:var(--g)}
.oys-entry-search input{min-height:41px;width:100%;background:transparent;border:0;outline:none;font-size:12px;color:var(--ink)}
.oys-entry-grid-wrap{padding:12px;min-width:0;max-width:100%}
/* CRITICAL: this is the only scroll surface for the grid; both axes use the same scrollport. */
.oys-score-scroll{position:relative;width:100%;max-width:100%;max-height:560px;overflow:auto;overscroll-behavior:contain;border:1px solid #dce6de;border-radius:9px;background:#fff;scrollbar-gutter:stable}
.oys-score-table{table-layout:fixed;border-collapse:separate!important;border-spacing:0!important;width:max-content!important;min-width:100%;margin:0!important;background:#fff}
.oys-score-table th,.oys-score-table td{border:0!important;border-right:1px solid #e6ebe7!important;border-bottom:1px solid #e6ebe7!important;padding:10px 9px!important;vertical-align:middle!important;font-size:12px;line-height:1.5}
.oys-score-table thead th{position:sticky;top:0;z-index:4;min-height:70px;background:#eaf3ed!important;color:#254a30;font-size:11px;font-weight:800;text-align:center;white-space:normal;box-shadow:0 1px 0 #d0dfd3}
.oys-score-table tbody tr:nth-child(even) td{background:#fbfdfb}
.oys-score-table tbody tr:hover td{background:#f0f8f2}
.oys-score-table .oys-col-num{width:56px;min-width:56px;max-width:56px;text-align:center;position:sticky;left:0;z-index:2;background:#fff;box-shadow:1px 0 0 #e1e7e3}
.oys-score-table .oys-col-admission{width:155px;min-width:155px;max-width:155px;position:sticky;left:56px;z-index:2;background:#fff;font-weight:700;color:var(--gd);box-shadow:1px 0 0 #e1e7e3}
.oys-score-table .oys-col-name{width:235px;min-width:235px;max-width:235px;position:sticky;left:211px;z-index:2;background:#fff;font-weight:700;color:var(--ink);box-shadow:2px 0 4px rgba(12,36,19,.08)}
.oys-score-table tbody tr:nth-child(even) .oys-col-num,.oys-score-table tbody tr:nth-child(even) .oys-col-admission,.oys-score-table tbody tr:nth-child(even) .oys-col-name{background:#f6faf7}
.oys-score-table tbody tr:hover .oys-col-num,.oys-score-table tbody tr:hover .oys-col-admission,.oys-score-table tbody tr:hover .oys-col-name{background:#eaf5ed}
/* Header + frozen-column intersections must sit above normal sticky headers and body columns. */
.oys-score-table thead .oys-col-num{z-index:8;background:#dcebdd!important}
.oys-score-table thead .oys-col-admission{z-index:8;background:#dcebdd!important}
.oys-score-table thead .oys-col-name{z-index:8;background:#dcebdd!important}
.oys-score-table .oys-col-course{width:145px;min-width:145px;max-width:145px;text-align:center}
.oys-score-table .oys-col-action{width:177px;min-width:177px;max-width:177px;text-align:center}
.oys-course-title{display:block;font-weight:800;color:#274631;font-size:11px;line-height:1.4;margin-bottom:4px}
.oys-course-code{color:var(--g);font-weight:800;font-size:10px}
.oys-course-unit{color:var(--br);font-weight:700;font-size:10px}
.oys-score-box{position:relative;display:inline-flex;align-items:center;justify-content:center;width:74px;max-width:100%}
.oys-score-input.form-control{display:block!important;width:70px!important;min-width:70px!important;max-width:70px!important;height:39px!important;padding:7px 9px!important;text-align:center!important;border:1px solid #cfddd2!important;border-radius:8px!important;background:#fff!important;font-size:12px!important;font-weight:700;color:#283d2f!important;box-shadow:none!important}
.oys-score-input.form-control:focus{border-color:var(--g)!important;box-shadow:0 0 0 3px rgba(35,100,58,.13)!important}
.oys-score-input.is-saving{border-color:#b98b30!important;background:#fffaf0!important}
.oys-score-input.is-saved{border-color:var(--g)!important;background:#f2faf4!important}
.oys-score-input.is-error{border-color:#bc343b!important;background:#fff6f6!important}
.oys-failed-mark{position:absolute;top:-6px;right:-7px;color:#b52536;background:#fff;border-radius:50%;font-size:11px;font-weight:900;pointer-events:none}
.oys-resit-btn{border:1px solid #bedbc7;border-radius:8px;background:#edf7ef;color:var(--g);font-weight:700;font-size:11px;padding:9px 10px;cursor:pointer;white-space:normal}
.oys-resit-btn:hover{background:var(--g);color:#fff}
.oys-entry-note{font-size:11px;color:#718078;padding:12px 18px;border-top:1px solid var(--line);display:flex;align-items:center;gap:8px}
.oys-entry-note i{color:var(--g)}
.oys-entry-empty{padding:30px!important;text-align:center;color:#718078!important}
.oys-entry .modal-content{border-radius:14px;border:0;overflow:hidden}
.oys-entry .modal-header{background:#f0f7f2;border-bottom:1px solid #dfebe2;align-items:center}
.oys-entry .modal-title{font-size:16px;font-weight:800;color:var(--gd)}
.oys-entry .modal-body{padding:22px}
.oys-entry .modal-footer{border-top:1px solid var(--line)}
.oys-entry .resit-input{width:85px!important;max-width:85px!important;text-align:center}
.oys-entry .resit-table-wrap{overflow-x:auto}
.oys-entry .resit-table{min-width:570px}
.oys-entry .resit-table th{background:#eaf3ed;color:#234b2e;font-size:11px}
.oys-entry .resit-table td{font-size:12px;vertical-align:middle}
.oys-entry .alert{font-size:12px}
@media(max-width:767px){.oys-entry-toolbar{align-items:stretch}.oys-entry-search{width:100%;min-width:0}.oys-entry-grid-wrap{padding:8px}.oys-score-scroll{max-height:65vh}.oys-entry-stats{gap:8px}.oys-entry-stat{flex:1;min-width:120px}.oys-entry-actions{width:100%}.oys-entry-btn{flex:1}}
</style>
@endpush

@section('content')
<div class="oys-entry">
    <div class="oys-entry-head">
        <div>
            <div class="oys-entry-eyebrow">Result Management / Score Entry</div>
            <h2 class="oys-entry-title">{{ $programme }} — {{ $stdLevel }} Level</h2>
            <p class="oys-entry-caption">{{ $admissionYear }} admission year &nbsp;·&nbsp; {{ $semester }} Semester</p>
        </div>
        <div class="oys-entry-actions">
            <a href="{{ route('result-entry') }}" class="oys-entry-btn"><i class="fas fa-arrow-left"></i> Back to Result Entry</a>
            <button type="button" class="oys-entry-btn primary" id="printScoreSheet"><i class="fas fa-print"></i> Print Score Sheet</button>
        </div>
    </div>

    <div class="oys-entry-stats">
        <div class="oys-entry-stat"><i class="fas fa-users"></i><div><strong>{{ $students->count() }}</strong><small>Students in list</small></div></div>
        <div class="oys-entry-stat"><i class="fas fa-book-open"></i><div><strong>{{ $courses->count() }}</strong><small>Courses</small></div></div>
        <div class="oys-entry-stat"><i class="fas fa-check-circle"></i><div><strong>{{ $passMark->pass_mark }}</strong><small>Minimum pass mark</small></div></div>
    </div>

    <div class="oys-entry-panel">
        <div class="oys-entry-toolbar">
            <div>
                <h3 class="oys-entry-toolbar-title">Student Score Sheet</h3>
                <p>Scroll sideways to view courses. Admission number and student name remain visible.</p>
            </div>
            <label class="oys-entry-search" for="searchInput"><i class="fas fa-search" aria-hidden="true"></i><input id="searchInput" type="search" placeholder="Search matric no. or name" aria-label="Search students"></label>
        </div>

        <div class="oys-entry-grid-wrap">
            <div class="oys-score-scroll" id="scoreScroll" role="region" aria-label="Scrollable student score sheet" tabindex="0">
                <table class="oys-score-table" id="classListTable">
                    <thead><tr>
                        <th scope="col" class="oys-col-num">#</th>
                        <th scope="col" class="oys-col-admission">Admission No</th>
                        <th scope="col" class="oys-col-name">Student Name</th>
                        @foreach($courses as $course)
                            <th scope="col" class="oys-col-course"><span class="oys-course-title">{{ $course->course_title }}</span><span class="oys-course-code">{{ $course->course_code }}</span> <span class="oys-course-unit">({{ $course->course_unit }} units)</span></th>
                        @endforeach
                        <th scope="col" class="oys-col-action">Resit Action</th>
                    </tr></thead>
                    <tbody>
                    @forelse($students as $key => $student)
                        <tr data-search="{{ strtolower(trim($student->admission_no.' '.$student->surname.' '.$student->first_name.' '.$student->other_name)) }}">
                            <td class="oys-col-num">{{ $key + 1 }}</td>
                            <td class="oys-col-admission">{{ $student->admission_no }}</td>
                            <td class="oys-col-name">{{ $student->surname }} {{ $student->first_name }} {{ $student->other_name }}</td>
                            @foreach($courses as $course)
                                @php
                                    $index = $course->index;
                                    $score = $studentScores[$student->admission_no][$index] ?? 0;
                                    $formattedScore = (float)$score == (int)$score ? (int)$score : $score;
                                    $scoreValue = old("scores.{$student->id}.{$index}", $formattedScore);
                                    $isFailed = is_numeric($scoreValue) && (float)$scoreValue < (float)$passMark->pass_mark;
                                @endphp
                                <td class="oys-col-course">
                                    <div class="oys-score-box">
                                        <input type="text" inputmode="numeric" maxlength="3" autocomplete="off"
                                            name="scores[{{ $student->id }}][{{ $index }}]"
                                            class="form-control dynamic-score-input oys-score-input"
                                            value="{{ $scoreValue }}"
                                            data-student-id="{{ $student->id }}"
                                            data-course-id="{{ $index }}"
                                            data-admission-no="{{ $student->admission_no }}"
                                            data-class="{{ $stdLevel }}"
                                            data-semester="{{ $semester }}"
                                            data-course-title="{{ $course->course_title }}"
                                            data-course-code="{{ $course->course_code }}"
                                            data-course-unit="{{ $course->course_unit }}"
                                            data-course-index="{{ $index }}"
                                            data-last-saved="{{ $formattedScore }}"
                                            aria-label="{{ $course->course_code }} score for {{ $student->admission_no }}">
                                        @if($isFailed)<span class="oys-failed-mark" title="Below pass mark" aria-label="Below pass mark">&#10006;</span>@endif
                                    </div>
                                </td>
                            @endforeach
                            <td class="oys-col-action">
                                @if(!$computationExists)
                                    <small class="text-muted">Result not computed</small>
                                @elseif(isset($studentsWithFailedCourses[$student->admission_no]))
                                    <button type="button" class="oys-resit-btn openResitModal"
                                        data-student-id="{{ $student->admission_no }}"
                                        data-student-name="{{ $student->surname }} {{ $student->first_name }} {{ $student->other_name }}"
                                        data-level="{{ $stdLevel }}" data-semester="{{ $semester }}" data-admissionyear="{{ $admissionYear }}">
                                        Update Resit Score
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ $courses->count() + 4 }}" class="oys-entry-empty">No students found for the selected criteria.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="oys-entry-note"><i class="fas fa-info-circle"></i> Score edits save automatically when you leave the field. The table scrolls independently of the page.</div>
    </div>

    <div class="modal fade" id="resitModal" tabindex="-1" role="dialog" aria-labelledby="resitModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title" id="resitModalLabel"><i class="fas fa-redo-alt"></i> Resit Scores</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                <div class="modal-body">
                    <div id="studentInfo" class="alert alert-light border mb-3" aria-live="polite"></div>
                    <input type="hidden" id="studentId"><input type="hidden" id="studentName"><input type="hidden" id="studentLevel"><input type="hidden" id="studentSemester"><input type="hidden" id="studentAdmissionYear">
                    <div class="resit-table-wrap"><table class="table table-bordered resit-table"><thead><tr><th>#</th><th>Course</th><th>Course Code</th><th>Current Score</th><th>Resit Score</th></tr></thead><tbody id="failedCoursesBody"><tr><td colspan="5" class="text-center">Select a student to load failed courses.</td></tr></tbody></table></div>
                    <div id="resitFeedback" class="small" role="status" aria-live="polite"></div>
                </div>
                <div class="modal-footer"><button type="button" class="oys-entry-btn" data-dismiss="modal">Close</button><button type="button" class="oys-entry-btn primary" id="saveResitScoresBtn">Save Resit Scores</button></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    const root = document.querySelector('.oys-entry');
    if (!root) return;
    const table = root.querySelector('#classListTable');
    const token = @json(csrf_token());
    const passMark = Number(@json($passMark->pass_mark));
    const saveUrl = @json(route('save.score'));
    const failedUrl = @json(route('fetchFailedCourses'));
    const resitSaveUrl = @json(route('saveResitScores'));
    const labels = { programme: @json($programme), level: @json($stdLevel), admissionYear: @json($admissionYear), semester: @json($semester) };

    function failedIndicator(input, score) {
        const holder = input.closest('.oys-score-box');
        if (!holder) return;
        holder.querySelector('.oys-failed-mark')?.remove();
        if (Number.isFinite(score) && score < passMark) {
            const mark = document.createElement('span');
            mark.className = 'oys-failed-mark';
            mark.textContent = '✖';
            mark.title = 'Below pass mark';
            holder.appendChild(mark);
        }
    }
    function notify(message) { window.alert(message); }
    root.querySelector('#searchInput')?.addEventListener('input', function () {
        const term = this.value.toLocaleLowerCase().trim();
        table.querySelectorAll('tbody tr[data-search]').forEach(row => {
            row.hidden = !row.dataset.search.includes(term);
            row.style.display = row.hidden ? 'none' : '';
        });
    });
    table.querySelectorAll('.dynamic-score-input').forEach(input => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/g, '').slice(0, 3);
            input.classList.remove('is-saved', 'is-error');
            input.setCustomValidity('');
        });
        input.addEventListener('change', async () => {
            const value = input.value.trim();
            const score = Number(value);
            if (value === '' || !Number.isInteger(score) || score < 0 || score > 100) {
                input.classList.add('is-error');
                input.setCustomValidity('Enter a whole-number score between 0 and 100.');
                input.reportValidity();
                input.focus();
                return;
            }
            if (String(score) === String(input.dataset.lastSaved)) {
                failedIndicator(input, score);
                return;
            }
            input.disabled = true;
            input.classList.add('is-saving');
            try {
                const response = await fetch(saveUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' },
                    body: JSON.stringify({
                        student_id: input.dataset.studentId,
                        course_id: input.dataset.courseId,
                        admission_no: input.dataset.admissionNo,
                        class: input.dataset.class,
                        semester: input.dataset.semester,
                        course_title: input.dataset.courseTitle,
                        course_unit: input.dataset.courseUnit,
                        course_code: input.dataset.courseCode,
                        course_index: input.dataset.courseIndex,
                        score: score
                    })
                });
                const data = await response.json();
                if (!response.ok || !data.message) throw new Error(data.message || 'Unable to save score');
                input.dataset.lastSaved = String(score);
                input.classList.remove('is-error');
                input.classList.add('is-saved');
                failedIndicator(input, score);
            } catch (error) {
                console.error('Score save failed', error);
                input.classList.add('is-error');
                notify('Failed to save this score. Please try again.');
            } finally {
                input.classList.remove('is-saving');
                input.disabled = false;
            }
        });
    });

    // Print the entire table (not merely the visible scroll viewport).
    root.querySelector('#printScoreSheet')?.addEventListener('click', () => {
        const clone = table.cloneNode(true);
        clone.querySelectorAll('tbody tr[data-search]').forEach(row => { row.style.display = ''; row.hidden = false; });
        clone.querySelectorAll('input.dynamic-score-input').forEach((input, index) => {
            const original = table.querySelectorAll('input.dynamic-score-input')[index];
            const score = original ? original.value : input.value;
            input.closest('td').textContent = score === '' ? '—' : score;
        });
        clone.querySelectorAll('.oys-col-action').forEach(cell => cell.remove());
        const win = window.open('', '_blank');
        if (!win) { notify('Allow pop-ups to print the score sheet.'); return; }
        const css = `body{font-family:Arial,sans-serif;margin:18px;color:#222}h2{margin:0;font-size:17px}p{font-size:12px}table{border-collapse:collapse;width:100%;font-size:10px}th,td{border:1px solid #999;padding:5px;text-align:left;vertical-align:middle}thead{display:table-header-group}th{background:#eaf3ed}tr{break-inside:avoid} .oys-course-title{display:block}.oys-course-code,.oys-course-unit{font-size:9px}@page{size:landscape;margin:10mm}`;
        win.document.open();
        win.document.write('<!doctype html><html><head><title>Score Sheet</title><style>' + css + '</style></head><body>');
        const heading = win.document.createElement('h2');
        heading.textContent = 'Oyo State College of Health, Science and Technology — Score Sheet';
        const description = win.document.createElement('p');
        description.textContent = `${labels.programme} · ${labels.level} Level · ${labels.admissionYear} Admission · ${labels.semester} Semester`;
        win.document.body.append(heading, description);
        win.document.body.appendChild(win.document.importNode(clone, true));
        win.document.close();
        win.focus();
        win.print();
    });

    const modal = root.querySelector('#resitModal');
    const tbody = root.querySelector('#failedCoursesBody');
    const feedback = root.querySelector('#resitFeedback');
    const saveBtn = root.querySelector('#saveResitScoresBtn');
    let fetchSequence = 0;
    function showModal() {
        if (window.jQuery && typeof window.jQuery.fn.modal === 'function') window.jQuery(modal).modal('show');
        else { modal.style.display = 'block'; modal.classList.add('show'); modal.setAttribute('aria-hidden', 'false'); }
    }
    function rowCell(row, text) { const td = document.createElement('td'); td.textContent = text == null ? '' : String(text); row.appendChild(td); return td; }
    root.querySelectorAll('.openResitModal').forEach(button => button.addEventListener('click', async () => {
        const sid = button.dataset.studentId;
        const level = button.dataset.level;
        const semester = button.dataset.semester;
        const admissionYear = button.dataset.admissionyear;
        root.querySelector('#studentId').value = sid;
        root.querySelector('#studentName').value = button.dataset.studentName;
        root.querySelector('#studentLevel').value = level;
        root.querySelector('#studentSemester').value = semester;
        root.querySelector('#studentAdmissionYear').value = admissionYear;
        root.querySelector('#studentInfo').textContent = `Admission No: ${sid} | Name: ${button.dataset.studentName} | Level: ${level} | Semester: ${semester} | Admission Year: ${admissionYear}`;
        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Loading failed courses…</td></tr>';
        feedback.textContent = '';
        saveBtn.disabled = true;
        showModal();
        const current = ++fetchSequence;
        try {
            const params = new URLSearchParams({ admission_no: sid, level, semester, admissionYear });
            const response = await fetch(failedUrl + (failedUrl.includes('?') ? '&' : '?') + params, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
            if (!response.ok) throw new Error('Unable to fetch failed courses');
            const data = await response.json();
            if (current !== fetchSequence) return;
            tbody.replaceChildren();
            const courses = Array.isArray(data.failedCourses) ? data.failedCourses : [];
            if (!courses.length) {
                const row = document.createElement('tr');
                rowCell(row, 'No failed courses found or results not computed yet.').colSpan = 5;
                tbody.append(row);
            } else {
                courses.forEach((item, index) => {
                    const row = document.createElement('tr');
                    rowCell(row, index + 1);
                    rowCell(row, item.subject);
                    rowCell(row, item.course_code);
                    rowCell(row, item.current_score);
                    const scoreCell = rowCell(row, '');
                    const input = document.createElement('input');
                    input.type = 'number'; input.min = '0'; input.max = '100'; input.step = '1';
                    input.className = 'form-control resit-input';
                    input.name = `resit_score[${item.course_code}]`;
                    input.dataset.courseCode = item.course_code;
                    input.setAttribute('aria-label', `Resit score for ${item.course_code}`);
                    scoreCell.appendChild(input);
                    tbody.append(row);
                });
                saveBtn.disabled = false;
            }
        } catch (error) {
            console.error('Failed courses fetch failed', error);
            tbody.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Unable to load failed courses. Please retry.</td></tr>';
        }
    }));
    saveBtn?.addEventListener('click', async () => {
        const inputs = [...tbody.querySelectorAll('.resit-input')];
        const scores = [];
        for (const input of inputs) {
            const value = input.value.trim();
            if (!value) continue;
            const numeric = Number(value);
            if (!Number.isInteger(numeric) || numeric < 0 || numeric > 100) {
                feedback.textContent = 'Each resit score must be a whole number from 0 to 100.';
                input.focus(); return;
            }
            scores.push({ course_code: input.dataset.courseCode, resit_score: value });
        }
        if (!scores.length) { feedback.textContent = 'Please enter resit scores before saving.'; return; }
        saveBtn.disabled = true;
        feedback.textContent = 'Saving resit scores…';
        try {
            // Keep the original jQuery-style POST field shape expected by the existing Laravel endpoint.
            const payload = new URLSearchParams();
            payload.append('_token', token);
            scores.forEach((s, i) => { payload.append(`resit_scores[${i}][course_code]`, s.course_code); payload.append(`resit_scores[${i}][resit_score]`, s.resit_score); });
            payload.append('student_id', root.querySelector('#studentId').value);
            payload.append('level', root.querySelector('#studentLevel').value);
            payload.append('semester', root.querySelector('#studentSemester').value);
            payload.append('admission_year', root.querySelector('#studentAdmissionYear').value);
            const response = await fetch(resitSaveUrl, { method: 'POST', headers: { 'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8', 'X-Requested-With': 'XMLHttpRequest' }, body: payload });
            const data = await response.json();
            if (!response.ok || !data.success) throw new Error(data.message || 'Unable to save resit scores');
            notify(data.message || 'Resit scores saved successfully!');
            window.location.reload();
        } catch (error) {
            console.error('Resit save failed', error);
            feedback.textContent = 'Unable to save resit scores. Please try again.';
            saveBtn.disabled = false;
        }
    });
})();
</script>
@endpush
