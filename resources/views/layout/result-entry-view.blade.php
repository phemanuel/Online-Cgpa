@extends('result-portal.layouts.dashboard')

@section('pageTitle', 'Instructor Result Entry | OYSCOHEST Result Portal')
@section('heading', 'Instructor Result Entry')
@section('subtitle', 'Enter and review scores for your assigned course.')
@section('headerCaption', 'Academic Results')

@push('styles')
<style>
/* This page intentionally uses ONE two-axis scrollport. Do not nest it inside .table-responsive. */
.oys-ir{--green:#23643a;--dark:#174a2a;--brown:#641510;--gold:#d5aa43;--line:#dfe9e2;--muted:#6b7b70;min-width:0;max-width:100%;color:#28382d}
.oys-ir *, .oys-ir *::before,.oys-ir *::after{box-sizing:border-box}
.oys-ir-header{display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:14px;margin-bottom:18px}
.oys-ir-label{font-size:11px;letter-spacing:.12em;color:var(--green);font-weight:800;text-transform:uppercase;margin-bottom:7px}
.oys-ir-title{font-weight:800;color:#24382c;font-size:20px;line-height:1.35;margin:0 0 7px}
.oys-ir-subtitle{margin:0;color:var(--muted);font-size:12px;line-height:1.75}
.oys-ir-buttons{display:flex;flex-wrap:wrap;gap:9px}
.oys-ir-button{display:inline-flex;align-items:center;justify-content:center;gap:9px;min-height:40px;padding:10px 15px;border:1px solid #cfe0d3;border-radius:9px;color:var(--green)!important;background:#fff;font-size:12px;font-weight:700;text-decoration:none!important;cursor:pointer}
.oys-ir-button:hover{background:#ecf6ef}.oys-ir-button.primary{color:#fff!important;background:var(--green);border-color:var(--green)}.oys-ir-button.primary:hover{background:var(--dark)}
.oys-ir-overview{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px;margin-bottom:16px}
.oys-ir-metric{border:1px solid var(--line);border-radius:12px;background:#fff;padding:17px 19px;min-width:0}
.oys-ir-metric-label{font-size:11px;color:var(--muted);display:block;margin-bottom:7px}.oys-ir-metric-value{font-size:17px;font-weight:800;color:var(--dark);overflow-wrap:anywhere;line-height:1.45}
.oys-ir-panel{background:#fff;border:1px solid var(--line);border-radius:15px;box-shadow:0 7px 26px rgba(27,79,44,.045);min-width:0;max-width:100%}
.oys-ir-toolbar{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;padding:18px 20px;border-bottom:1px solid var(--line)}
.oys-ir-toolbar h2{margin:0 0 5px;font-size:15px;font-weight:800;color:#26372c}.oys-ir-toolbar p{font-size:11px;color:var(--muted);margin:0;line-height:1.6}
.oys-ir-search{display:flex;align-items:center;gap:9px;border:1px solid #d6e4da;border-radius:9px;padding:0 13px;background:#fcfdfc;min-width:220px}
.oys-ir-search i{color:var(--green)}.oys-ir-search input{width:100%;height:41px;border:0!important;box-shadow:none!important;background:transparent!important;outline:none!important;padding:0!important;font-size:12px!important;text-align:left!important}
.oys-ir-course-strip{margin:14px 14px 0;background:#f3f9f5;border:1px solid #d9ebdd;border-left:3px solid var(--green);border-radius:9px;padding:12px 15px;display:flex;gap:9px;align-items:center;flex-wrap:wrap;font-size:12px}
.oys-ir-course-strip strong{color:var(--dark)}.oys-ir-course-strip span{color:var(--muted)}
.oys-ir-grid-padding{padding:14px;min-width:0;max-width:100%}
/* Preserve the original 70vh scroll surface and frozen 130/320/220px columns. */
.oys-ir .table-wrapper{width:100%;height:70vh;overflow:auto;position:relative;-webkit-overflow-scrolling:touch;overscroll-behavior:contain;border:1px solid #d9e4dc;border-radius:10px;background:#fff;max-width:100%}
.oys-ir #classListTable{border-collapse:separate!important;border-spacing:0!important;width:max-content!important;min-width:100%;margin:0!important;table-layout:fixed}
.oys-ir #classListTable th,.oys-ir #classListTable td{white-space:nowrap!important;box-sizing:border-box;border:0!important;border-right:1px solid #e3ebe5!important;border-bottom:1px solid #e3ebe5!important;padding:11px 12px!important;vertical-align:middle!important;font-size:12px}
.oys-ir #classListTable thead th{position:sticky;top:0;height:65px;background:#e8f3eb!important;z-index:100;text-align:center;color:var(--dark);font-weight:800;box-shadow:0 1px 0 #cbdccd}
.oys-ir #classListTable .sticky-col{position:sticky;left:0;width:130px;min-width:130px;max-width:130px;background:#fff;z-index:200;color:var(--dark);font-weight:750}
.oys-ir #classListTable .sticky-name{position:sticky;left:130px;width:320px;min-width:320px;max-width:320px;background:#fff;z-index:200;font-weight:700;box-shadow:2px 0 5px rgba(30,70,45,.08)}
.oys-ir #classListTable .sticky-course{position:sticky;left:450px;width:220px;min-width:220px;max-width:220px;background:#fff;z-index:200;text-align:center;box-shadow:2px 0 5px rgba(30,70,45,.08)}
.oys-ir #classListTable thead th.sticky-col,.oys-ir #classListTable thead th.sticky-name,.oys-ir #classListTable thead th.sticky-course{z-index:500;background:#dcebdd!important;top:0}
.oys-ir #classListTable thead th.sticky-col{left:0}.oys-ir #classListTable thead th.sticky-name{left:130px}.oys-ir #classListTable thead th.sticky-course{left:450px}
.oys-ir #classListTable tbody tr:nth-child(even) td{background:#f9fcfa}.oys-ir #classListTable tbody tr:nth-child(even) td.sticky-col,.oys-ir #classListTable tbody tr:nth-child(even) td.sticky-name,.oys-ir #classListTable tbody tr:nth-child(even) td.sticky-course{background:#f3f9f5}
.oys-ir #classListTable tbody tr:hover td{background:#eaf5ed!important}
.oys-ir-course-title{font-weight:800;display:block;color:#244d31;font-size:12px;line-height:1.5;white-space:normal}.oys-ir-course-meta{font-size:10px;color:var(--muted)}.oys-ir-course-meta b{color:var(--green)}.oys-ir-course-meta em{color:var(--brown);font-style:normal;font-weight:700}
.oys-ir #classListTable .dynamic-score-input.form-control{width:100%!important;min-width:0!important;max-width:100%!important;height:41px!important;border:1px solid #cbded0!important;border-radius:8px!important;background:#fff8d9!important;padding:8px!important;font-size:13px!important;font-weight:800!important;text-align:center!important;color:#273d30!important;box-shadow:none!important}
.oys-ir #classListTable .dynamic-score-input.form-control:focus{border-color:var(--green)!important;box-shadow:0 0 0 3px rgba(35,100,58,.12)!important}
.oys-ir #classListTable .dynamic-score-input.is-saving{border-color:#b38426!important;background:#fff0c4!important}.oys-ir #classListTable .dynamic-score-input.is-saved{border-color:var(--green)!important;background:#ecf7ef!important}.oys-ir #classListTable .dynamic-score-input.is-error{border-color:#bf313c!important;background:#fff3f3!important}
.oys-ir-footnote{padding:13px 18px;border-top:1px solid var(--line);font-size:11px;color:var(--muted);display:flex;align-items:center;gap:9px;line-height:1.6}.oys-ir-footnote i{color:var(--green)}
.oys-ir-feedback{font-size:12px;min-height:18px;color:var(--muted)}.oys-ir-empty{padding:30px!important;text-align:center;color:var(--muted)}
@media(max-width:767px){.oys-ir-overview{grid-template-columns:1fr}.oys-ir-toolbar{padding:15px}.oys-ir-search{width:100%}.oys-ir-grid-padding{padding:9px}.oys-ir .table-wrapper{height:70vh}.oys-ir #classListTable{font-size:12px}.oys-ir #classListTable .sticky-col{width:90px;min-width:90px;max-width:90px;left:0}.oys-ir #classListTable .sticky-name{width:220px;min-width:220px;max-width:220px;left:90px}.oys-ir #classListTable .sticky-course{width:180px;min-width:180px;max-width:180px;left:310px}.oys-ir #classListTable thead th.sticky-col{left:0}.oys-ir #classListTable thead th.sticky-name{left:90px}.oys-ir #classListTable thead th.sticky-course{left:310px}.oys-ir #classListTable .dynamic-score-input.form-control{height:36px!important;font-size:13px!important}}
@media print{.oys-ir-buttons,.oys-ir-search,.oys-ir-footnote{display:none!important}}
</style>
@endpush

@section('content')
<div class="oys-ir" id="instructorResultEntry">
    <div class="oys-ir-header">
        <div>
            <div class="oys-ir-label">Academic Management / Score Entry</div>
            <h2 class="oys-ir-title">Assigned Course Results</h2>
            <p class="oys-ir-subtitle">{{ $assignedCourse->programme }} · {{ $assignedCourse->level }} Level · {{ $assignedCourse->semester }} Semester</p>
        </div>
        <div class="oys-ir-buttons">
            <a class="oys-ir-button" href="{{ route('result-entry') }}"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back to Result Entry</a>
            <button type="button" id="printInstructorSheet" class="oys-ir-button primary"><i class="fas fa-print" aria-hidden="true"></i> Print Score Sheet</button>
        </div>
    </div>

    <div class="oys-ir-overview">
        <div class="oys-ir-metric"><span class="oys-ir-metric-label">Students in Class</span><div class="oys-ir-metric-value">{{ $students->count() }}</div></div>
        <div class="oys-ir-metric"><span class="oys-ir-metric-label">Assigned Course</span><div class="oys-ir-metric-value">{{ $assignedCourse->course_code }}</div></div>
        <div class="oys-ir-metric"><span class="oys-ir-metric-label">Course Unit</span><div class="oys-ir-metric-value">{{ $assignedCourse->course_unit }}</div></div>
    </div>

    <section class="oys-ir-panel" aria-label="Instructor result entry table">
        <div class="oys-ir-toolbar">
            <div><h2>Student Score Register</h2><p>Scores are saved automatically when you finish editing a field.</p></div>
            <label class="oys-ir-search" for="searchInput"><i class="fas fa-search" aria-hidden="true"></i><input type="search" id="searchInput" placeholder="Search admission no. or name" autocomplete="off" aria-label="Search student records"></label>
        </div>
        <div class="oys-ir-course-strip"><i class="fas fa-book-open" style="color:#23643a" aria-hidden="true"></i><strong>{{ $assignedCourse->course_title }}</strong><span>{{ $assignedCourse->course_code }} · {{ $assignedCourse->course_unit }} Unit(s)</span></div>
        <div class="oys-ir-grid-padding">
            <div class="table-wrapper" tabindex="0" role="region" aria-label="Scrollable student score table; scroll horizontally to view course scores">
                <table id="classListTable" class="table table-bordered">
                    <thead><tr>
                        <th class="sticky-col" scope="col">Admission No</th>
                        <th class="sticky-name" scope="col">Name</th>
                        @foreach($courses as $course)
                            @if($course->course_title == $assignedCourse->course_title)
                                <th class="sticky-course" scope="col"><span class="oys-ir-course-title">{{ $course->course_title }}</span><span class="oys-ir-course-meta"><b>{{ $course->course_code }}</b> · <em>{{ $course->course_unit }} Unit(s)</em></span></th>
                            @endif
                        @endforeach
                    </tr></thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td class="sticky-col">{{ $student->admission_no }}</td>
                                <td class="sticky-name">{{ trim($student->surname . ' ' . $student->first_name . ' ' . $student->other_name) }}</td>
                                @foreach($courses as $course)
                                    @if($course->course_title == $assignedCourse->course_title)
                                        @php
                                            // Course ID is intentionally used here; scores are keyed by $course->id.
                                            $score = $studentScores[$student->admission_no][$course->id] ?? 0;
                                            $formattedScore = (float) $score == (int) $score ? (int) $score : $score;
                                        @endphp
                                        <td class="sticky-course">
                                            <input type="text"
                                                class="form-control dynamic-score-input"
                                                name="scores[{{ $student->id }}][{{ $course->id }}]"
                                                value="{{ old('scores.'.$student->id.'.'.$course->id, $formattedScore) }}"
                                                maxlength="4" inputmode="numeric" autocomplete="off"
                                                aria-label="Score for {{ $student->admission_no }} in {{ $course->course_code }}"
                                                data-student-id="{{ $student->id }}"
                                                data-course-id="{{ $course->id }}"
                                                data-admission-no="{{ $student->admission_no }}"
                                                data-class="{{ $stdLevel }}"
                                                data-semester="{{ $assignedCourse->semester }}"
                                                data-course-title="{{ $course->course_title }}"
                                                data-course-code="{{ $course->course_code }}"
                                                data-course-unit="{{ $course->course_unit }}"
                                                data-course-index="{{ $loop->index + 1 }}">
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @empty
                            <tr><td class="oys-ir-empty" colspan="3">No students found for this assigned course.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="oys-ir-footnote"><i class="fas fa-info-circle" aria-hidden="true"></i><span>Scroll within the table to review records. Admission No, Name and Course Score remain frozen. Green indicates a successful save; red indicates a problem.</span></div>
    </section>
    <p id="instructorScoreFeedback" class="oys-ir-feedback mt-2" role="status" aria-live="polite"></p>
</div>

{{-- Preserve the original print scope: ALL courses, not only the assigned course. --}}
<div id="allStudentsTable" hidden>
    <h3>Score Sheet for {{ $assignedCourse->programme }} - {{ $assignedCourse->level }} Level - {{ $assignedCourse->semester }} Semester</h3>
    <table>
        <thead><tr><th>Admission No</th><th>Name</th>
            @foreach($courses as $course)
                <th>{{ $course->course_title }} ({{ $course->course_code }}) - {{ $course->course_unit }} Unit(s)</th>
            @endforeach
        </tr></thead>
        <tbody>
            @foreach($students as $student)
                <tr><td>{{ $student->admission_no }}</td><td>{{ trim($student->surname . ' ' . $student->first_name . ' ' . $student->other_name) }}</td>
                    @foreach($courses as $course)
                        @php
                            $printScore = $studentScores[$student->admission_no][$course->id] ?? 0;
                            $printScore = (float) $printScore == (int) $printScore ? (int) $printScore : $printScore;
                        @endphp
                        <td>{{ $printScore }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    const root = document.getElementById('instructorResultEntry');
    if (!root) return;
    const grid = root.querySelector('#classListTable');
    const search = root.querySelector('#searchInput');
    const feedback = root.querySelector('#instructorScoreFeedback');
    const csrf = @json(csrf_token());
    const saveUrl = @json(route('save.score'));

    search?.addEventListener('input', () => {
        const query = search.value.trim().toLocaleLowerCase();
        grid.querySelectorAll('tbody tr').forEach(row => {
            row.hidden = !row.textContent.toLocaleLowerCase().includes(query);
            // Some legacy table CSS applies display explicitly; force predictable filtering.
            row.style.display = row.hidden ? 'none' : '';
        });
    });

    function showFeedback(message, isError) {
        feedback.textContent = message;
        feedback.style.color = isError ? '#a52532' : '#23643a';
    }

    grid.querySelectorAll('.dynamic-score-input').forEach(input => {
        let lastSaved = input.value;
        input.addEventListener('input', () => {
            const cleaned = input.value.replace(/\D/g, '').slice(0, 3);
            if (cleaned !== input.value) input.value = cleaned;
            input.classList.remove('is-saved', 'is-error');
        });
        input.addEventListener('change', async () => {
            const scoreText = input.value.trim();
            const score = Number(scoreText);
            if (!/^\d{1,3}$/.test(scoreText) || !Number.isInteger(score) || score < 0 || score > 100) {
                input.classList.add('is-error');
                showFeedback('Please enter a valid whole-number score between 0 and 100.', true);
                input.focus(); return;
            }
            if (input.value === lastSaved) return;
            input.disabled = true;
            input.classList.add('is-saving');
            showFeedback('Saving score…', false);
            try {
                // Preserve every request key and the $course->id lookup used by the original page.
                const payload = {
                    student_id: input.dataset.studentId,
                    course_id: input.dataset.courseId,
                    admission_no: input.dataset.admissionNo,
                    class: input.dataset.class,
                    semester: input.dataset.semester,
                    course_title: input.dataset.courseTitle,
                    course_unit: input.dataset.courseUnit,
                    course_code: input.dataset.courseCode,
                    course_index: input.dataset.courseIndex,
                    score: scoreText
                };
                const response = await fetch(saveUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrf
                    },
                    body: JSON.stringify(payload)
                });
                const type = response.headers.get('content-type') || '';
                if (!type.includes('application/json')) throw new Error('The server did not return JSON.');
                const data = await response.json();
                if (!response.ok || !data.message) throw new Error(data.message || 'Unable to save score.');
                lastSaved = scoreText;
                input.classList.remove('is-error');
                input.classList.add('is-saved');
                showFeedback('Score saved successfully.', false);
            } catch (error) {
                console.error('Score save failed:', error);
                input.classList.add('is-error');
                showFeedback('Score was not saved. Please check your connection and try again.', true);
            } finally {
                input.disabled = false;
                input.classList.remove('is-saving');
            }
        });
    });

    document.getElementById('printInstructorSheet')?.addEventListener('click', () => {
        const source = document.getElementById('allStudentsTable');
        if (!source) return;
        const iframe = document.createElement('iframe');
        iframe.title = 'Print instructor score sheet';
        iframe.style.cssText = 'position:absolute;left:-10000px;top:-10000px;width:1px;height:1px;border:0;';
        document.body.appendChild(iframe);
        const doc = iframe.contentWindow.document;
        doc.open();
        doc.write('<!doctype html><html><head><meta charset="utf-8"><title>Score Sheet</title>' +
            '<style>@page{size:landscape;margin:12mm}body{font-family:Arial,sans-serif;color:#172b1c;margin:16px}h3{font-size:15px}table{width:100%;border-collapse:collapse;font-size:10px}th,td{border:1px solid #789280;padding:6px;text-align:left;vertical-align:top}th{background:#e9f3eb}</style>' +
            '</head><body>' + source.innerHTML + '</body></html>');
        doc.close();
        setTimeout(() => {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
            setTimeout(() => iframe.remove(), 2000);
        }, 200);
    });
})();
</script>
@endpush
