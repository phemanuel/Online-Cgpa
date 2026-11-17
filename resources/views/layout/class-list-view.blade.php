@extends('layouts.other-pages')

@section('pageTitle', 'Class List View | OYSCOHEST Result Portal')

@section('content')
@php
    // Preserve the controller-provided collections and selection variables.
    $studentCount = $allStudent->count();
@endphp

<style>
    .oys-class-view {
        --cv-green: #23643a;
        --cv-green-dark: #174a2a;
        --cv-green-soft: #eaf5ed;
        --cv-brown: #641510;
        --cv-gold: #d5aa43;
        --cv-text: #26332b;
        --cv-muted: #718078;
        --cv-border: #e1e9e3;
        max-width: 1300px;
        margin: 0 auto;
        padding-bottom: 30px;
        color: var(--cv-text);
    }
    .oys-class-view *, .oys-class-view *::before, .oys-class-view *::after { box-sizing: border-box; }
    .oys-cv-top { display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 18px; margin-bottom: 24px; }
    .oys-cv-eyebrow { display: flex; align-items: center; gap: 9px; color: var(--cv-green); font-size: 11px; text-transform: uppercase; letter-spacing: 1.2px; font-weight: 700; margin-bottom: 9px; }
    .oys-cv-eyebrow::before { content: ''; width: 20px; height: 3px; border-radius: 4px; background: var(--cv-gold); }
    .oys-cv-title { margin: 0 0 8px; font-size: clamp(23px, 3vw, 29px); letter-spacing: -.6px; font-weight: 700; color: var(--cv-text); }
    .oys-cv-subtitle { margin: 0; color: var(--cv-muted); font-size: 13px; line-height: 1.7; }
    .oys-class-view .oys-cv-back { display: inline-flex; align-items: center; gap: 9px; padding: 11px 16px; color: var(--cv-green); border: 1px solid var(--cv-border); background: #fff; border-radius: 10px; text-decoration: none; font-size: 12px; font-weight: 700; }
    .oys-class-view .oys-cv-back:hover { color: var(--cv-green-dark); background: var(--cv-green-soft); border-color: var(--cv-green); }
    .oys-cv-summary { display: grid; grid-template-columns: minmax(0, 1fr) 220px; gap: 16px; margin-bottom: 22px; }
    .oys-cv-context, .oys-cv-count { border: 1px solid var(--cv-border); background: #fff; border-radius: 15px; padding: 21px 24px; box-shadow: 0 5px 22px rgba(25, 70, 40, .035); }
    .oys-cv-context-label { display: block; color: var(--cv-muted); text-transform: uppercase; letter-spacing: .8px; font-size: 10px; font-weight: 700; margin-bottom: 13px; }
    .oys-cv-tags { display: flex; flex-wrap: wrap; gap: 9px; }
    .oys-cv-tag { display: inline-flex; align-items: center; gap: 8px; padding: 8px 11px; border-radius: 8px; background: #f5f8f5; color: #33503c; font-size: 12px; line-height: 1.5; overflow-wrap: anywhere; }
    .oys-cv-tag i { color: var(--cv-green); }
    .oys-cv-count { display: flex; align-items: center; gap: 15px; }
    .oys-cv-count-icon { width: 48px; height: 48px; flex: 0 0 48px; display: flex; align-items: center; justify-content: center; border-radius: 12px; color: var(--cv-green); background: var(--cv-green-soft); font-size: 22px; }
    .oys-cv-count-number { display: block; font-size: 27px; line-height: 1.2; font-weight: 800; color: var(--cv-green); }
    .oys-cv-count-label { color: var(--cv-muted); font-size: 11px; }
    .oys-cv-card { background: #fff; border: 1px solid var(--cv-border); border-radius: 15px; overflow: hidden; box-shadow: 0 8px 28px rgba(25, 70, 40, .045); }
    .oys-cv-card-header { padding: 23px 24px; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; border-bottom: 1px solid var(--cv-border); background: linear-gradient(110deg, #fff 0%, #f9fcf9 100%); }
    .oys-cv-card-title { margin: 0 0 5px; font-size: 17px; font-weight: 700; color: var(--cv-text); }
    .oys-cv-card-description { margin: 0; color: var(--cv-muted); font-size: 12px; line-height: 1.65; }
    .oys-cv-tools { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
    .oys-cv-search { position: relative; min-width: 230px; }
    .oys-cv-search i { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: #84968a; }
    .oys-cv-search input { width: 100%; height: 43px; padding: 10px 13px 10px 38px; background: #fff; border: 1px solid #d8e2da; color: var(--cv-text); border-radius: 9px; font-size: 12px; outline: none; }
    .oys-cv-search input:focus { border-color: var(--cv-green); box-shadow: 0 0 0 3px rgba(35, 100, 58, .10); }
    .oys-class-view .oys-cv-print { display: inline-flex; align-items: center; justify-content: center; gap: 9px; min-height: 43px; padding: 11px 16px; border: 0; border-radius: 9px; color: #fff; background: var(--cv-green); font-size: 12px; font-weight: 700; cursor: pointer; }
    .oys-class-view .oys-cv-print:hover { background: var(--cv-green-dark); color: #fff; }
    .oys-class-view .oys-cv-print:focus-visible, .oys-class-view .oys-cv-back:focus-visible { outline: 3px solid rgba(35, 100, 58, .3); outline-offset: 3px; }
    .oys-cv-table-scroll { width: 100%; overflow-x: auto; }
    .oys-class-view .oys-cv-table { margin: 0; width: 100%; border-collapse: collapse; min-width: 800px; font-size: 12px; }
    .oys-class-view .oys-cv-table thead th { background: #f5f9f6; color: #44614c; text-transform: uppercase; letter-spacing: .5px; font-size: 10px; font-weight: 800; padding: 15px 17px; border-bottom: 1px solid var(--cv-border); white-space: nowrap; text-align: left; }
    .oys-class-view .oys-cv-table tbody td { padding: 16px 17px; border-bottom: 1px solid #edf1ed; color: #3c4940; vertical-align: middle; }
    .oys-class-view .oys-cv-table tbody tr:hover { background: #fcfefc; }
    .oys-class-view .oys-cv-table tbody tr:last-child td { border-bottom: 0; }
    .oys-cv-student-name { font-weight: 700; color: var(--cv-text); }
    .oys-cv-matric { font-weight: 700; color: var(--cv-brown); white-space: nowrap; }
    .oys-cv-level { display: inline-block; background: var(--cv-green-soft); color: var(--cv-green-dark); padding: 5px 9px; border-radius: 6px; font-size: 11px; font-weight: 700; white-space: nowrap; }
    .oys-cv-empty { padding: 45px 20px !important; text-align: center; color: var(--cv-muted) !important; }
    .oys-cv-empty i { display: block; margin: 0 auto 12px; font-size: 28px; color: #a2b6a8; }
    .oys-cv-card-footer { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 15px 23px; border-top: 1px solid var(--cv-border); background: #fcfdfc; color: var(--cv-muted); font-size: 11px; line-height: 1.6; }
    .oys-cv-card-footer i { color: var(--cv-green); }
    @media (max-width: 860px) { .oys-cv-summary { grid-template-columns: 1fr; } }
    @media (max-width: 600px) {
        .oys-cv-top { margin-bottom: 18px; }
        .oys-cv-context, .oys-cv-count { padding: 18px; }
        .oys-cv-card-header { padding: 19px; }
        .oys-cv-tools, .oys-cv-search, .oys-class-view .oys-cv-print { width: 100%; }
        .oys-cv-card-footer { padding: 14px 18px; flex-direction: column; align-items: flex-start; }
    }
</style>

<div class="oys-class-view">
    <div class="oys-cv-top">
        <div>
            <div class="oys-cv-eyebrow">Academic Management</div>
            <h1 class="oys-cv-title">Class List</h1>
            <p class="oys-cv-subtitle">Review the students matching your selected academic criteria.</p>
        </div>
        <a href="{{ route('class-list') }}" class="oys-cv-back">
            <i class="fas fa-arrow-left" aria-hidden="true"></i> Change Criteria
        </a>
    </div>

    <div class="oys-cv-summary">
        <div class="oys-cv-context">
            <span class="oys-cv-context-label">Selected Class</span>
            <div class="oys-cv-tags">
                <span class="oys-cv-tag"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{ $programme }}</span>
                <span class="oys-cv-tag"><i class="fas fa-layer-group" aria-hidden="true"></i> Level: {{ $studentLevel }}</span>
                <span class="oys-cv-tag"><i class="fas fa-calendar-alt" aria-hidden="true"></i> Admission: {{ $admissionYear }}</span>
            </div>
        </div>
        <div class="oys-cv-count">
            <div class="oys-cv-count-icon"><i class="fas fa-users" aria-hidden="true"></i></div>
            <div><strong class="oys-cv-count-number">{{ number_format($studentCount) }}</strong><span class="oys-cv-count-label">Total Students</span></div>
        </div>
    </div>

    <div class="oys-cv-card">
        <div class="oys-cv-card-header">
            <div>
                <h2 class="oys-cv-card-title">Student Records</h2>
                <p class="oys-cv-card-description">Search the displayed records, or print the complete class list.</p>
            </div>
            <div class="oys-cv-tools">
                <label class="oys-cv-search" for="searchInput">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input id="searchInput" type="search" placeholder="Search name, matric no..." autocomplete="off" aria-label="Search student records">
                </label>
                <button type="button" id="printAllStudentsButton" class="oys-cv-print" onclick="printAllStudents()">
                    <i class="fas fa-print" aria-hidden="true"></i> Print All Students
                </button>
            </div>
        </div>

        <div class="oys-cv-table-scroll">
            <table id="classListTable" class="oys-cv-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Matric No.</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Programme</th>
                        <th scope="col">Level</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $index => $student)
                        <tr class="oys-cv-data-row">
                            <td>{{ $index + 1 }}</td>
                            <td><span class="oys-cv-matric">{{ $student->admission_no }}</span></td>
                            <td><span class="oys-cv-student-name">{{ trim($student->surname . ' ' . $student->first_name . ' ' . $student->other_name) }}</span></td>
                            <td>{{ $student->course }}</td>
                            <td><span class="oys-cv-level">{{ $student->class }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="oys-cv-empty"><i class="fas fa-user-slash" aria-hidden="true"></i>No students found for this selection.</td></tr>
                    @endforelse
                    @if($students->count() > 0)
                        <tr id="oys-cv-no-match" hidden><td colspan="5" class="oys-cv-empty"><i class="fas fa-search" aria-hidden="true"></i>No matching records. Try a different search.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="oys-cv-card-footer">
            <span id="oys-cv-visible-count" aria-live="polite">Showing {{ $students->count() }} displayed record(s)</span>
            <span><i class="fas fa-info-circle" aria-hidden="true"></i> Print All includes the complete class collection.</span>
        </div>
    </div>
</div>

{{-- This template contains ALL students, not just the displayed $students collection.
     It remains outside the visible dashboard until the Print All button is clicked. --}}
<template id="oys-cv-print-template">
    <div class="print-header">
        <img src="{{ asset('images/oyscohest-logo.png') }}" alt="College logo" class="print-logo">
        <h1>Oyo State College of Health Science and Technology</h1>
        <p>Eleyele, Ibadan, Oyo State</p>
        <h2>CLASS LIST</h2>
        <p class="print-meta"><strong>Programme:</strong> {{ $programme }} &nbsp; | &nbsp;
            <strong>Level:</strong> {{ $studentLevel }} &nbsp; | &nbsp;
            <strong>Admission Year:</strong> {{ $admissionYear }}</p>
        <p class="print-total">Total Students: {{ $studentCount }}</p>
    </div>
    <table>
        <thead><tr><th>#</th><th>Matric No.</th><th>Student Name</th><th>Programme</th><th>Level</th></tr></thead>
        <tbody>
            @forelse($allStudent as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->admission_no }}</td>
                    <td>{{ trim($student->surname . ' ' . $student->first_name . ' ' . $student->other_name) }}</td>
                    <td>{{ $student->course }}</td>
                    <td>{{ $student->class }}</td>
                </tr>
            @empty
                <tr><td colspan="5">No students found.</td></tr>
            @endforelse
        </tbody>
    </table>
</template>

<script>
(function () {
    'use strict';

    function filterTable() {
        const input = document.getElementById('searchInput');
        const rows = document.querySelectorAll('#classListTable tbody tr.oys-cv-data-row');
        const noMatch = document.getElementById('oys-cv-no-match');
        const visibleCount = document.getElementById('oys-cv-visible-count');
        if (!input || !visibleCount) return;

        const query = input.value.trim().toLocaleLowerCase();
        let visible = 0;
        rows.forEach(function (row) {
            const matched = row.textContent.toLocaleLowerCase().includes(query);
            row.hidden = !matched;
            row.style.display = matched ? '' : 'none';
            if (matched) visible++;
        });
        if (noMatch) {
            noMatch.hidden = visible !== 0;
            noMatch.style.display = visible === 0 ? '' : 'none';
        }
        visibleCount.textContent = 'Showing ' + visible + ' of ' + rows.length + ' displayed record(s)';
    }

    function printAllStudents() {
        const template = document.getElementById('oys-cv-print-template');
        if (!template) return;
        const frame = document.createElement('iframe');
        frame.setAttribute('title', 'Print complete class list');
        frame.style.position = 'fixed';
        frame.style.width = '0';
        frame.style.height = '0';
        frame.style.border = '0';
        frame.style.opacity = '0';
        document.body.appendChild(frame);

        const doc = frame.contentDocument || frame.contentWindow.document;
        doc.open();
        doc.write(`<!DOCTYPE html><html><head><meta charset="utf-8"><title>Class List</title>
            <style>
                @page { size: A4 portrait; margin: 14mm 12mm; }
                * { box-sizing: border-box; }
                body { margin: 0; color: #222; font: 10pt Arial, sans-serif; }
                .print-header { text-align: center; margin-bottom: 18px; }
                .print-logo { width: 70px; height: 70px; object-fit: contain; margin-bottom: 6px; }
                h1 { font-size: 15pt; margin: 4px 0; color: #23643a; }
                h2 { margin: 14px 0 9px; font-size: 12pt; letter-spacing: 1px; }
                p { margin: 5px 0; }
                .print-meta { line-height: 1.7; }
                .print-total { font-weight: bold; margin-top: 9px; }
                table { width: 100%; border-collapse: collapse; table-layout: auto; }
                th, td { padding: 7px; border: 1px solid #777; text-align: left; vertical-align: top; overflow-wrap: anywhere; }
                th { background: #eaf5ed; font-weight: bold; }
                thead { display: table-header-group; }
                tr { break-inside: avoid; page-break-inside: avoid; }
            </style></head><body>${template.innerHTML}</body></html>`);
        doc.close();

        const images = Array.from(doc.images);
        Promise.all(images.map(function (img) {
            if (img.complete) return Promise.resolve();
            return new Promise(function (resolve) {
                img.onload = resolve;
                img.onerror = resolve;
                setTimeout(resolve, 3000);
            });
        })).then(function () {
            frame.contentWindow.focus();
            frame.contentWindow.print();
        });
        frame.contentWindow.addEventListener('afterprint', function () { frame.remove(); }, { once: true });
    }

    window.printAllStudents = printAllStudents;
    const searchInput = document.getElementById('searchInput');
    if (searchInput) searchInput.addEventListener('input', filterTable);
})();
</script>
@endsection
