@extends('layouts.other-pages')

@section('pageTitle', 'Semester Result Summary Report | OYSCOHEST Result Portal')

@section('content')
@php
    $reportFilename = $programme . '-' . $stdLevel . '-' . str_replace('/', '-', $acadsession) . '-' . date('Y-m-d') . '.csv';
    $cgpaDetails = function ($cgpa) {
        if (!is_numeric($cgpa)) return ['-', '', 'sr-neutral'];
        $number = (float) $cgpa;
        if ($number >= 3.5) return [number_format($number, 2), 'Distinction', 'sr-distinction'];
        if ($number >= 3.0) return [number_format($number, 2), 'Upper Credit', 'sr-upper'];
        if ($number >= 2.5) return [number_format($number, 2), 'Lower Credit', 'sr-lower'];
        if ($number >= 2.0) return [number_format($number, 2), 'Pass', 'sr-pass'];
        return [number_format($number, 2), 'Fail', 'sr-fail'];
    };
@endphp
<style>
    .oys-summary-report{--sr-green:#23643a;--sr-dark:#174a2a;--sr-brown:#641510;--sr-gold:#d5aa43;--sr-border:#e0e9e2;--sr-muted:#69786e;min-width:0;padding-bottom:36px;color:#2b3a30}
    .oys-summary-report *{box-sizing:border-box}
    .oys-summary-report .sr-eyebrow{font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:1.2px;color:var(--sr-green);margin-bottom:9px}
    .oys-summary-report .sr-eyebrow:before{content:"";display:inline-block;width:20px;height:3px;background:var(--sr-gold);border-radius:3px;vertical-align:middle;margin-right:9px}
    .oys-summary-report h1{font-size:clamp(23px,2.8vw,29px);font-weight:800;color:#26392c;margin:0 0 7px}
    .oys-summary-report .sr-subtitle{font-size:13px;color:var(--sr-muted);line-height:1.7;margin:0 0 20px}
    .oys-summary-report .sr-toolbar{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;padding:16px;background:#fff;border:1px solid var(--sr-border);border-radius:14px;margin-bottom:18px;box-shadow:0 6px 22px rgba(15,61,31,.04)}
    .oys-summary-report .sr-actions{display:flex;gap:9px;flex-wrap:wrap}
    .oys-summary-report .sr-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:11px 14px;min-height:40px;font-size:12px;font-weight:750;border-radius:9px;border:1px solid transparent;cursor:pointer;white-space:nowrap;text-decoration:none!important}
    .oys-summary-report .sr-primary{background:var(--sr-green);color:#fff!important}.oys-summary-report .sr-primary:hover{background:var(--sr-dark)}
    .oys-summary-report .sr-secondary{background:#f5f9f5;border-color:#d7e6da;color:var(--sr-dark)!important}.oys-summary-report .sr-secondary:hover{background:#eaf3eb}
    .oys-summary-report .sr-outline{background:#fff;border-color:#e6d5d1;color:var(--sr-brown)!important}.oys-summary-report .sr-outline:hover{background:#fbf3f1}
    .oys-summary-report .sr-search{display:flex;align-items:center;gap:10px;border:1px solid #dce6de;border-radius:9px;padding:0 12px;min-height:42px;min-width:min(100%,255px);color:#718074}
    .oys-summary-report .sr-search input{border:0!important;outline:0!important;box-shadow:none!important;width:100%;min-width:0;font-size:12px;background:transparent!important;padding:10px 0}
    .oys-summary-report .sr-panel{background:#fff;border:1px solid var(--sr-border);border-radius:15px;overflow:hidden;box-shadow:0 6px 24px rgba(17,62,34,.04)}
    .oys-summary-report .sr-panel-header{padding:18px 20px;border-bottom:1px solid var(--sr-border);display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap}
    .oys-summary-report .sr-panel-header h2{font-size:16px;color:#29402e;font-weight:800;margin:0}
    .oys-summary-report .sr-count{font-size:12px;padding:7px 11px;background:#eaf5ec;border-radius:30px;font-weight:750;color:var(--sr-dark)}
    .oys-summary-report .sr-scroll{width:100%;max-height:75vh;overflow:auto;-webkit-overflow-scrolling:touch}
    .oys-summary-report .sr-print-area{padding:20px;min-width:0}
    .oys-summary-report .report-header{text-align:center;color:#233829;margin-bottom:18px}
    .oys-summary-report .report-logo{height:56px;width:56px;object-fit:contain;display:block;margin:0 auto 9px}
    .oys-summary-report .report-header h3{font-size:17px;font-weight:800;line-height:1.4;margin:0 0 4px}
    .oys-summary-report .report-header p{font-size:11px;color:var(--sr-muted);margin:0 0 7px}
    .oys-summary-report .report-header h4{font-size:13px;color:var(--sr-brown);font-weight:800;letter-spacing:.5px;margin:0}
    .oys-summary-report .sr-table{border-collapse:separate;border-spacing:0;width:max-content;min-width:100%;font-size:12px;color:#324337}
    .oys-summary-report .sr-table th,.oys-summary-report .sr-table td{padding:12px 13px;text-align:center;vertical-align:middle;white-space:nowrap;border-right:1px solid #e6ede7;border-bottom:1px solid #e6ede7}
    .oys-summary-report .sr-table th:first-child,.oys-summary-report .sr-table td:first-child{border-left:1px solid #e6ede7}
    .oys-summary-report .sr-table thead th{background:#eff6f0;color:#294b33;font-weight:800}
    .oys-summary-report .sr-table thead tr:first-child th{border-top:1px solid #e6ede7}
    .oys-summary-report .sr-table tbody tr:nth-child(even){background:#fbfdfb}
    .oys-summary-report .sr-table .sr-name{text-align:left;font-weight:700;min-width:210px}
    .oys-summary-report .sr-table .sr-id{color:var(--sr-green);font-weight:700}
    .oys-summary-report .sr-grade{border-radius:7px;padding:6px 9px;font-size:11px;font-weight:800;display:inline-block}
    .oys-summary-report .sr-distinction{background:#e1f5e6;color:#14622d}.oys-summary-report .sr-upper{background:#e5efff;color:#275a9a}.oys-summary-report .sr-lower{background:#e6f3f5;color:#236d75}.oys-summary-report .sr-pass{background:#fff3da;color:#805c13}.oys-summary-report .sr-fail{background:#fce9e9;color:#a32d31}.oys-summary-report .sr-neutral{background:#f1f1f1;color:#666}
    .oys-summary-report .sr-grading{display:flex;align-items:center;flex-wrap:wrap;gap:11px 19px;margin-top:20px;padding:17px;border:1px solid var(--sr-border);border-radius:11px;background:#f9fbf9;font-size:12px}
    .oys-summary-report .sr-grading strong{color:#304733}.oys-summary-report .sr-grade-item{display:flex;align-items:center;gap:7px}
    .oys-summary-report .sr-empty{padding:44px 20px;text-align:center;color:var(--sr-muted)}
    .oys-summary-report .sr-alert{padding:12px 15px;border-radius:10px;margin-bottom:16px;font-size:13px}.oys-summary-report .sr-alert-success{color:#205f36;background:#ebf8ee}.oys-summary-report .sr-alert-error{color:#9b2929;background:#fff0f0}
    @media(max-width:650px){.oys-summary-report .sr-toolbar{align-items:stretch}.oys-summary-report .sr-actions,.oys-summary-report .sr-search{width:100%}.oys-summary-report .sr-btn{flex:1}.oys-summary-report .sr-print-area{padding:14px}.oys-summary-report .report-header h3{font-size:15px}}
</style>
<div class="oys-summary-report">
    <div class="sr-eyebrow">Academic records / Reports</div>
    <h1>Semester Result Summary Report</h1>
    <p class="sr-subtitle">Review students' first-semester GPA, second-semester GPA and cumulative performance for the selected programme.</p>

    @if(session('success')) <div class="sr-alert sr-alert-success" role="status">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="sr-alert sr-alert-error" role="alert">{{ session('error') }}</div> @endif

    <div class="sr-toolbar">
        <div class="sr-actions">
            <a href="{{ route('semester-summary') }}" class="sr-btn sr-secondary"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back to Summary</a>
            @if($results->count())
                <button type="button" id="srExportCsv" class="sr-btn sr-primary"><i class="fas fa-file-csv" aria-hidden="true"></i> Export CSV</button>
                <button type="button" id="srPrintReport" class="sr-btn sr-outline"><i class="fas fa-print" aria-hidden="true"></i> Print Report</button>
            @endif
        </div>
        @if($results->count())
            <label class="sr-search" for="srSearchInput"><i class="fas fa-search" aria-hidden="true"></i><input type="search" id="srSearchInput" placeholder="Search by name or matric no" autocomplete="off"></label>
        @endif
    </div>

    <section class="sr-panel" aria-labelledby="srTableHeading">
        <div class="sr-panel-header"><h2 id="srTableHeading">Cumulative Result Summary</h2><span class="sr-count" id="srVisibleCount">{{ $results->count() }} Students</span></div>
        @if($results->count())
            <div class="sr-scroll">
                <div class="sr-print-area" id="srPrintArea">
                    <div class="report-header">
                        <img src="{{ asset('dashboard/assets/img/logo.png') }}" class="report-logo" alt="OYSCOHEST logo">
                        <h3>Oyo State College of Health, Science and Technology</h3>
                        <p>Eleyele, Ibadan, Oyo State</p>
                        <h4>SEMESTER RESULT SUMMARY REPORT</h4>
                    </div>
                    <table class="sr-table" id="srResultTable">
                        <thead>
                            <tr><th colspan="7">{{ $programme }} - {{ $acadsession }} - {{ $stdLevel }} Level Report</th></tr>
                            <tr>
                                <th scope="col">#</th><th scope="col">Admission No</th><th scope="col">Full Name</th>
                                <th scope="col">GPA (First)</th><th scope="col">GPA (Second)</th><th scope="col">CGPA</th><th scope="col">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $index => $result)
                                @php $cgpaInfo = $cgpaDetails($result->cgpa); @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="sr-id">{{ $result->admission_no }}</td>
                                    <td class="sr-name">{{ $result->student_full_name }}</td>
                                    <td>{{ $result->gpa1 ?? '-' }}</td>
                                    <td>{{ $result->gpa2 ?? '-' }}</td>
                                    <td><span class="sr-grade {{ $cgpaInfo[2] }}">{{ $cgpaInfo[0] }}</span></td>
                                    <td>{{ $cgpaInfo[1] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="sr-grading">
                        <strong>CGPA grading scale</strong>
                        <span class="sr-grade-item"><span class="sr-grade sr-distinction">3.5–4.0</span> Distinction</span>
                        <span class="sr-grade-item"><span class="sr-grade sr-upper">3.0–3.49</span> Upper Credit</span>
                        <span class="sr-grade-item"><span class="sr-grade sr-lower">2.5–2.9</span> Lower Credit</span>
                        <span class="sr-grade-item"><span class="sr-grade sr-pass">2.0–2.49</span> Pass</span>
                        <span class="sr-grade-item"><span class="sr-grade sr-fail">Below 2.0</span> Fail</span>
                    </div>
                </div>
            </div>
        @else
            <div class="sr-empty"><i class="fas fa-info-circle" aria-hidden="true"></i>No results found for the selected parameters.</div>
        @endif
    </section>
</div>
@if($results->count())
<script>
(function () {
    'use strict';
    const table = document.getElementById('srResultTable');
    const search = document.getElementById('srSearchInput');
    const count = document.getElementById('srVisibleCount');
    const filename = @json($reportFilename);
    const reportTitle = @json($programme . ' - ' . $acadsession . ' - ' . $stdLevel . ' Level Report');

    search.addEventListener('input', function () {
        const term = this.value.trim().toLocaleLowerCase();
        let matches = 0;
        table.querySelectorAll('tbody tr').forEach(function (row) {
            const admission = (row.cells[1]?.textContent || '').toLocaleLowerCase();
            const name = (row.cells[2]?.textContent || '').toLocaleLowerCase();
            const visible = admission.includes(term) || name.includes(term);
            row.hidden = !visible;
            if (visible) matches++;
        });
        count.textContent = matches + ' Students';
    });

    const csvCell = value => '"' + String(value).replace(/"/g, '""') + '"';
    document.getElementById('srExportCsv').addEventListener('click', function () {
        const csvRows = [['Semester Result Summary Report'], [reportTitle], [],
            Array.from(table.tHead.rows[1].cells, cell => cell.textContent.trim())];
        // Export every record, including records hidden by the current live search.
        table.querySelectorAll('tbody tr').forEach(row => {
            csvRows.push(Array.from(row.cells, cell => cell.textContent.trim()));
        });
        const csvText = '\uFEFF' + csvRows.map(row => row.map(csvCell).join(',')).join('\r\n');
        const url = URL.createObjectURL(new Blob([csvText], {type:'text/csv;charset=utf-8;'}));
        const link = document.createElement('a');
        link.href = url; link.download = filename;
        document.body.appendChild(link); link.click(); link.remove();
        setTimeout(() => URL.revokeObjectURL(url), 1000);
    });

    document.getElementById('srPrintReport').addEventListener('click', function () {
        const report = document.getElementById('srPrintArea').cloneNode(true);
        report.querySelectorAll('tr[hidden]').forEach(row => row.removeAttribute('hidden'));
        const frame = document.createElement('iframe');
        frame.setAttribute('aria-hidden', 'true');
        frame.style.cssText = 'position:fixed;right:0;bottom:0;width:0;height:0;border:0';
        document.body.appendChild(frame);
        const doc = frame.contentDocument;
        doc.open();
        doc.write('<!doctype html><html><head><meta charset="utf-8"><title>Semester Result Summary Report</title><base href="' + document.baseURI.replace(/"/g, '&quot;') + '"><style>' +
            '@page{size:A4 landscape;margin:10mm}body{font-family:Arial,sans-serif;color:#111;margin:0}' +
            '.report-header{text-align:center;margin-bottom:16px}.report-logo{width:55px;height:55px;object-fit:contain;display:block;margin:0 auto 8px}' +
            'h3{font-size:16px;margin:3px}h4{font-size:12px;margin:7px}p{font-size:11px;margin:4px}' +
            'table{width:100%;border-collapse:collapse;font-size:10px;margin:12px 0}th,td{border:1px solid #555;padding:6px;text-align:center}' +
            'th{background:#eaf3eb}.sr-name{text-align:left}.sr-grading{font-size:10px;margin-top:16px;line-height:2}' +
            '.sr-grade-item{margin-right:12px}.sr-grade{font-weight:bold}tr{break-inside:avoid}' +
            '</style></head><body>' + report.outerHTML + '</body></html>');
        doc.close();
        const image = doc.querySelector('img');
        const doPrint = function () { frame.contentWindow.focus(); frame.contentWindow.print(); setTimeout(() => frame.remove(), 3000); };
        if (image && !image.complete) { image.addEventListener('load', doPrint, {once:true}); image.addEventListener('error', doPrint, {once:true}); }
        else setTimeout(doPrint, 100);
    });
})();
</script>
@endif
@endsection
