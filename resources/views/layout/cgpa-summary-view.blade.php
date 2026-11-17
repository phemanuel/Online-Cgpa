@extends('layouts.other-pages')

@section('pageTitle', 'CGPA Summary Report | OYSCOHEST Result Portal')
@section('heading', 'CGPA Summary Report')
@section('subtitle', 'Cumulative academic performance across all available levels and semesters.')

@section('content')
@php
    $hasCgpaData = !empty($cgpaData) && count($cgpaData) > 0;
    $reportFilename = $programme . '-' . str_replace('/', '-', $acadsession) . '-' . date('Y-m-d') . '.csv';
    $totalColumns = 7 + (count($levels) * 3);
    $cgpaDetails = function ($cgpa) {
        if (!is_numeric($cgpa)) return ['-', '', 'cg-neutral'];
        $value = (float) $cgpa;
        if ($value >= 3.5) return [number_format($value, 2), 'Distinction', 'cg-distinction'];
        if ($value >= 3.0) return [number_format($value, 2), 'Upper Credit', 'cg-upper'];
        if ($value >= 2.5) return [number_format($value, 2), 'Lower Credit', 'cg-lower'];
        if ($value >= 2.0) return [number_format($value, 2), 'Pass', 'cg-pass'];
        return [number_format($value, 2), 'Fail', 'cg-fail'];
    };
@endphp
<style>
    .oys-cgpa-report{--cg-green:#23643A;--cg-dark:#174A2A;--cg-burgundy:#641510;--cg-gold:#D5AA43;--cg-border:#e1e9e3;--cg-muted:#6b7b70;display:flow-root;width:100%;min-width:0;padding-bottom:44px;color:#273a2e}
    .oys-cgpa-report,.oys-cgpa-report *{box-sizing:border-box}
    .oys-cgpa-report .cg-eyebrow{color:var(--cg-green);text-transform:uppercase;letter-spacing:1.1px;font-size:11px;font-weight:800;margin-bottom:8px}
    .oys-cgpa-report .cg-eyebrow:before{content:"";display:inline-block;width:18px;height:3px;background:var(--cg-gold);border-radius:3px;vertical-align:middle;margin-right:9px}
    .oys-cgpa-report h1{color:#273a2c;font-size:clamp(24px,2.8vw,30px);font-weight:800;line-height:1.3;margin:0 0 8px}
    .oys-cgpa-report .cg-intro{font-size:13px;color:var(--cg-muted);line-height:1.7;margin:0 0 21px}
    .oys-cgpa-report .cg-toolbar{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:14px;padding:16px;background:#fff;border:1px solid var(--cg-border);border-radius:14px;margin-bottom:19px;box-shadow:0 7px 22px rgba(15,65,34,.04)}
    .oys-cgpa-report .cg-actions{display:flex;gap:9px;flex-wrap:wrap}
    .oys-cgpa-report .cg-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:11px 14px;min-height:41px;font-size:12px;font-weight:750;border-radius:9px;border:1px solid transparent;cursor:pointer;white-space:nowrap;text-decoration:none!important}
    .oys-cgpa-report .cg-btn-back{background:#f4f8f5;border-color:#d9e6dc;color:var(--cg-dark)!important}.oys-cgpa-report .cg-btn-back:hover{background:#eaf2ec}
    .oys-cgpa-report .cg-btn-export{background:var(--cg-green);color:white!important}.oys-cgpa-report .cg-btn-export:hover{background:var(--cg-dark)}
    .oys-cgpa-report .cg-btn-print{border-color:#e9d8d4;color:var(--cg-burgundy)!important;background:#fff}.oys-cgpa-report .cg-btn-print:hover{background:#fcf3f1}
    .oys-cgpa-report .cg-search{display:flex;align-items:center;gap:10px;border:1px solid #dce6df;border-radius:9px;padding:0 12px;min-height:43px;min-width:min(100%,265px);color:#7b897e}
    .oys-cgpa-report .cg-search input{width:100%;min-width:0;padding:10px 0;border:0!important;outline:0!important;box-shadow:none!important;background:transparent!important;font-size:12px}
    .oys-cgpa-report .cg-panel{min-width:0;border:1px solid var(--cg-border);border-radius:15px;background:#fff;box-shadow:0 6px 25px rgba(20,60,35,.04);overflow:hidden}
    .oys-cgpa-report .cg-panel-head{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;padding:18px 20px;border-bottom:1px solid var(--cg-border)}
    .oys-cgpa-report .cg-panel-head h2{font-size:16px;font-weight:800;color:#29442f;margin:0}
    .oys-cgpa-report .cg-count{font-size:12px;font-weight:750;color:var(--cg-dark);border-radius:25px;background:#eaf5ed;padding:7px 11px}
    .oys-cgpa-report .cg-scroll{max-height:75vh;width:100%;overflow:auto;overscroll-behavior:contain;-webkit-overflow-scrolling:touch}
    .oys-cgpa-report .cg-print-area{padding:20px;min-width:0}
    .oys-cgpa-report .report-header{text-align:center;margin-bottom:17px;color:#213e29}
    .oys-cgpa-report .report-logo{display:block;margin:0 auto 9px;width:56px;height:56px;object-fit:contain}
    .oys-cgpa-report .report-header h3{font-size:17px;font-weight:800;line-height:1.45;margin:0 0 4px}
    .oys-cgpa-report .report-header p{font-size:11px;color:var(--cg-muted);margin:0 0 7px}
    .oys-cgpa-report .report-header h4{font-size:13px;font-weight:800;letter-spacing:.5px;color:var(--cg-burgundy);margin:0}
    .oys-cgpa-report .cg-table{border-collapse:separate;border-spacing:0;width:max-content;min-width:100%;font-size:12px;color:#304134}
    .oys-cgpa-report .cg-table th,.oys-cgpa-report .cg-table td{padding:12px 13px;text-align:center;vertical-align:middle;white-space:nowrap;border-right:1px solid #e3ebe5;border-bottom:1px solid #e3ebe5}
    .oys-cgpa-report .cg-table th:first-child,.oys-cgpa-report .cg-table td:first-child{border-left:1px solid #e3ebe5}
    .oys-cgpa-report .cg-table thead th{background:#eff6f0;color:#294a32;font-weight:800;position:sticky;top:0;z-index:2}
    .oys-cgpa-report .cg-table thead tr:first-child th{border-top:1px solid #e3ebe5}
    .oys-cgpa-report .cg-table thead tr:nth-child(2) th{top:41px}
    .oys-cgpa-report .cg-table tbody tr:nth-child(even){background:#fbfdfb}
    .oys-cgpa-report .cg-table .cg-student{text-align:left;min-width:200px;font-weight:700}
    .oys-cgpa-report .cg-table .cg-admission{color:var(--cg-green);font-weight:750}
    .oys-cgpa-report .cg-grade{display:inline-block;padding:6px 9px;border-radius:7px;font-size:11px;font-weight:800}
    .oys-cgpa-report .cg-distinction{background:#e0f5e6;color:#17672f}.oys-cgpa-report .cg-upper{background:#e5efff;color:#275c9d}.oys-cgpa-report .cg-lower{background:#e3f4f6;color:#256e76}.oys-cgpa-report .cg-pass{background:#fff3d9;color:#805d15}.oys-cgpa-report .cg-fail{background:#fbe7e8;color:#a22c34}.oys-cgpa-report .cg-neutral{background:#f2f3f2;color:#66716a}
    .oys-cgpa-report .cg-grading{display:flex;flex-wrap:wrap;align-items:center;gap:11px 18px;padding:17px;border-radius:11px;background:#f9fbfa;border:1px solid var(--cg-border);margin-top:20px;font-size:12px}
    .oys-cgpa-report .cg-grading strong{color:#2c4232}.oys-cgpa-report .cg-grade-item{display:flex;align-items:center;gap:7px}
    .oys-cgpa-report .cg-alert{margin-bottom:17px;padding:13px 15px;border-radius:9px;font-size:13px}.oys-cgpa-report .cg-alert-success{background:#e8f6ed;color:#174a2a}.oys-cgpa-report .cg-alert-error{background:#fff0ef;color:#8c2b2b}
    .oys-cgpa-report .cg-empty{padding:44px 24px;text-align:center;font-size:13px;color:var(--cg-muted)}
    @media(max-width:660px){.oys-cgpa-report .cg-toolbar{align-items:stretch}.oys-cgpa-report .cg-actions,.oys-cgpa-report .cg-search{width:100%}.oys-cgpa-report .cg-btn{flex:1}.oys-cgpa-report .cg-print-area{padding:14px}.oys-cgpa-report .report-header h3{font-size:15px}}
</style>
<div class="oys-cgpa-report">
    <div class="cg-eyebrow">Academic Records / Reports</div>
    <h1>CGPA Summary Report</h1>
    <p class="cg-intro">Review first and second semester GPA, annual CGPA and cumulative performance for every student in the selected admission year.</p>

    @if(session('success')) <div class="cg-alert cg-alert-success" role="status">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="cg-alert cg-alert-error" role="alert">{{ session('error') }}</div> @endif

    <div class="cg-toolbar">
        <div class="cg-actions">
            <a href="{{ route('cgpa-summary') }}" class="cg-btn cg-btn-back"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back to CGPA Summary</a>
            @if($hasCgpaData)
                <button type="button" class="cg-btn cg-btn-export" id="cgExportCsv"><i class="fas fa-file-csv" aria-hidden="true"></i> Export CSV</button>
                <button type="button" class="cg-btn cg-btn-print" id="cgPrintReport"><i class="fas fa-print" aria-hidden="true"></i> Print Report</button>
            @endif
        </div>
        @if($hasCgpaData)
            <label class="cg-search" for="cgSearchInput"><i class="fas fa-search" aria-hidden="true"></i><input type="search" id="cgSearchInput" placeholder="Search by name or admission no" autocomplete="off"></label>
        @endif
    </div>

    <section class="cg-panel" aria-labelledby="cgPanelHeading">
        <div class="cg-panel-head">
            <h2 id="cgPanelHeading">Cumulative Results by Academic Level</h2>
            @if($hasCgpaData)<span class="cg-count" id="cgVisibleCount">{{ count($cgpaData) }} Students</span>@endif
        </div>
        @if($hasCgpaData)
            <div class="cg-scroll">
                <div class="cg-print-area" id="cgPrintArea">
                    <div class="report-header">
                        <img class="report-logo" src="{{ asset('dashboard/assets/img/logo.png') }}" alt="OYSCOHEST logo">
                        <h3>Oyo State College of Health, Science and Technology</h3>
                        <p>Eleyele, Ibadan, Oyo State</p>
                        <h4>CGPA SUMMARY REPORT</h4>
                    </div>
                    <table class="cg-table" id="cgResultTable">
                        <thead>
                            <tr><th colspan="{{ $totalColumns }}">{{ $programme }} - {{ $acadsession }} - CGPA Report</th></tr>
                            <tr>
                                <th>#</th><th>Admission No</th><th>Full Name</th>
                                @foreach($levels as $level)
                                    <th>{{ $level }} (GPA 1st)</th><th>{{ $level }} (GPA 2nd)</th><th>{{ $level }} (CGPA Year)</th>
                                @endforeach
                                <th>Total Grade Points</th><th>Total Course Units</th><th>Final CGPA</th><th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cgpaData as $data)
                                @php
                                    $student = $data['student'];
                                    $yearly = $data['yearly'];
                                    $semesters = collect($data['semesters']);
                                    $totalGP = $data['total_grade_points'] ?? 0;
                                    $totalCU = $data['total_course_units'] ?? 0;
                                    $cgpaInfo = $cgpaDetails($data['final']);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="cg-admission">{{ $student->admission_no }}</td>
                                    <td class="cg-student">{{ $student->student_full_name }}</td>
                                    @foreach($levels as $level)
                                        @php
                                            $firstRow = $semesters->first(fn ($s) => $s['level'] === $level && $s['semester'] === 'First');
                                            $secondRow = $semesters->first(fn ($s) => $s['level'] === $level && $s['semester'] === 'Second');
                                            $first = $firstRow['gpa'] ?? '-';
                                            $second = $secondRow['gpa'] ?? '-';
                                            $year = $yearly[$level] ?? '-';
                                        @endphp
                                        <td>{{ is_numeric($first) ? number_format((float)$first, 2) : '-' }}</td>
                                        <td>{{ is_numeric($second) ? number_format((float)$second, 2) : '-' }}</td>
                                        <td>{{ is_numeric($year) ? number_format((float)$year, 2) : '-' }}</td>
                                    @endforeach
                                    <td>{{ $totalGP }}</td>
                                    <td>{{ $totalCU }}</td>
                                    <td><span class="cg-grade {{ $cgpaInfo[2] }}">{{ $cgpaInfo[0] }}</span></td>
                                    <td>{{ $cgpaInfo[1] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="cg-grading" aria-label="CGPA grading scale">
                        <strong>CGPA Grading Scale:</strong>
                        <span class="cg-grade-item"><span class="cg-grade cg-distinction">3.5–4.0</span> Distinction</span>
                        <span class="cg-grade-item"><span class="cg-grade cg-upper">3.0–3.49</span> Upper Credit</span>
                        <span class="cg-grade-item"><span class="cg-grade cg-lower">2.5–2.9</span> Lower Credit</span>
                        <span class="cg-grade-item"><span class="cg-grade cg-pass">2.0–2.49</span> Pass</span>
                        <span class="cg-grade-item"><span class="cg-grade cg-fail">Below 2.0</span> Fail</span>
                    </div>
                </div>
            </div>
        @else
            <div class="cg-empty"><i class="fas fa-folder-open" aria-hidden="true"></i> No CGPA summary data available for {{ $programme }} ({{ $acadsession }}).</div>
        @endif
    </section>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    const table = document.getElementById('cgResultTable');
    if (!table) return;

    const input = document.getElementById('cgSearchInput');
    const count = document.getElementById('cgVisibleCount');
    const rows = Array.from(table.querySelectorAll('tbody tr'));
    if (input) input.addEventListener('input', function () {
        const term = input.value.trim().toLowerCase();
        let visible = 0;
        rows.forEach(row => {
            const match = row.cells[1].textContent.toLowerCase().includes(term) || row.cells[2].textContent.toLowerCase().includes(term);
            row.hidden = !match;
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        if (count) count.textContent = visible + ' Students';
    });

    const filename = @json($reportFilename);
    document.getElementById('cgExportCsv')?.addEventListener('click', function () {
        const lines = [ ['Oyo State College of Health, Science and Technology'], ['CGPA SUMMARY REPORT'], [@json($programme), @json($acadsession)], [] ];
        table.querySelectorAll('thead tr, tbody tr').forEach(row => {
            const cells = Array.from(row.querySelectorAll('th,td'));
            lines.push(cells.map(cell => cell.textContent.trim().replace(/\s+/g, ' ')));
        });
        const csv = '\uFEFF' + lines.map(columns => columns.map(value => '"' + String(value).replace(/"/g, '""') + '"').join(',')).join('\r\n');
        const url = URL.createObjectURL(new Blob([csv], {type:'text/csv;charset=utf-8;'}));
        const link = document.createElement('a');
        link.href = url;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        link.remove();
        setTimeout(() => URL.revokeObjectURL(url), 1000);
    });

    document.getElementById('cgPrintReport')?.addEventListener('click', function () {
        const content = document.getElementById('cgPrintArea').cloneNode(true);
        content.querySelectorAll('tbody tr').forEach(row => { row.hidden = false; row.style.display = ''; });
        const frame = document.createElement('iframe');
        frame.setAttribute('title', 'Print CGPA Summary Report');
        frame.style.cssText = 'position:fixed;left:-10000px;top:0;width:1px;height:1px;border:0;';
        document.body.appendChild(frame);
        const doc = frame.contentDocument;
        doc.open();
        doc.write('<!doctype html><html><head><meta charset="utf-8"><title>CGPA Summary Report</title><style>' +
            '@page{size:A4 landscape;margin:10mm}body{font:10px Arial,sans-serif;color:#111}' +
            '.report-header{text-align:center;margin:0 0 12px}.report-logo{width:50px;height:50px;object-fit:contain}.report-header h3{font-size:15px;margin:4px}.report-header h4{font-size:13px;margin:6px}.report-header p{margin:3px}' +
            'table{border-collapse:collapse;width:100%;font-size:9px}th,td{border:1px solid #555;padding:5px;text-align:center;white-space:normal}th{background:#e9f0ea}thead{display:table-header-group}tr{break-inside:avoid}' +
            '.cg-student{text-align:left}.cg-grading{margin-top:14px;display:flex;flex-wrap:wrap;gap:8px}.cg-grade-item{margin-right:10px}.cg-grade{font-weight:bold}' +
            '</style></head><body>' + content.innerHTML + '</body></html>');
        doc.close();
        let printed = false;
        const doPrint = function () {
            if (printed || !frame.isConnected) return;
            printed = true;
            frame.contentWindow.focus();
            frame.contentWindow.print();
            setTimeout(() => frame.remove(), 2000);
        };
        frame.onload = doPrint;
        setTimeout(doPrint, 1000);
    });
})();
</script>
@endpush
