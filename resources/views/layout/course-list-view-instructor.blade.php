@extends('layouts.other-pages')

@section('pageTitle', 'Assigned Courses | OYSCOHEST Result Portal')

@section('content')
<style>
    .oys-assigned-courses { --ac-green: #23643a; --ac-deep: #174a2a; --ac-burgundy: #641510; --ac-gold: #d5aa43; --ac-ink: #27382d; --ac-muted: #728074; --ac-border: #e0e9e2; max-width: 1250px; margin: 0 auto; padding: 0 0 44px; color: var(--ac-ink); }
    .oys-assigned-courses, .oys-assigned-courses * { box-sizing: border-box; }
    .oys-assigned-courses .ac-intro { display: flex; align-items: flex-start; justify-content: space-between; gap: 20px; flex-wrap: wrap; margin-bottom: 24px; }
    .oys-assigned-courses .ac-eyebrow { margin: 0 0 7px; color: var(--ac-green); font-size: 11px; letter-spacing: 1.1px; font-weight: 800; text-transform: uppercase; }
    .oys-assigned-courses .ac-eyebrow::before { content: ''; width: 15px; height: 3px; border-radius: 2px; margin-right: 8px; display: inline-block; vertical-align: middle; background: var(--ac-gold); }
    .oys-assigned-courses h1 { margin: 0 0 8px; font-size: clamp(24px, 2.8vw, 31px); font-weight: 750; line-height: 1.3; color: #23392a; }
    .oys-assigned-courses .ac-subtitle { margin: 0; color: var(--ac-muted); font-size: 13px; line-height: 1.7; }
    .oys-assigned-courses .ac-summary { display: flex; align-items: center; gap: 14px; max-width: 310px; padding: 19px 22px; background: #fff; border: 1px solid var(--ac-border); border-radius: 16px; box-shadow: 0 6px 24px rgba(23, 74, 42, .045); margin-bottom: 21px; }
    .oys-assigned-courses .ac-summary-icon { flex: none; display: grid; place-items: center; width: 53px; height: 53px; background: #eaf5ed; color: var(--ac-green); border-radius: 13px; font-size: 21px; }
    .oys-assigned-courses .ac-summary-label { font-size: 12px; color: var(--ac-muted); font-weight: 600; margin-bottom: 4px; }
    .oys-assigned-courses .ac-summary-number { font-size: 27px; line-height: 1.1; font-weight: 800; color: var(--ac-deep); }
    .oys-assigned-courses .ac-card { border: 1px solid var(--ac-border); border-radius: 17px; background: #fff; overflow: hidden; box-shadow: 0 8px 26px rgba(30, 66, 39, .045); }
    .oys-assigned-courses .ac-card-header { padding: 22px 25px; display: flex; align-items: center; justify-content: space-between; gap: 17px; flex-wrap: wrap; background: linear-gradient(110deg, #fff 40%, #f5faf6); border-bottom: 1px solid #e9eee9; }
    .oys-assigned-courses .ac-card-title { margin: 0 0 5px; font-size: 17px; font-weight: 750; color: var(--ac-ink); }
    .oys-assigned-courses .ac-card-caption { color: var(--ac-muted); font-size: 12px; margin: 0; line-height: 1.6; }
    .oys-assigned-courses .ac-search { position: relative; width: min(100%, 310px); }
    .oys-assigned-courses .ac-search i { position: absolute; top: 50%; left: 14px; transform: translateY(-50%); color: var(--ac-green); pointer-events: none; }
    .oys-assigned-courses input.ac-search-input { width: 100%; height: 43px; padding: 10px 35px 10px 41px; border: 1px solid #dbe6dd; border-radius: 10px; background: #fff; color: var(--ac-ink); font-size: 13px; transition: border-color .15s, box-shadow .15s; }
    .oys-assigned-courses input.ac-search-input:focus { outline: 0; border-color: var(--ac-green); box-shadow: 0 0 0 3px rgba(35, 100, 58, .1); }
    .oys-assigned-courses .ac-clear { position: absolute; right: 9px; top: 50%; transform: translateY(-50%); border: 0; background: transparent; cursor: pointer; color: #657567; padding: 6px; display: none; }
    .oys-assigned-courses .ac-table-wrap { width: 100%; overflow-x: auto; }
    .oys-assigned-courses table.ac-table { width: 100%; border-collapse: collapse; font-size: 12.5px; margin: 0; min-width: 790px; }
    .oys-assigned-courses .ac-table thead { background: #f6f9f6; }
    .oys-assigned-courses .ac-table th { padding: 15px 16px; text-align: left; color: #4c6552; font-size: 11px; font-weight: 800; letter-spacing: .35px; white-space: nowrap; border-bottom: 1px solid var(--ac-border); }
    .oys-assigned-courses .ac-table td { padding: 16px; color: #344437; vertical-align: middle; border-bottom: 1px solid #eef2ee; }
    .oys-assigned-courses .ac-table tbody tr:last-child td { border-bottom: 0; }
    .oys-assigned-courses .ac-table tbody tr:hover { background: #f9fcf9; }
    .oys-assigned-courses .ac-course-title { font-weight: 750; color: #263e2d; line-height: 1.55; min-width: 165px; }
    .oys-assigned-courses .ac-course-code { display: inline-flex; padding: 5px 9px; background: #edf5ef; color: var(--ac-green); border-radius: 6px; font-weight: 750; white-space: nowrap; }
    .oys-assigned-courses .ac-semester { padding: 5px 10px; display: inline-block; color: var(--ac-burgundy); background: #fbefed; border-radius: 20px; font-size: 11px; font-weight: 750; white-space: nowrap; }
    .oys-assigned-courses .ac-count { padding: 14px 25px; font-size: 12px; color: var(--ac-muted); border-top: 1px solid #edf1ee; }
    .oys-assigned-courses .ac-pagination { padding: 13px 25px 19px; border-top: 1px solid #edf1ee; }
    .oys-assigned-courses .ac-pagination:empty { display: none; }
    .oys-assigned-courses .ac-notice { padding: 13px 16px; border-radius: 10px; margin-bottom: 18px; font-size: 13px; }
    .oys-assigned-courses .ac-success { background: #eaf7ee; border: 1px solid #cbe9d3; color: #1c6136; }
    .oys-assigned-courses .ac-error { background: #fff0ef; border: 1px solid #efd1ce; color: #8c2921; }
    .oys-assigned-courses .ac-empty { padding: 44px 24px; text-align: center; }
    .oys-assigned-courses .ac-empty i { display: block; font-size: 29px; color: #90ad98; margin-bottom: 14px; }
    .oys-assigned-courses .ac-empty strong { display: block; font-size: 15px; color: #314a39; margin-bottom: 5px; }
    .oys-assigned-courses .ac-empty p { margin: 0; font-size: 12px; color: var(--ac-muted); }
    .oys-assigned-courses [hidden] { display: none !important; }
    @media (max-width: 700px) { .oys-assigned-courses .ac-card-header { align-items: stretch; padding: 19px; } .oys-assigned-courses .ac-search { width: 100%; } .oys-assigned-courses .ac-summary { max-width: none; } .oys-assigned-courses .ac-pagination, .oys-assigned-courses .ac-count { padding-left: 18px; padding-right: 18px; } }
</style>

<div class="oys-assigned-courses" id="oysAssignedCourses">
    <div class="ac-intro">
        <div>
            <div class="ac-eyebrow">Academic Management</div>
            <h1>Assigned Courses</h1>
            <p class="ac-subtitle">View the courses assigned to you across departments, programmes and academic sessions.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="ac-notice ac-success" role="status">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="ac-notice ac-error" role="alert">{{ session('error') }}</div>
    @endif

    <div class="ac-summary">
        <div class="ac-summary-icon"><i class="fas fa-book-open" aria-hidden="true"></i></div>
        <div>
            <div class="ac-summary-label">Assigned courses on this page</div>
            <div class="ac-summary-number">{{ $assignedCourse->count() }}</div>
        </div>
    </div>

    <div class="ac-card">
        <div class="ac-card-header">
            <div>
                <h2 class="ac-card-title">Your Course Assignments</h2>
                <p class="ac-card-caption">Search by department, programme, course title, code, level or semester.</p>
            </div>
            <div class="ac-search">
                <label for="assignedCourseSearch" class="sr-only">Search assigned courses</label>
                <i class="fas fa-search" aria-hidden="true"></i>
                <input id="assignedCourseSearch" class="ac-search-input" type="search" placeholder="Search assigned courses..." autocomplete="off">
                <button type="button" class="ac-clear" id="assignedCourseClear" aria-label="Clear search"><i class="fas fa-times" aria-hidden="true"></i></button>
            </div>
        </div>

        @if($assignedCourse->count() > 0)
            <div class="ac-table-wrap">
                <table class="ac-table" id="assignedCoursesTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Department</th>
                            <th scope="col">Programme</th>
                            <th scope="col">Course Title</th>
                            <th scope="col">Course Code</th>
                            <th scope="col">Units</th>
                            <th scope="col">Level</th>
                            <th scope="col">Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedCourse as $rd)
                            <tr class="ac-data-row">
                                <td>{{ method_exists($assignedCourse, 'firstItem') && $assignedCourse->firstItem() !== null ? $assignedCourse->firstItem() + $loop->index : $loop->iteration }}</td>
                                <td>{{ $rd->department }}</td>
                                <td>{{ $rd->programme }}</td>
                                <td><span class="ac-course-title">{{ $rd->course_title }}</span></td>
                                <td><span class="ac-course-code">{{ $rd->course_code }}</span></td>
                                <td>{{ $rd->course_unit }}</td>
                                <td>{{ $rd->level }}</td>
                                <td><span class="ac-semester">{{ $rd->semester }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="ac-empty" id="assignedCoursesNoMatch" hidden>
                <i class="fas fa-search" aria-hidden="true"></i>
                <strong>No matching courses</strong>
                <p>Try another course title, code, programme or department.</p>
            </div>
            <div class="ac-count" id="assignedCoursesCount" aria-live="polite">Showing {{ $assignedCourse->count() }} course(s) on this page</div>
        @else
            <div class="ac-empty">
                <i class="fas fa-book-open" aria-hidden="true"></i>
                <strong>No assigned courses yet</strong>
                <p>You have not been assigned any courses. Please contact your department.</p>
            </div>
        @endif

        @if(method_exists($assignedCourse, 'links'))
            <div class="ac-pagination">{{ $assignedCourse->links() }}</div>
        @endif
    </div>
</div>

<script>
(function () {
    'use strict';
    function initialiseAssignedCourseSearch() {
        const root = document.getElementById('oysAssignedCourses');
        if (!root || root.dataset.searchReady === '1') return;
        root.dataset.searchReady = '1';
        const input = root.querySelector('#assignedCourseSearch');
        const clear = root.querySelector('#assignedCourseClear');
        const rows = Array.from(root.querySelectorAll('#assignedCoursesTable tbody tr.ac-data-row'));
        const empty = root.querySelector('#assignedCoursesNoMatch');
        const count = root.querySelector('#assignedCoursesCount');
        if (!input) return;
        function filter() {
            const query = input.value.trim().toLocaleLowerCase();
            let visible = 0;
            rows.forEach(function (row) {
                const text = row.textContent.toLocaleLowerCase();
                const match = !query || text.includes(query);
                row.hidden = !match;
                if (match) visible++;
            });
            if (empty) empty.hidden = visible !== 0;
            if (count) count.textContent = 'Showing ' + visible + ' of ' + rows.length + ' course(s) on this page';
            if (clear) clear.style.display = query ? 'block' : 'none';
        }
        input.addEventListener('input', filter);
        if (clear) clear.addEventListener('click', function () { input.value = ''; filter(); input.focus(); });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialiseAssignedCourseSearch);
    } else {
        initialiseAssignedCourseSearch();
    }
})();
</script>
@endsection
