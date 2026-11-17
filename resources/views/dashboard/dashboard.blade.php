@extends('result-portal.layouts.dashboard')

@section('portalAudience', 'student')
@section('pageTitle', 'Student Dashboard | OYSCOHEST Result Portal')
@section('heading', 'Student Dashboard')
@section('subtitle', 'Your academic information and transcript activity in one place.')
@section('headerCaption', 'Student Result Portal')

@section('content')
@php $student = Auth::guard('student')->user(); @endphp

<div class="oys-stat-grid">
    <article class="oys-stat-card">
        <div class="oys-stat-top"><span class="oys-stat-label">Transcript Requests</span><span class="oys-stat-icon"><i class="fas fa-file-signature"></i></span></div>
        <div class="oys-stat-value">{{ number_format($user_request->count()) }}</div>
        <a href="{{ route('user-request') }}" class="oys-stat-link">Request transcript <i class="fas fa-arrow-right ml-1"></i></a>
    </article>
    <article class="oys-stat-card is-brown">
        <div class="oys-stat-top"><span class="oys-stat-label">Payment Records</span><span class="oys-stat-icon"><i class="fas fa-receipt"></i></span></div>
        <div class="oys-stat-value">{{ number_format($user_payment->count()) }}</div>
        <a href="{{ route('payment-report') }}" class="oys-stat-link">Payment history <i class="fas fa-arrow-right ml-1"></i></a>
    </article>
    <article class="oys-stat-card is-gold">
        <div class="oys-stat-top"><span class="oys-stat-label">Transcript Records</span><span class="oys-stat-icon"><i class="fas fa-file-alt"></i></span></div>
        <div class="oys-stat-value">{{ number_format($user_transcript->count()) }}</div>
        <span class="oys-stat-note">Transcript entries on your account</span>
    </article>
    <article class="oys-stat-card">
        <div class="oys-stat-top"><span class="oys-stat-label">Current Level</span><span class="oys-stat-icon"><i class="fas fa-graduation-cap"></i></span></div>
        <div class="oys-stat-value" style="font-size:23px;overflow-wrap:anywhere">{{ $student->current_level ?: 'N/A' }}</div>
        <a href="{{ route('student-result') }}" class="oys-stat-link">View results <i class="fas fa-arrow-right ml-1"></i></a>
    </article>
</div>

<section class="oys-panel" aria-labelledby="basicInfoTitle">
    <div class="oys-panel-heading"><div><h2 id="basicInfoTitle">Basic Information</h2><p>Your academic profile as recorded by the college.</p></div><i class="fas fa-id-card" style="color:var(--oys-green);font-size:20px" aria-hidden="true"></i></div>
    <div class="oys-panel-body">
        <div class="oys-profile">
            <div class="oys-profile-item"><small>Matriculation Number</small><strong>{{ $student->admission_no }}</strong></div>
            <div class="oys-profile-item"><small>Full Name</small><strong>{{ strtoupper($student->student_full_name) }}</strong></div>
            <div class="oys-profile-item wide"><small>Programme</small><strong>{{ $student->course }}</strong></div>
            <div class="oys-profile-item"><small>Current Level</small><strong>{{ $student->current_level }}</strong></div>
            <div class="oys-profile-item"><small>Admission Year</small><strong>{{ $student->admission_year }}</strong></div>
        </div>
    </div>
</section>

<div class="oys-two-col">
    <section class="oys-panel" aria-labelledby="transcriptStatusTitle">
        <div class="oys-panel-heading"><div><h2 id="transcriptStatusTitle">Transcript Status</h2><p>Updates on your transcript processing.</p></div></div>
        <div class="oys-panel-body">
            @forelse($user_track as $rs)
                <div class="oys-status">
                    <span class="oys-status-mark"><i class="fas fa-file-signature"></i></span>
                    <div class="oys-status-body">
                        <strong>{{ $rs->request_id }}</strong>
                        <div><span class="oys-status-badge">{{ $rs->certificate_status }}</span></div>
                        <p>{{ $rs->comments }}</p>
                        <small>Updated by <strong>{{ $rs->approved_by }}</strong> on {{ \Carbon\Carbon::parse($rs->created_at)->format('F j, Y, h:i A') }}</small>
                    </div>
                </div>
            @empty
                <div class="oys-empty"><i class="far fa-file-alt"></i>No transcript status updates available.</div>
            @endforelse
        </div>
        @if(method_exists($user_track, 'links'))<div class="oys-pagination">{{ $user_track->appends(['tab' => 'transcript-status'])->links() }}</div>@endif
    </section>

    <section class="oys-panel" aria-labelledby="transcriptHistoryTitle">
        <div class="oys-panel-heading"><div><h2 id="transcriptHistoryTitle">Transcript Requests</h2><p>Your submitted transcript requests.</p></div></div>
        <div class="oys-table-wrap">
            <table class="oys-table">
                <thead><tr><th scope="col">Request ID</th><th scope="col">Matric No</th><th scope="col">Programme</th><th scope="col">Graduation Year</th><th scope="col">Clearance No</th><th scope="col">Date</th></tr></thead>
                <tbody>
                    @forelse($user_request as $rd)
                    <tr><td><strong>{{ $rd->request_id }}</strong></td><td>{{ $rd->matric_no }}</td><td>{{ $rd->programme }}</td><td>{{ $rd->graduation_year }}</td><td>{{ $rd->clearance_no }}</td><td>{{ $rd->created_at }}</td></tr>
                    @empty
                    <tr><td colspan="6" class="oys-table-empty">No transcript requests available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($user_request, 'links'))<div class="oys-pagination">{{ $user_request->appends(['tab' => 'transcript-request'])->links() }}</div>@endif
    </section>
</div>
@endsection
