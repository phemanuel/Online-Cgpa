@extends('layouts.other-pages')

@section('pageTitle', 'Semester Result Report | OYSCOHEST Result Portal')

@section('content')
@php
    $programmeName = $programme;
    $level = $stdLevel;
    $reportSemester = ucfirst(strtolower($semester));
    $isSecondSemester = strcasecmp((string) $semester, 'SECOND') === 0;

    // Preserve the classifications used by the existing report.
    $gpaRemark = function ($gpa) {
        if (!is_numeric($gpa)) return '';
        if ($gpa >= 3.5) return 'Distinction';
        if ($gpa >= 3.0) return 'Upper Credit';
        if ($gpa >= 2.5) return 'Lower Credit';
        if ($gpa >= 2.0) return 'Pass';
        return 'Fail';
    };
    $gpaClass = function ($gpa) {
        if (!is_numeric($gpa)) return 'sr-grade-neutral';
        if ($gpa >= 3.5) return 'sr-grade-distinction';
        if ($gpa >= 3.0) return 'sr-grade-upper';
        if ($gpa >= 2.5) return 'sr-grade-lower';
        if ($gpa >= 2.0) return 'sr-grade-pass';
        return 'sr-grade-fail';
    };
    $formatGpa = function ($value) {
        if (!is_numeric($value)) return '-';
        return fmod((float) $value, 1.0) == 0.0 ? (string) (int) $value : (string) $value;
    };
    $summary = ['failed_courses_students' => 0, 'distinction' => 0, 'upper_credit' => 0, 'lower_credit' => 0, 'pass' => 0, 'fail' => 0];
    foreach ($results as $student) {
        $classification = $gpaRemark($isSecondSemester ? $student->cgpa : $student->gpa);
        $summaryKey = strtolower(str_replace(' ', '_', $classification));
        if (array_key_exists($summaryKey, $summary)) $summary[$summaryKey]++;
        if (!empty($student->failed_course) && $student->failed_course >= 1) $summary['failed_courses_students']++;
    }

    // Preserve original course-column discovery: only include a title when a nonzero score exists.
    $ctitleKeys = [];
    $seen = [];
    foreach ($results as $student) {
        for ($i = 1; $i <= 17; $i++) {
            $titleKey = "ctitle{$i}";
            $scoreKey = "score{$i}";
            $title = trim((string) ($student->$titleKey ?? ''));
            $score = $student->$scoreKey ?? null;
            if ($title === '' || $title === '0') continue;
            if ($score === null || $score === '' || (is_numeric($score) && $score == 0)) continue;
            $normalized = strtoupper($title);
            if (!isset($seen[$normalized])) {
                $seen[$normalized] = true;
                $ctitleKeys[] = $titleKey;
            }
        }
    }
    $courseHeadings = [];
    foreach ($ctitleKeys as $key) {
        $courseHeadings[$key] = collect($results)->pluck($key)->first(fn ($value) => !empty($value) && $value != 0);
    }
    $reportFilename = $programme . '-' . $stdLevel . '-' . str_replace('/', '-', $acadsession) . '-' . $semester . '-' . date('Y-m-d') . '.csv';
@endphp

<style>
    .sr-report{--green:#23643a;--deep:#174a2a;--brown:#641510;--gold:#d5aa43;--border:#e0e9e2;--muted:#69786e;color:#2b3a30;min-width:0;padding-bottom:36px}
    .sr-report *{box-sizing:border-box}
    .sr-report .sr-eyebrow{font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:1.15px;color:var(--green);margin-bottom:9px}
    .sr-report .sr-eyebrow:before{content:"";display:inline-block;width:20px;height:3px;background:var(--gold);border-radius:4px;margin-right:9px;vertical-align:middle}
    .sr-report .sr-page-heading{margin-bottom:20px}
    .sr-report h1{font-size:clamp(23px,2.8vw,29px);line-height:1.25;font-weight:800;color:#26392c;margin:0 0 7px}
    .sr-report .sr-subtitle{color:var(--muted);font-size:13px;line-height:1.7;margin:0}
    .sr-report .sr-toolbar{background:#fff;border:1px solid var(--border);border-radius:14px;padding:16px;display:flex;justify-content:space-between;gap:15px;align-items:center;flex-wrap:wrap;box-shadow:0 6px 22px rgba(15,61,31,.04);margin-bottom:18px}
    .sr-report .sr-actions{display:flex;align-items:center;gap:9px;flex-wrap:wrap}
    .sr-report .sr-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;font-size:12px;font-weight:750;text-decoration:none!important;line-height:1.3;padding:11px 14px;border-radius:9px;border:1px solid transparent;cursor:pointer;white-space:nowrap;transition:background-color .15s,color .15s}
    .sr-report .sr-btn-primary{background:var(--green);color:#fff!important}.sr-report .sr-btn-primary:hover{background:var(--deep)}
    .sr-report .sr-btn-secondary{background:#f5f9f5;color:var(--deep)!important;border-color:#d7e6da}.sr-report .sr-btn-secondary:hover{background:#eaf3eb}
    .sr-report .sr-btn-outline{background:#fff;color:var(--brown)!important;border-color:#e6d5d1}.sr-report .sr-btn-outline:hover{background:#fbf3f1}
    .sr-report .sr-btn:focus-visible{outline:3px solid rgba(35,100,58,.25);outline-offset:2px}
    .sr-report .sr-search{display:flex;align-items:center;gap:10px;min-height:42px;border:1px solid #dce6de;border-radius:9px;padding:0 12px;color:#718074;min-width:min(100%,250px)}
    .sr-report .sr-search input{border:none!important;outline:none!important;background:transparent!important;box-shadow:none!important;width:100%;min-width:0;font-size:12px;color:#273c2d;padding:9px 0}
    .sr-report .sr-panel{background:#fff;border:1px solid var(--border);border-radius:15px;overflow:hidden;box-shadow:0 6px 24px rgba(17,62,34,.04)}
    .sr-report .sr-panel-heading{padding:18px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap}
    .sr-report .sr-panel-heading h2{margin:0;font-size:16px;font-weight:800;color:#29402e}
    .sr-report .sr-count{font-size:12px;padding:7px 11px;background:#eaf5ec;border-radius:30px;font-weight:750;color:var(--deep)}
    .sr-report .sr-scroll{width:100%;max-width:100%;overflow:auto;-webkit-overflow-scrolling:touch;max-height:75vh}
    .sr-report .sr-print-area{min-width:0;padding:20px}
    .sr-report .sr-report-heading{text-align:center;margin:0 0 18px;color:#233829}
    .sr-report .sr-report-logo{height:55px;width:55px;object-fit:contain;display:block;margin:0 auto 9px}
    .sr-report .sr-report-heading h3{font-size:17px;font-weight:800;line-height:1.4;margin:0 0 4px}
    .sr-report .sr-report-heading p{font-size:11px;color:var(--muted);margin:0 0 7px}
    .sr-report .sr-report-heading h4{font-size:13px;color:var(--brown);font-weight:800;letter-spacing:.6px;margin:0}
    .sr-report .sr-table{width:max-content;min-width:100%;border-collapse:separate;border-spacing:0;font-size:12px;color:#324337}
    .sr-report .sr-table th,.sr-report .sr-table td{border-right:1px solid #e6ede7;border-bottom:1px solid #e6ede7;padding:11px 12px;white-space:nowrap;vertical-align:middle;text-align:center}
    .sr-report .sr-table th:first-child,.sr-report .sr-table td:first-child{border-left:1px solid #e6ede7}
    .sr-report .sr-table thead th{background:#eff6f0;font-weight:800;color:#294b33}
    .sr-report .sr-table thead tr:first-child th{border-top:1px solid #e6ede7}
    .sr-report .sr-table tbody tr:nth-child(even){background:#fbfdfb}
    .sr-report .sr-table .sr-name{text-align:left;min-width:200px;font-weight:700}
    .sr-report .sr-table .sr-id{font-weight:700;color:var(--green)}
    .sr-report .sr-table .sr-failed{color:#ba262e;font-weight:800}
    .sr-report .sr-grade{display:inline-block;border-radius:7px;padding:6px 9px;font-weight:800;font-size:11px}
    .sr-report .sr-grade-distinction{background:#e1f5e6;color:#14622d}.sr-report .sr-grade-upper{background:#e5efff;color:#275a9a}
    .sr-report .sr-grade-lower{background:#e6f3f5;color:#236d75}.sr-report .sr-grade-pass{background:#fff3da;color:#805c13}
    .sr-report .sr-grade-fail{background:#fce9e9;color:#a32d31}.sr-report .sr-grade-neutral{background:#f1f1f1;color:#666}
    .sr-report .sr-empty{padding:45px 20px;text-align:center;color:var(--muted)}
    .sr-report .sr-empty i{color:#b8ccb9;font-size:25px;margin-bottom:12px;display:block}
    .sr-report .sr-alert{border-radius:10px;margin-bottom:16px;padding:12px 15px;font-size:13px}.sr-report .sr-alert-success{background:#ebf8ee;color:#205f36}.sr-report .sr-alert-error{background:#fff0f0;color:#9b2929}
    .sr-report .sr-summary-backdrop{position:fixed;inset:0;background:rgba(12,30,18,.55);z-index:9997}
    .sr-report .sr-summary-dialog{position:fixed;inset:0;display:flex;align-items:center;justify-content:center;padding:16px;z-index:9998}
    .sr-report .sr-summary-card{background:#fff;width:min(100%,730px);max-height:min(90vh,860px);overflow:auto;border-radius:16px;box-shadow:0 22px 60px rgba(0,0,0,.2)}
    .sr-report .sr-summary-top{display:flex;justify-content:space-between;gap:12px;padding:20px 23px;border-bottom:1px solid var(--border);align-items:center}
    .sr-report .sr-summary-top h2{font-size:17px;margin:0;font-weight:800}.sr-report .sr-close{background:#f0f5f1;border:0;border-radius:8px;width:34px;height:34px;color:#365642;cursor:pointer}
    .sr-report .sr-summary-body{padding:23px}.sr-report .sr-summary-heading{text-align:center;margin-bottom:20px}.sr-report .sr-summary-heading h3{font-size:16px;margin:0 0 6px;color:#293b2f}.sr-report .sr-summary-heading h4{font-size:13px;font-weight:800;color:var(--brown);margin:0 0 10px}
    .sr-report .sr-summary-heading p{font-size:12px;line-height:1.8;margin:0;color:#57685c}.sr-report .sr-summary-table{width:100%;border-collapse:collapse;font-size:13px}.sr-report .sr-summary-table th,.sr-report .sr-summary-table td{padding:11px 13px;border:1px solid #e1e9e3;text-align:left}.sr-report .sr-summary-table th{background:#f6faf6;width:72%;font-weight:700}.sr-report .sr-summary-table td{font-weight:750;color:var(--green)}
    .sr-report .sr-summary-footer{display:flex;gap:10px;justify-content:flex-end;flex-wrap:wrap;padding:16px 23px;border-top:1px solid var(--border)}
    .sr-report [hidden]{display:none!important}
    @media(max-width:700px){.sr-report .sr-toolbar{align-items:stretch}.sr-report .sr-actions{width:100%}.sr-report .sr-btn{flex:1}.sr-report .sr-search{width:100%}.sr-report .sr-print-area{padding:12px}.sr-report .sr-panel-heading{padding:16px}.sr-report .sr-summary-body{padding:15px}}
</style>

<div class="sr-report" id="semesterResultReport">
    <div class="sr-page-heading">
        <div class="sr-eyebrow">Academic Records</div>
        <h1>Semester Result Report</h1>
        <p class="sr-subtitle">{{ $programmeName }} · {{ $acadsession }} · {{ $level }} Level · {{ $reportSemester }} Semester</p>
    </div>

    @if(session('success'))<div class="sr-alert sr-alert-success" role="status">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="sr-alert sr-alert-error" role="alert">{{ session('error') }}</div>@endif

    <div class="sr-toolbar">
        <div class="sr-actions">
            <a class="sr-btn sr-btn-secondary" href="{{ route('semester-result') }}"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back</a>
            @if($results->count())
                <button class="sr-btn sr-btn-primary" id="srExportCSV" type="button"><i class="fas fa-file-csv" aria-hidden="true"></i> Export CSV</button>
                <button class="sr-btn sr-btn-secondary" id="srPrintReport" type="button"><i class="fas fa-print" aria-hidden="true"></i> Print Report</button>
                <button class="sr-btn sr-btn-outline" id="srOpenSummary" type="button"><i class="fas fa-chart-bar" aria-hidden="true"></i> Summary Report</button>
            @endif
        </div>
        @if($results->count())
            <label class="sr-search" for="srSearch"><i class="fas fa-search" aria-hidden="true"></i><input type="search" id="srSearch" placeholder="Search name or matric no" autocomplete="off"></label>
        @endif
    </div>

    <section class="sr-panel" aria-labelledby="srReportLabel">
        <div class="sr-panel-heading"><h2 id="srReportLabel">Semester Results</h2><span class="sr-count" id="srVisibleCount">{{ $results->count() }} Students</span></div>
        @if($results->count())
            <div class="sr-scroll" tabindex="0" aria-label="Scrollable semester results table">
                <div class="sr-print-area" id="srPrintArea">
                    <div class="sr-report-heading" id="srReportHeading">
                        <img class="sr-report-logo" src="{{ asset('dashboard/assets/img/logo.png') }}" alt="College logo">
                        <h3>Oyo State College of Health, Science and Technology</h3>
                        <p>Eleyele, Ibadan, Oyo State</p>
                        <h4>SEMESTER RESULT REPORT</h4>
                    </div>
                    <table class="sr-table" id="srResultTable">
                        <thead>
                            <tr><th colspan="{{ 6 + count($ctitleKeys) + ($isSecondSemester ? 3 : 0) }}">{{ $programmeName }} - {{ $acadsession }} - {{ $level }} Level - {{ $reportSemester }} Semester Report</th></tr>
                            <tr>
                                <th>#</th><th>Admission No</th><th>Full Name</th>
                                @foreach($ctitleKeys as $key)<th>{{ $courseHeadings[$key] }}</th>@endforeach
                                <th>GPA</th><th>Remark</th><th>Failed Course</th>
                                @if($isSecondSemester)<th>GPA(First)</th><th>CGPA</th><th>Remark</th>@endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $index => $result)
                                @php $gpa = $result->gpa; $cgpa = $result->cgpa; @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="sr-id">{{ $result->admission_no }}</td>
                                    <td class="sr-name">{{ $result->student_full_name }}</td>
                                    @foreach($ctitleKeys as $key)
                                        @php
                                            $indexNum = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
                                            $score = $result->{"score{$indexNum}"} ?? '';
                                            $formattedScore = is_numeric($score) ? rtrim(rtrim(number_format($score, 2, '.', ''), '0'), '.') : $score;
                                            $isFailed = is_numeric($score) && $score < 40;
                                        @endphp
                                        <td class="{{ $isFailed ? 'sr-failed' : '' }}">{{ $formattedScore }}</td>
                                    @endforeach
                                    <td><span class="sr-grade {{ $gpaClass($gpa) }}">{{ $formatGpa($gpa) }}</span></td>
                                    <td>{{ $isSecondSemester ? $gpaRemark($cgpa) : $gpaRemark($gpa) }}</td>
                                    <td>{{ $result->failed_course }}</td>
                                    @if($isSecondSemester)
                                        <td>{{ $result->gpa1 }}</td>
                                        <td><span class="sr-grade {{ $gpaClass($cgpa) }}">{{ $formatGpa($cgpa) }}</span></td>
                                        <td>{{ $gpaRemark($cgpa) }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="sr-empty"><i class="fas fa-file-alt" aria-hidden="true"></i>No results found for the selected parameters.</div>
        @endif
    </section>

    @if($results->count())
        <div id="srSummaryLayer" hidden>
            <div class="sr-summary-backdrop" id="srSummaryBackdrop"></div>
            <div class="sr-summary-dialog" role="dialog" aria-modal="true" aria-labelledby="srSummaryTitle">
                <div class="sr-summary-card">
                    <div class="sr-summary-top"><h2 id="srSummaryTitle">Result Summary Report</h2><button type="button" class="sr-close" id="srCloseSummary" aria-label="Close summary"><i class="fas fa-times" aria-hidden="true"></i></button></div>
                    <div class="sr-summary-body" id="srSummaryPrintArea">
                        <div class="sr-summary-heading">
                            <h3>Oyo State College of Health, Science and Technology, Eleyele, Ibadan.</h3>
                            <h4>RESULT SUMMARY REPORT</h4>
                            <p><strong>Programme:</strong> {{ $programmeName }}<br><strong>Academic Session:</strong> {{ $acadsession }}<br><strong>Level:</strong> {{ $level }} Level<br><strong>Semester:</strong> {{ $reportSemester }}</p>
                        </div>
                        <table class="sr-summary-table"><tbody>
                            <tr><th>Total Students</th><td>{{ $results->count() }}</td></tr>
                            <tr><th>Distinction</th><td>{{ $summary['distinction'] }}</td></tr>
                            <tr><th>Upper Credit</th><td>{{ $summary['upper_credit'] }}</td></tr>
                            <tr><th>Lower Credit</th><td>{{ $summary['lower_credit'] }}</td></tr>
                            <tr><th>Pass</th><td>{{ $summary['pass'] }}</td></tr>
                            <tr><th>Fail</th><td>{{ $summary['fail'] }}</td></tr>
                            <tr><th>Students with Failed Courses</th><td>{{ $summary['failed_courses_students'] }}</td></tr>
                        </tbody></table>
                    </div>
                    <div class="sr-summary-footer"><button type="button" class="sr-btn sr-btn-secondary" id="srDismissSummary">Close</button><button type="button" class="sr-btn sr-btn-primary" id="srPrintSummary"><i class="fas fa-print" aria-hidden="true"></i> Print Summary</button></div>
                </div>
            </div>
        </div>
    @endif
</div>

@if($results->count())
<script>
(function () {
    'use strict';
    const root = document.getElementById('semesterResultReport');
    if (!root) return;
    const table = document.getElementById('srResultTable');
    const search = document.getElementById('srSearch');
    const count = document.getElementById('srVisibleCount');
    const filename = @json($reportFilename);
    const printTitle = @json($programmeName . ' - ' . $acadsession . ' - ' . $level . ' Level - ' . $reportSemester . ' Semester');

    search?.addEventListener('input', function () {
        const term = this.value.trim().toLocaleLowerCase();
        let visible = 0;
        table.querySelectorAll('tbody tr').forEach(function (row) {
            const admission = row.cells[1]?.textContent?.toLocaleLowerCase() || '';
            const name = row.cells[2]?.textContent?.toLocaleLowerCase() || '';
            const show = admission.includes(term) || name.includes(term);
            row.hidden = !show;
            if (show) visible++;
        });
        count.textContent = visible + ' Students';
    });

    function csvCell(value) {
        let data = String(value ?? '').trim();
        // Protect spreadsheet users from formula injection in exported student data.
        if (/^[\s]*[=+@\-]/.test(data) && !/^\s*-?\d+(?:\.\d+)?\s*$/.test(data)) data = "'" + data;
        return '"' + data.replace(/"/g, '""') + '"';
    }

    document.getElementById('srExportCSV')?.addEventListener('click', function () {
        const csv = [['Semester Result Report'], [printTitle], []];
        const headingRow = table.tHead.rows[1];
        csv.push(Array.from(headingRow.cells, cell => cell.innerText.trim()));
        // Export the complete report, regardless of the on-screen search filter.
        table.querySelectorAll('tbody tr').forEach(function (row) {
            csv.push(Array.from(row.cells, cell => cell.innerText.trim()));
        });
        const content = '\uFEFF' + csv.map(row => row.map(csvCell).join(',')).join('\r\n');
        const url = URL.createObjectURL(new Blob([content], { type: 'text/csv;charset=utf-8;' }));
        const link = document.createElement('a');
        link.href = url; link.download = filename; document.body.appendChild(link); link.click(); link.remove();
        setTimeout(() => URL.revokeObjectURL(url), 1000);
    });

    function printElement(elementId, title) {
        const element = document.getElementById(elementId);
        if (!element) return;
        const frame = document.createElement('iframe');
        frame.setAttribute('aria-hidden', 'true');
        frame.style.cssText = 'position:fixed;right:0;bottom:0;width:0;height:0;border:0;';
        document.body.appendChild(frame);
        const doc = frame.contentDocument;
        const clone = element.cloneNode(true);
        // Always print all rows even if the user searched the on-screen report.
        clone.querySelectorAll('[hidden]').forEach(item => item.removeAttribute('hidden'));
        const base = document.createElement('base');
        base.href = document.baseURI;
        doc.open();
        doc.write('<!doctype html><html><head><meta charset="utf-8"><title>' + title.replace(/[&<>"']/g, '') + '</title><style>' +
          '@page{size:landscape;margin:10mm}body{font-family:Arial,sans-serif;color:#111;margin:0}' +
          'h3,h4,p{text-align:center;margin:6px 0}.sr-report-logo{width:55px;height:55px;object-fit:contain;display:block;margin:0 auto 8px}' +
          'table{width:100%;border-collapse:collapse;font-size:9px;margin-top:14px}th,td{border:1px solid #444;padding:5px;text-align:center;vertical-align:middle}' +
          'th{background:#e8f1e9}.sr-name{text-align:left}tr{break-inside:avoid}.sr-summary-table{font-size:12px}.sr-summary-table th{text-align:left}' +
          '</style></head><body>' + clone.outerHTML + '</body></html>');
        doc.close();
        const logo = doc.querySelector('img');
        const trigger = function () {
            frame.contentWindow.focus();
            frame.contentWindow.print();
            setTimeout(() => frame.remove(), 3000);
        };
        if (logo && !logo.complete) { logo.addEventListener('load', trigger, { once:true }); logo.addEventListener('error', trigger, { once:true }); }
        else setTimeout(trigger, 100);
    }

    document.getElementById('srPrintReport')?.addEventListener('click', () => printElement('srPrintArea', 'Semester Result Report'));
    document.getElementById('srPrintSummary')?.addEventListener('click', () => printElement('srSummaryPrintArea', 'Result Summary Report'));

    const layer = document.getElementById('srSummaryLayer');
    const openButton = document.getElementById('srOpenSummary');
    let previousFocus = null;
    function closeSummary() {
        layer.hidden = true;
        document.body.style.overflow = '';
        (previousFocus || openButton)?.focus();
    }
    openButton?.addEventListener('click', function () {
        previousFocus = document.activeElement;
        layer.hidden = false;
        document.body.style.overflow = 'hidden';
        document.getElementById('srCloseSummary').focus();
    });
    ['srCloseSummary','srDismissSummary','srSummaryBackdrop'].forEach(id => document.getElementById(id)?.addEventListener('click', closeSummary));
    document.addEventListener('keydown', function (event) {
        if (!layer.hidden && event.key === 'Escape') closeSummary();
        if (!layer.hidden && event.key === 'Tab') {
            const controls = Array.from(layer.querySelectorAll('button:not([disabled])'));
            if (!controls.length) return;
            if (event.shiftKey && document.activeElement === controls[0]) {event.preventDefault();controls[controls.length - 1].focus();}
            else if (!event.shiftKey && document.activeElement === controls[controls.length - 1]) {event.preventDefault();controls[0].focus();}
        }
    });
})();
</script>
@endif
@endsection
