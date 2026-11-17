@extends('layouts.dashboard')

@section('pageTitle', 'Dashboard | OYSCOHEST Result Portal')
@section('heading', 'Dashboard Overview')
@section('subtitle', 'Manage academic records, staff, students and transcript requests.')
@section('headerCaption', 'Staff & Administration')

@section('content')
@php $role = (int) auth()->user()->user_type_status; @endphp

@if(in_array($role, [1, 2], true))
    <div class="oys-stat-grid">
        <article class="oys-stat-card">
            <div class="oys-stat-top"><span class="oys-stat-label">Registered Users</span><span class="oys-stat-icon"><i class="fas fa-users"></i></span></div>
            <div class="oys-stat-value">{{ number_format($users->count()) }}</div>
            <a class="oys-stat-link" href="{{ route('users') }}">View users <i class="fas fa-arrow-right ml-1"></i></a>
        </article>
        <article class="oys-stat-card is-brown">
            <div class="oys-stat-top"><span class="oys-stat-label">Instructors</span><span class="oys-stat-icon"><i class="fas fa-chalkboard-teacher"></i></span></div>
            <div class="oys-stat-value">{{ number_format($instructors->count()) }}</div>
            <a class="oys-stat-link" href="{{ route('instructors') }}">View instructors <i class="fas fa-arrow-right ml-1"></i></a>
        </article>
        <article class="oys-stat-card">
            <div class="oys-stat-top"><span class="oys-stat-label">Transcript Requests</span><span class="oys-stat-icon"><i class="fas fa-file-signature"></i></span></div>
            <div class="oys-stat-value">{{ number_format($user_requests->count()) }}</div>
            <a class="oys-stat-link" href="{{ route('transcript-request') }}">View requests <i class="fas fa-arrow-right ml-1"></i></a>
        </article>
        <article class="oys-stat-card is-gold">
            <div class="oys-stat-top"><span class="oys-stat-label">Transcript Uploads</span><span class="oys-stat-icon"><i class="fas fa-file-upload"></i></span></div>
            <div class="oys-stat-value">{{ number_format($user_transcript->count()) }}</div>
            <a class="oys-stat-link" href="{{ route('user-transcript-upload') }}">View uploads <i class="fas fa-arrow-right ml-1"></i></a>
        </article>
        <article class="oys-stat-card">
            <div class="oys-stat-top"><span class="oys-stat-label">Students</span><span class="oys-stat-icon"><i class="fas fa-user-graduate"></i></span></div>
            <div class="oys-stat-value">{{ number_format($students->count()) }}</div>
            <a class="oys-stat-link" href="{{ route('student') }}">View students <i class="fas fa-arrow-right ml-1"></i></a>
        </article>
        <article class="oys-stat-card is-brown">
            <div class="oys-stat-top"><span class="oys-stat-label">Departments</span><span class="oys-stat-icon"><i class="fas fa-building"></i></span></div>
            <div class="oys-stat-value">{{ number_format($departments->count()) }}</div>
            <span class="oys-stat-note">Academic departments</span>
        </article>
        <article class="oys-stat-card">
            <div class="oys-stat-top"><span class="oys-stat-label">Heads of Department</span><span class="oys-stat-icon"><i class="fas fa-user-tie"></i></span></div>
            <div class="oys-stat-value">{{ number_format($hod->count()) }}</div>
            <a class="oys-stat-link" href="{{ route('hod-setup') }}">View HOD records <i class="fas fa-arrow-right ml-1"></i></a>
        </article>
    </div>

    <section class="oys-panel" aria-labelledby="transcriptRequestsTitle">
        <div class="oys-panel-heading">
            <div><h2 id="transcriptRequestsTitle">Transcript Requests</h2><p>Recent requests and their current processing status.</p></div>
            <a href="{{ route('transcript-request') }}" class="oys-table-action">View all <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="oys-table-wrap">
            <table class="oys-table">
                <thead><tr>
                    <th scope="col">Request ID</th><th scope="col">Email Address</th><th scope="col">Matric No</th><th scope="col">Full Name</th><th scope="col">Graduation Year</th><th scope="col">Programme</th><th scope="col">Clearance No</th><th scope="col">Date</th><th scope="col">Status</th><th scope="col">Action</th>
                </tr></thead>
                <tbody>
                    @forelse($user_requests as $rd)
                    <tr>
                        <td><strong>{{ $rd->request_id }}</strong></td>
                        <td>{{ $rd->email }}</td>
                        <td>{{ $rd->matric_no }}</td>
                        <td>{{ $rd->certificate_name }}</td>
                        <td>{{ $rd->graduation_year }}</td>
                        <td>{{ $rd->programme }}</td>
                        <td>{{ $rd->clearance_no }}</td>
                        <td>{{ $rd->created_at }}</td>
                        <td><span class="oys-status-badge">{{ $rd->certificate_status }}</span></td>
                        <td><a href="{{ route('transcript-request-view', ['id' => $rd->id]) }}" class="oys-table-action"><i class="fas fa-eye"></i> View</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="10" class="oys-table-empty">No transcript requests available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($user_requests, 'links'))<div class="oys-pagination">{{ $user_requests->links() }}</div>@endif
    </section>

@elseif($role === 3)
    <div class="oys-stat-grid">
        <article class="oys-stat-card">
            <div class="oys-stat-top"><span class="oys-stat-label">Assigned Courses</span><span class="oys-stat-icon"><i class="fas fa-book-open"></i></span></div>
            <div class="oys-stat-value">{{ number_format($assignedCourse->count()) }}</div>
            <span class="oys-stat-note">Courses currently listed for your account</span>
        </article>
    </div>
    <section class="oys-panel" aria-labelledby="assignedCoursesTitle">
        <div class="oys-panel-heading"><div><h2 id="assignedCoursesTitle">Assigned Courses</h2><p>Your academic teaching allocations.</p></div></div>
        <div class="oys-table-wrap">
            <table class="oys-table">
                <thead><tr><th scope="col">Department</th><th scope="col">Programme</th><th scope="col">Course Title</th><th scope="col">Course Code</th><th scope="col">Course Unit</th><th scope="col">Level</th><th scope="col">Semester</th><th scope="col">Student Admission Year</th></tr></thead>
                <tbody>
                    @forelse($assignedCourse as $rd)
                    <tr><td>{{ $rd->department }}</td><td>{{ $rd->programme }}</td><td><strong>{{ $rd->course_title }}</strong></td><td>{{ $rd->course_code }}</td><td>{{ $rd->course_unit }}</td><td>{{ $rd->level }}</td><td>{{ $rd->semester }}</td><td>{{ $rd->session1 }}</td></tr>
                    @empty
                    <tr><td colspan="8" class="oys-table-empty">You have not been assigned any courses. Please contact your department.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($assignedCourse, 'links'))<div class="oys-pagination">{{ $assignedCourse->links() }}</div>@endif
    </section>
@elseif($role === 4)
    <section class="oys-panel">
        <div class="oys-panel-heading"><div><h2>Welcome to your portal</h2><p>Use the navigation to access your results, request transcripts and update your account.</p></div></div>
        <div class="oys-panel-body">
            <a class="oys-table-action mr-2 mb-2" href="{{ route('student-result') }}"><i class="fas fa-poll"></i> View Results</a>
            <a class="oys-table-action mb-2" href="{{ route('user-request') }}"><i class="fas fa-file-signature"></i> Request Transcript</a>
        </div>
    </section>
@endif
@endsection
