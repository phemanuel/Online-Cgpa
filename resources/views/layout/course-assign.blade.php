@extends('layouts.other-pages')

@section('pageTitle', 'Course Assignment | OYSCOHEST Result Portal')

@section('content')
<style>
.oys-course-assign{--ca-green:#23643A;--ca-deep:#174A2A;--ca-burgundy:#641510;--ca-gold:#D5AA43;--ca-border:#e1eae3;--ca-muted:#66766b;max-width:1120px;margin:0 auto;padding:0 0 44px;color:#273b2d}
.oys-course-assign,.oys-course-assign *{box-sizing:border-box}
.oys-course-assign .ca-top{display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:25px}
.oys-course-assign .ca-kicker{font-size:11px;letter-spacing:1.2px;text-transform:uppercase;font-weight:800;color:var(--ca-green);margin-bottom:8px}
.oys-course-assign .ca-kicker:before{content:"";display:inline-block;width:18px;height:3px;background:var(--ca-gold);border-radius:3px;margin-right:9px;vertical-align:middle}
.oys-course-assign h1{font-size:clamp(24px,3vw,31px);line-height:1.25;color:#243a29;font-weight:750;margin:0 0 7px}
.oys-course-assign .ca-desc{font-size:13px;line-height:1.7;color:var(--ca-muted);margin:0}
.oys-course-assign .ca-back{display:inline-flex;align-items:center;gap:9px;text-decoration:none;border:1px solid #dbe7de;color:var(--ca-deep);background:#fff;border-radius:10px;padding:11px 16px;font-size:12px;font-weight:750}
.oys-course-assign .ca-back:hover{background:#f0f8f2;text-decoration:none;color:var(--ca-deep)}
.oys-course-assign .ca-card{background:#fff;border:1px solid var(--ca-border);border-radius:17px;overflow:hidden;box-shadow:0 9px 32px rgba(22,71,36,.055)}
.oys-course-assign .ca-cardhead{background:linear-gradient(110deg,#fff 30%,#f3faf5);padding:23px 27px;border-bottom:1px solid #e6eee7;display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap}
.oys-course-assign .ca-headgroup{display:flex;align-items:center;gap:14px}
.oys-course-assign .ca-icon{width:47px;height:47px;background:#e8f4eb;color:var(--ca-green);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:19px;flex:none}
.oys-course-assign .ca-cardhead h2{font-size:17px;font-weight:750;margin:0 0 5px;color:#283d2e}
.oys-course-assign .ca-cardhead p{font-size:12px;color:var(--ca-muted);margin:0;line-height:1.6}
.oys-course-assign .ca-pill{font-size:11px;padding:8px 12px;border-radius:99px;font-weight:750;display:inline-flex;align-items:center;gap:7px;white-space:nowrap}
.oys-course-assign .ca-pill.assigned{color:#1d6939;background:#e7f5e9;border:1px solid #cce6d1}
.oys-course-assign .ca-pill.unassigned{color:#8a5316;background:#fff5e5;border:1px solid #f3dbb8}
.oys-course-assign .ca-body{padding:26px 27px 29px}
.oys-course-assign .ca-section-heading{display:flex;align-items:center;gap:9px;font-size:13px;font-weight:800;letter-spacing:.3px;color:var(--ca-green);margin:0 0 7px}
.oys-course-assign .ca-section-heading i{font-size:14px}
.oys-course-assign .ca-section-caption{font-size:12px;line-height:1.6;color:var(--ca-muted);margin:0 0 18px}
.oys-course-assign .ca-details{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:13px}
.oys-course-assign .ca-detail{padding:15px 17px;border-radius:11px;background:#f8fbf8;border:1px solid #e6eee7;min-width:0}
.oys-course-assign .ca-detail-wide{grid-column:span 2}
.oys-course-assign .ca-detail-label{font-size:11px;color:var(--ca-muted);margin-bottom:7px}
.oys-course-assign .ca-detail-value{font-size:13px;line-height:1.5;font-weight:750;color:#2a4030;overflow-wrap:anywhere}
.oys-course-assign .ca-divider{height:1px;border:0;background:#e6ede7;margin:27px 0}
.oys-course-assign .ca-instructor{border:1px solid #d4e8d8;border-radius:12px;padding:17px 19px;display:flex;align-items:center;gap:15px;background:#f6fbf7;min-width:0}
.oys-course-assign .ca-avatar{width:56px;height:56px;object-fit:cover;border-radius:50%;border:2px solid #c9e1ce;flex:none}
.oys-course-assign .ca-instructor-name{font-weight:800;font-size:14px;color:#23412b;margin:0 0 5px}
.oys-course-assign .ca-instructor-dept{font-size:12px;color:var(--ca-muted);margin:0;line-height:1.5}
.oys-course-assign .ca-empty{display:flex;align-items:center;gap:13px;border:1px dashed #e6d6bf;background:#fffbf4;border-radius:12px;padding:17px 19px;color:#7b541f;font-size:13px;line-height:1.6}
.oys-course-assign .ca-empty i{font-size:20px;flex:none}
.oys-course-assign .ca-fields{display:grid;grid-template-columns:1fr 1.25fr;gap:20px}
.oys-course-assign .ca-field{min-width:0}
.oys-course-assign .ca-field label{display:block;color:#314836;font-size:12px;font-weight:750;margin-bottom:7px}
.oys-course-assign .ca-required{color:#a52225}
.oys-course-assign .ca-help{display:block;color:var(--ca-muted);font-size:11px;line-height:1.6;margin:0 0 10px}
.oys-course-assign .ca-control{width:100%;height:49px;display:block;padding:11px 13px;border:1px solid #dbe6de;border-radius:10px;color:#243c2a;background:#fcfdfc;font-size:13px;box-shadow:none;outline:none}
.oys-course-assign .ca-control:focus{border-color:var(--ca-green);background:white;box-shadow:0 0 0 4px rgba(35,100,58,.1)}
.oys-course-assign .ca-control.is-invalid{border-color:#c84646}
.oys-course-assign .ca-error{display:block;color:#b42a2d;font-size:12px;margin-top:8px}
.oys-course-assign .ca-alert{border-radius:10px;padding:13px 15px;font-size:13px;line-height:1.6;margin-bottom:18px}
.oys-course-assign .ca-alert-ok{background:#eaf7ed;color:#174a2a;border:1px solid #cee7d1}
.oys-course-assign .ca-alert-bad{background:#fff2f1;color:#7d231d;border:1px solid #efd0cc}
.oys-course-assign .ca-formactions{border-top:1px solid #e6eee7;padding:20px 27px;background:#fafdfa;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap}
.oys-course-assign .ca-note{color:var(--ca-muted);font-size:12px;line-height:1.6;margin:0}
.oys-course-assign .ca-note i{color:var(--ca-green);margin-right:6px}
.oys-course-assign .ca-submit{display:inline-flex;align-items:center;justify-content:center;gap:9px;border:none;background:var(--ca-green);color:#fff;border-radius:10px;padding:12px 22px;min-height:46px;font-size:13px;font-weight:750;cursor:pointer}
.oys-course-assign .ca-submit:hover{background:var(--ca-deep);color:white}
@media(max-width:700px){.oys-course-assign .ca-details{grid-template-columns:repeat(2,minmax(0,1fr))}.oys-course-assign .ca-fields{grid-template-columns:1fr}.oys-course-assign .ca-body,.oys-course-assign .ca-cardhead,.oys-course-assign .ca-formactions{padding:20px}.oys-course-assign .ca-formactions{flex-direction:column;align-items:stretch}.oys-course-assign .ca-submit{width:100%}}
@media(max-width:440px){.oys-course-assign .ca-details{grid-template-columns:1fr}.oys-course-assign .ca-detail-wide{grid-column:auto}}
</style>

<div class="oys-course-assign">
    <div class="ca-top">
        <div>
            <div class="ca-kicker">Course Management</div>
            <h1>Course Assignment</h1>
            <p class="ca-desc">View course information and assign or change the responsible instructor.</p>
        </div>
        <a class="ca-back" href="{{ route('course-list', ['programme' => $course->course, 'stdLevel' => $course->level, 'semester' => $course->semester]) }}">
            <i class="fas fa-arrow-left" aria-hidden="true"></i> Back to Course List
        </a>
    </div>

    @if(session('success'))
        <div class="ca-alert ca-alert-ok" role="status"><i class="fas fa-check-circle" aria-hidden="true"></i> {{ session('success') }}</div>
    @elseif(session('error'))
        <div class="ca-alert ca-alert-bad" role="alert"><i class="fas fa-exclamation-circle" aria-hidden="true"></i> {{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="ca-alert ca-alert-bad" role="alert">Please review the highlighted fields and try again.</div>
    @endif

    <div class="ca-card">
        <div class="ca-cardhead">
            <div class="ca-headgroup">
                <div class="ca-icon"><i class="fas fa-user-tie" aria-hidden="true"></i></div>
                <div>
                    <h2>Instructor Assignment</h2>
                    <p>Assign an instructor for the selected student admission year.</p>
                </div>
            </div>
            @if(!empty($courseInfo))
                <span class="ca-pill assigned"><i class="fas fa-check-circle" aria-hidden="true"></i> Instructor Assigned</span>
            @else
                <span class="ca-pill unassigned"><i class="fas fa-exclamation-circle" aria-hidden="true"></i> Not Assigned</span>
            @endif
        </div>

        <form action="{{ route('course-assign.action') }}" method="POST">
            @csrf
            <div class="ca-body">
                <h3 class="ca-section-heading"><i class="fas fa-book-open" aria-hidden="true"></i> Course Details</h3>
                <p class="ca-section-caption">Details of the course to which the instructor will be assigned.</p>
                <div class="ca-details">
                    <div class="ca-detail"><div class="ca-detail-label">Programme</div><div class="ca-detail-value">{{ $course->course }}</div></div>
                    <div class="ca-detail"><div class="ca-detail-label">Academic Level</div><div class="ca-detail-value">{{ $course->level }}</div></div>
                    <div class="ca-detail"><div class="ca-detail-label">Semester</div><div class="ca-detail-value">{{ $course->semester }}</div></div>
                    <div class="ca-detail ca-detail-wide"><div class="ca-detail-label">Course Title</div><div class="ca-detail-value">{{ $course->course_title }}</div></div>
                    <div class="ca-detail"><div class="ca-detail-label">Course Code</div><div class="ca-detail-value">{{ $course->course_code }}</div></div>
                    <div class="ca-detail"><div class="ca-detail-label">Course Unit</div><div class="ca-detail-value">{{ $course->course_unit }}</div></div>
                </div>

                <hr class="ca-divider">
                <h3 class="ca-section-heading"><i class="fas fa-chalkboard-teacher" aria-hidden="true"></i> Current Instructor</h3>
                <p class="ca-section-caption">The instructor currently associated with this course.</p>
                @if(!empty($courseInfo) && !empty($instructorInfo))
                    @php
                        $caImageName = $instructorInfo->image ?? null;
                        $caImageAvailable = $caImageName && file_exists(public_path('profile_pictures/' . $caImageName));
                    @endphp
                    <div class="ca-instructor">
                        <img class="ca-avatar" src="{{ $caImageAvailable ? asset('profile_pictures/' . $caImageName) : asset('uploads/blank.jpg') }}" alt="Instructor profile picture">
                        <div>
                            <p class="ca-instructor-name">{{ $instructorInfo->last_name }} {{ $instructorInfo->first_name }}</p>
                            <p class="ca-instructor-dept"><i class="fas fa-building" aria-hidden="true"></i> {{ $instructorInfo->department }}</p>
                        </div>
                    </div>
                @else
                    <div class="ca-empty"><i class="fas fa-user-slash" aria-hidden="true"></i><span><strong>No instructor assigned.</strong> Select an instructor below to make an assignment.</span></div>
                @endif

                <hr class="ca-divider">
                <h3 class="ca-section-heading"><i class="fas fa-user-plus" aria-hidden="true"></i> {{ !empty($courseInfo) ? 'Update Assignment' : 'Assign Instructor' }}</h3>
                <p class="ca-section-caption">Select the relevant admission year and the instructor responsible for this course.</p>
                <div class="ca-fields">
                    <div class="ca-field">
                        <label for="ca-acad-session">Student Admission Year <span class="ca-required">*</span></label>
                        <span class="ca-help">Admission cohort whose results will be processed.</span>
                        <select name="acadSession" id="ca-acad-session" class="ca-control @error('acadSession') is-invalid @enderror" required>
                            <option value="">Select Admission Year</option>
                            @for($year = 2018; $year <= (int) date('Y'); $year++)
                                <option value="{{ $year }}/{{ $year + 1 }}" @selected(old('acadSession') === $year . '/' . ($year + 1))>{{ $year }}/{{ $year + 1 }}</option>
                            @endfor
                        </select>
                        @error('acadSession') <span class="ca-error" role="alert">{{ $message }}</span> @enderror
                    </div>
                    <div class="ca-field">
                        <label for="ca-instructor">Instructor <span class="ca-required">*</span></label>
                        <span class="ca-help">Select the instructor to assign or reassign.</span>
                        <select name="instructorId" id="ca-instructor" class="ca-control @error('instructorId') is-invalid @enderror" required>
                            <option value="">Select Instructor</option>
                            @if(!empty($courseInfo) && !empty($instructorInfo))
                                <option value="{{ $instructorInfo->id }}" @selected((string) old('instructorId', $instructorInfo->id) === (string) $instructorInfo->id)>
                                    {{ $instructorInfo->last_name }} {{ $instructorInfo->first_name }} — {{ $instructorInfo->department }} (Currently Assigned)
                                </option>
                            @endif
                            @foreach($instructors as $i)
                                @if(empty($instructorInfo) || (string) $i->id !== (string) $instructorInfo->id)
                                    <option value="{{ $i->id }}" @selected((string) old('instructorId', '') === (string) $i->id)>{{ $i->last_name }} {{ $i->first_name }} — {{ $i->department }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('instructorId') <span class="ca-error" role="alert">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <input type="hidden" name="programme" value="{{ $course->course }}">
            <input type="hidden" name="level" value="{{ $course->level }}">
            <input type="hidden" name="semester" value="{{ $course->semester }}">
            <input type="hidden" name="courseTitle" value="{{ $course->course_title }}">
            <input type="hidden" name="courseCode" value="{{ $course->course_code }}">
            <input type="hidden" name="courseUnit" value="{{ $course->course_unit }}">
            <input type="hidden" name="assignId" value="{{ $course->id }}">
            <div class="ca-formactions">
                <p class="ca-note"><i class="fas fa-info-circle" aria-hidden="true"></i> Review the selected admission year and instructor before saving.</p>
                <button class="ca-submit" type="submit"><i class="fas fa-save" aria-hidden="true"></i> {{ !empty($courseInfo) ? 'Update Assignment' : 'Assign Instructor' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
