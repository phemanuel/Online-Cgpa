@extends('layouts.other-pages')

@section('pageTitle', 'Students | OYSCOHEST Result Portal')

@section('content')
<style>
    .oys-students { --os-green:#23643a; --os-deep:#174a2a; --os-brown:#641510; --os-gold:#d5aa43; --os-muted:#708078; --os-line:#e4eae5; color:#26352d; padding-bottom:28px; }
    .oys-students .os-head { display:flex; justify-content:space-between; align-items:flex-start; gap:20px; flex-wrap:wrap; margin-bottom:22px; }
    .oys-students .os-kicker { color:var(--os-green); font-size:11px; font-weight:750; letter-spacing:1.2px; text-transform:uppercase; margin-bottom:8px; }
    .oys-students .os-kicker:before { content:''; display:inline-block; width:19px; height:3px; vertical-align:middle; margin-right:9px; background:var(--os-gold); border-radius:5px; }
    .oys-students .os-title { font-size:28px; font-weight:750; line-height:1.3; margin:0 0 5px; color:#23362a; }
    .oys-students .os-subtitle { font-size:13px; color:var(--os-muted); margin:0; line-height:1.75; }
    .oys-students .os-actions { display:flex; flex-wrap:wrap; gap:10px; align-items:center; }
    .oys-students .os-btn { display:inline-flex; gap:9px; align-items:center; justify-content:center; min-height:43px; padding:10px 17px; border-radius:9px; font-size:12px; font-weight:700; border:1px solid transparent; text-decoration:none; transition:background .2s,box-shadow .2s; cursor:pointer; }
    .oys-students .os-btn-green { background:var(--os-green); color:white; }
    .oys-students .os-btn-green:hover,.oys-students .os-btn-green:focus { color:white; background:var(--os-deep); box-shadow:0 5px 16px rgba(35,100,58,.16); }
    .oys-students .os-btn-outline { color:var(--os-green); background:#fff; border-color:#cee0d3; }
    .oys-students .os-btn-outline:hover { color:var(--os-deep); background:#f1f8f3; }
    .oys-students .os-stat { display:flex; align-items:center; gap:17px; width:min(100%,340px); padding:22px 24px; border:1px solid var(--os-line); border-radius:14px; background:linear-gradient(110deg,#fff 45%,#f3f9f4); margin-bottom:23px; box-shadow:0 6px 25px rgba(35,70,40,.035); }
    .oys-students .os-stat-icon { flex:none; width:49px; height:49px; display:grid; place-items:center; border-radius:12px; background:#e6f3e9; color:var(--os-green); font-size:21px; }
    .oys-students .os-stat-label { font-size:12px; color:var(--os-muted); margin:0 0 4px; }
    .oys-students .os-stat-value { font-size:28px; line-height:1.2; font-weight:800; color:#203f2a; margin:0; }
    .oys-students .os-panel { background:#fff; border:1px solid var(--os-line); border-radius:15px; overflow:hidden; box-shadow:0 7px 25px rgba(30,65,40,.04); }
    .oys-students .os-panel-top { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:15px; padding:22px 24px; border-bottom:1px solid #ebefec; }
    .oys-students .os-panel-title { font-size:17px; font-weight:750; margin:0 0 5px; color:#25392b; }
    .oys-students .os-panel-description { font-size:12px; color:var(--os-muted); margin:0; }
    .oys-students .os-search { position:relative; width:100%; max-width:300px; }
    .oys-students .os-search i { position:absolute; top:50%; left:15px; transform:translateY(-50%); color:#879b8d; pointer-events:none; }
    .oys-students .os-search input { width:100%; height:44px; border:1px solid #dce6df; border-radius:9px; background:#fcfdfc; padding:10px 38px 10px 40px; outline:none; font-size:12px; }
    .oys-students .os-search input:focus { border-color:var(--os-green); box-shadow:0 0 0 4px rgba(35,100,58,.09); }
    .oys-students .os-search-spinner { position:absolute; top:50%; right:13px; transform:translateY(-50%); display:none; color:var(--os-green); }
    .oys-students .os-table-wrap { overflow-x:auto; }
    .oys-students #classListTable { width:100%; margin:0; border-collapse:collapse; }
    .oys-students #classListTable thead th { background:#f5f9f6; color:#496354; padding:16px 15px; border-top:0; border-bottom:1px solid #e3eae5; font-size:11px; font-weight:750; text-transform:uppercase; letter-spacing:.4px; white-space:nowrap; }
    .oys-students #classListTable tbody td { border-top:1px solid #f0f2f0; padding:15px; font-size:12px; color:#35473b; vertical-align:middle; }
    .oys-students #classListTable tbody tr:hover { background:#f9fcfa; }
    .oys-students #classListTable tbody a { color:var(--os-green); }
    .oys-students .os-pagination { padding:20px 24px 8px; overflow-x:auto; }
    .oys-students .os-pagination .page-item.active .page-link { background:var(--os-green); border-color:var(--os-green); color:white; }
    .oys-students .os-pagination .page-link { color:var(--os-green); }
    .oys-students .os-hint { display:flex; align-items:flex-start; gap:10px; padding:16px 20px; margin-top:18px; border-radius:10px; background:#f4faf5; border:1px solid #d9e9dc; color:#56705b; font-size:12px; line-height:1.8; }
    .oys-students .os-hint i { margin-top:3px; color:var(--os-green); }
    .oys-students .os-modal .modal-dialog { max-width:810px; }
    .oys-students .os-modal .modal-content { border:0; border-radius:16px; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,.18); }
    .oys-students .os-modal .modal-header { padding:20px 25px; background:#f5faf6; border-bottom:1px solid #e4eee6; align-items:center; }
    .oys-students .os-modal .modal-title { font-size:18px; font-weight:750; color:#254830; }
    .oys-students .os-modal .modal-title i { color:var(--os-green); margin-right:9px; }
    .oys-students .os-modal .modal-body { padding:24px 25px; }
    .oys-students .os-modal .form-group label { font-size:12px; font-weight:700; color:#405146; }
    .oys-students .os-modal .form-control { min-height:43px; height:auto; border:1px solid #dde7df; border-radius:8px; background:#fcfdfc; font-size:13px; }
    .oys-students .os-modal select.form-control { height:44px; }
    .oys-students .os-modal textarea.form-control { min-height:90px; }
    .oys-students .os-modal .form-control:focus { border-color:var(--os-green); box-shadow:0 0 0 3px rgba(35,100,58,.09); }
    .oys-students .os-modal .os-modal-scroll { max-height:min(58vh,520px); overflow-y:auto; padding-right:7px; }
    .oys-students .os-modal .os-modal-footer { display:flex; align-items:center; justify-content:flex-end; gap:10px; padding-top:17px; border-top:1px solid #eef0ee; }
    .oys-students .os-error { color:#b42335; font-size:11px; margin-top:5px; }
    @media(max-width:767px) { .oys-students .os-title{font-size:24px;} .oys-students .os-actions,.oys-students .os-actions .os-btn { width:100%; } .oys-students .os-panel-top{padding:19px;} .oys-students .os-search{max-width:none;} .oys-students .os-modal .modal-body{padding:18px;} .oys-students .os-stat{width:100%;} }
</style>
<style>

/* ==========================================
   OYSCOHEST STUDENT TABLE ROWS
========================================== */

.oys-student-row {
    transition: background-color .18s ease;
}

.oys-student-row:hover {
    background: #f5faf6 !important;
}

.oys-student-row td {
    padding: 13px 16px !important;
    vertical-align: middle !important;
    border-bottom: 1px solid #edf0ed;
    font-size: 12px;
}

.oys-student-number {
    color: #89938b;
    font-size: 12px;
    font-weight: 600;
}

/* PROFILE IMAGE */

.oys-student-avatar {
    width: 46px;
    height: 46px;
    overflow: hidden;
    border: 2px solid #e4efe6;
    border-radius: 12px;
    background: #f0f5f1;
}

.oys-student-avatar img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
}

/* MATRICULATION NUMBER */

.oys-student-matric {
    color: #23643a;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .2px;
    white-space: nowrap;
}

/* STUDENT NAME */

.oys-student-name {
    display: inline-block;
    color: #29342e;
    font-size: 12px;
    font-weight: 700;
    line-height: 1.6;
    text-transform: capitalize;
}

/* PROGRAMME */

.oys-student-programme {
    display: inline-block;
    color: #657369;
    font-size: 12px;
    line-height: 1.6;
}

/* ADMISSION YEAR */

.oys-student-year {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 11px;
    background: #eaf5ed;
    border: 1px solid #d8eadd;
    border-radius: 7px;
    color: #23643a;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.oys-student-year i {
    font-size: 11px;
}

/* EDIT BUTTON */

.oys-student-edit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 34px;
    padding: 7px 13px;
    border: 1px solid #d5e7d9;
    border-radius: 8px;
    background: #f1f8f3;
    color: #23643a !important;
    font-size: 11px;
    font-weight: 700;
    text-decoration: none !important;
    white-space: nowrap;
    transition: all .2s ease;
}

.oys-student-edit i {
    font-size: 11px;
}

.oys-student-edit:hover {
    background: #23643a;
    border-color: #23643a;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(35,100,58,.15);
    transform: translateY(-1px);
}

.oys-student-edit:focus-visible {
    outline: 3px solid rgba(35,100,58,.30);
    outline-offset: 2px;
}

/* MOBILE */

@media (max-width: 767px) {
    .oys-student-row td {
        padding: 11px 13px !important;
    }

    .oys-student-avatar {
        width: 40px;
        height: 40px;
    }

    .oys-student-edit {
        padding: 8px 11px;
    }
}

</style>

<div class="oys-students">
    <div class="os-head">
        <div>
            <div class="os-kicker">Student Management</div>
            <h1 class="os-title">Students</h1>
            <p class="os-subtitle">Manage student records, view registered students and register new students.</p>
        </div>
        <div class="os-actions">
            <a href="{{ route('class-list') }}" class="os-btn os-btn-outline"><i class="fas fa-print" aria-hidden="true"></i> Print Class List</a>
            <button type="button" class="os-btn os-btn-green" data-toggle="modal" data-target="#createStudentModal"><i class="fas fa-user-plus" aria-hidden="true"></i> Create Student</button>
        </div>
    </div>

    <div class="os-stat">
        <div class="os-stat-icon"><i class="fas fa-user-graduate" aria-hidden="true"></i></div>
        <div><p class="os-stat-label">Total registered students</p><p class="os-stat-value">{{ number_format($userCount) }}</p></div>
    </div>

    {{-- Success and error messages are handled by the shared dashboard layout. --}}
    <div class="os-panel">
        <div class="os-panel-top">
            <div><h2 class="os-panel-title">Student Directory</h2><p class="os-panel-description">Browse student accounts or search by matriculation number or name.</p></div>
            <div class="os-search">
                <label class="sr-only" for="searchInput">Search by matriculation number or name</label>
                <i class="fas fa-search" aria-hidden="true"></i>
                <input type="search" id="searchInput" placeholder="Search by matric no or name..." autocomplete="off">
                <span class="os-search-spinner" id="searchSpinner" aria-hidden="true"><i class="fas fa-spinner fa-spin"></i></span>
            </div>
        </div>
        <div class="os-table-wrap">
            <table class="table" id="classListTable">
                <thead><tr>
                    <th></th><th>#</th><th>Matric No</th><th>Full Name</th><th>Programme</th><th>Admission Year</th><th>Action</th>
                </tr></thead>
                <tbody id="tableBody">
                    @include('partials.student_rows', ['users' => $users])
                </tbody>
            </table>
        </div>
        <div id="paginationLinks" class="os-pagination">{{ $users->links() }}</div>
    </div>
    <div class="os-hint"><i class="fas fa-info-circle" aria-hidden="true"></i><span>To print a class list for a particular programme, academic level and admission year, use <strong>Print Class List</strong> above.</span></div>

    <!-- Student registration modal: keep original field names and submission route -->
    <div class="modal fade os-modal" id="createStudentModal" tabindex="-1" role="dialog" aria-labelledby="createStudentLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"><div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="createStudentLabel"><i class="fas fa-user-graduate" aria-hidden="true"></i> Register Student</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="os-subtitle mb-3">Enter the student's personal and academic details below.</p>
                <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data" id="createStudentForm">
                    @csrf
                    <div class="os-modal-scroll"><div class="row">
                        <div class="form-group col-md-6">
                            <label for="st_admission_no">Matric No</label>
                            <input id="st_admission_no" name="admission_no" type="text" class="form-control @error('admission_no') is-invalid @enderror" value="{{ old('admission_no') }}" required>
                            @error('admission_no')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_reg_no">Admission No <small class="text-muted">(If unavailable, enter the matric number)</small></label>
                            <input id="st_reg_no" name="reg_no" type="text" class="form-control @error('reg_no') is-invalid @enderror" value="{{ old('reg_no') }}" >
                            @error('reg_no')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_surname">Surname</label>
                            <input id="st_surname" name="surname" type="text" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname') }}" required>
                            @error('surname')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_first_name">First Name</label>
                            <input id="st_first_name" name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                            @error('first_name')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_other_name">Other Name</label>
                            <input id="st_other_name" name="other_name" type="text" class="form-control @error('other_name') is-invalid @enderror" value="{{ old('other_name') }}" >
                            @error('other_name')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_gender">Gender</label>
                            <select name="gender" id="st_gender" class="form-control @error('gender') is-invalid @enderror" required>
                                <option value="">Select gender</option>
                                @foreach(['Male','Female'] as $gender)
                                    <option value="{{ $gender }}" @selected(old('gender') === $gender)>{{ $gender }}</option>
                                @endforeach
                            </select>
                            @error('gender')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_programme">Programme</label>
                            <select name="programme" id="st_programme" class="form-control @error('programme') is-invalid @enderror">
                                @foreach($programmes as $d)
                                    <option value="{{ $d->department }}" @selected(old('programme') == $d->department)>{{ $d->department }}</option>
                                @endforeach
                            </select>
                            @error('programme')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_admission_year">Admission Year</label>
                            <select name="admission_year" id="st_admission_year" class="form-control @error('admission_year') is-invalid @enderror" required>
                                <option value="">Select admission year</option>
                                @for($year = (int) date('Y'); $year >= 2018; $year--)
                                    <option value="{{ $year }}" @selected(old('admission_year') == $year)>{{ $year }}</option>
                                @endfor
                            </select>
                            @error('admission_year')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_class">Level</label>
                            <select name="class" id="st_class" class="form-control @error('class') is-invalid @enderror" required>
                                @foreach($allLevel as $d)
                                    <option value="{{ $d->level }}" @selected(old('class') == $d->level)>{{ $d->level }}</option>
                                @endforeach
                            </select>
                            @error('class')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_phone_no">Phone No</label>
                            <input id="st_phone_no" name="phone_no" type="tel" class="form-control @error('phone_no') is-invalid @enderror" value="{{ old('phone_no') }}" >
                            @error('phone_no')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_lga">LGA</label>
                            <input id="st_lga" name="lga" type="text" class="form-control @error('lga') is-invalid @enderror" value="{{ old('lga') }}" required>
                            @error('lga')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_dob">Date of Birth</label>
                            <input id="st_dob" name="dob" type="date" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}" required>
                            @error('dob')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_state">State</label>
                            <select name="state" id="st_state" class="form-control @error('state') is-invalid @enderror" required>
                                <option value="ABIA" @selected(old('state', 'OYO') === 'ABIA')>ABIA</option>
                                <option value="ADAMAWA" @selected(old('state', 'OYO') === 'ADAMAWA')>ADAMAWA</option>
                                <option value="AKWAIBOM" @selected(old('state', 'OYO') === 'AKWAIBOM')>AKWAIBOM</option>
                                <option value="ANAMBRA" @selected(old('state', 'OYO') === 'ANAMBRA')>ANAMBRA</option>
                                <option value="BAUCHI" @selected(old('state', 'OYO') === 'BAUCHI')>BAUCHI</option>
                                <option value="BAYELSA" @selected(old('state', 'OYO') === 'BAYELSA')>BAYELSA</option>
                                <option value="BENUE" @selected(old('state', 'OYO') === 'BENUE')>BENUE</option>
                                <option value="BORNO" @selected(old('state', 'OYO') === 'BORNO')>BORNO</option>
                                <option value="CROSSRIVER" @selected(old('state', 'OYO') === 'CROSSRIVER')>CROSSRIVER</option>
                                <option value="DELTA" @selected(old('state', 'OYO') === 'DELTA')>DELTA</option>
                                <option value="EBONYI" @selected(old('state', 'OYO') === 'EBONYI')>EBONYI</option>
                                <option value="EDO" @selected(old('state', 'OYO') === 'EDO')>EDO</option>
                                <option value="EKITI" @selected(old('state', 'OYO') === 'EKITI')>EKITI</option>
                                <option value="ENUGU" @selected(old('state', 'OYO') === 'ENUGU')>ENUGU</option>
                                <option value="GOMBE" @selected(old('state', 'OYO') === 'GOMBE')>GOMBE</option>
                                <option value="IMO" @selected(old('state', 'OYO') === 'IMO')>IMO</option>
                                <option value="JIGAWA" @selected(old('state', 'OYO') === 'JIGAWA')>JIGAWA</option>
                                <option value="KADUNA" @selected(old('state', 'OYO') === 'KADUNA')>KADUNA</option>
                                <option value="KANO" @selected(old('state', 'OYO') === 'KANO')>KANO</option>
                                <option value="KASTINA" @selected(old('state', 'OYO') === 'KASTINA')>KASTINA</option>
                                <option value="KEBBI" @selected(old('state', 'OYO') === 'KEBBI')>KEBBI</option>
                                <option value="KOGI" @selected(old('state', 'OYO') === 'KOGI')>KOGI</option>
                                <option value="KWARA" @selected(old('state', 'OYO') === 'KWARA')>KWARA</option>
                                <option value="LAGOS" @selected(old('state', 'OYO') === 'LAGOS')>LAGOS</option>
                                <option value="NASSARAWA" @selected(old('state', 'OYO') === 'NASSARAWA')>NASSARAWA</option>
                                <option value="NIGER" @selected(old('state', 'OYO') === 'NIGER')>NIGER</option>
                                <option value="OGUN" @selected(old('state', 'OYO') === 'OGUN')>OGUN</option>
                                <option value="ONDO" @selected(old('state', 'OYO') === 'ONDO')>ONDO</option>
                                <option value="OSUN" @selected(old('state', 'OYO') === 'OSUN')>OSUN</option>
                                <option value="OYO" @selected(old('state', 'OYO') === 'OYO')>OYO</option>
                                <option value="PLATEAU" @selected(old('state', 'OYO') === 'PLATEAU')>PLATEAU</option>
                                <option value="RIVERS" @selected(old('state', 'OYO') === 'RIVERS')>RIVERS</option>
                                <option value="SOKOTO" @selected(old('state', 'OYO') === 'SOKOTO')>SOKOTO</option>
                                <option value="TARABA" @selected(old('state', 'OYO') === 'TARABA')>TARABA</option>
                                <option value="YOBE" @selected(old('state', 'OYO') === 'YOBE')>YOBE</option>
                                <option value="ZAMFARA" @selected(old('state', 'OYO') === 'ZAMFARA')>ZAMFARA</option>
                                <option value="ABUJA" @selected(old('state', 'OYO') === 'ABUJA')>ABUJA</option>
                            </select>
                            @error('state')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_address">Address</label>
                            <textarea name="address" id="st_address" class="form-control @error('address') is-invalid @enderror" required>{{ old('address') }}</textarea>
                            @error('address')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="st_picture">Profile Picture</label>
                            <input type="file" name="picture_dir" id="st_picture" class="form-control @error('picture_dir') is-invalid @enderror" accept="image/*">
                            @error('picture_dir')<div class="os-error">{{ $message }}</div>@enderror
                        </div>
                    </div></div>
                    <div class="os-modal-footer">
                        <button type="button" class="os-btn os-btn-outline" data-dismiss="modal">Cancel</button>
                        <button class="os-btn os-btn-green" type="submit" id="saveBtn"><i class="fas fa-save" aria-hidden="true"></i> Save Student</button>
                    </div>
                </form>
                {{-- Original bulk-import panel was not linked from the visible tabs.
                     Keep it available in the source without exposing a new action. --}}
                <div id="bulk" class="d-none" aria-hidden="true">
                    <form action="{{ route('student.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="import_file">Upload Excel File (.xlsx, .csv)</label>
                        <input type="file" name="import_file" id="import_file" accept=".xlsx,.csv">
                        <button type="submit">Import Students</button>
                        <a href="{{ asset('templates/student-data.csv') }}" target="_blank" rel="noopener">Download template</a>
                    </form>
                </div>
            </div>
        </div></div>
    </div>
</div>

{{-- The original search endpoint returns rendered student_rows HTML and pagination HTML. --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('searchInput');
    const rows = document.getElementById('tableBody');
    const pagination = document.getElementById('paginationLinks');
    const spinner = document.getElementById('searchSpinner');
    if (!search || !rows || !pagination) return;

    let timer = null;
    let controller = null;
    let requestNumber = 0;
    const initialRows = rows.innerHTML;
    const initialPagination = pagination.innerHTML;

    search.addEventListener('input', function () {
        clearTimeout(timer);
        if (controller) controller.abort();
        const query = search.value.trim();
        const currentRequest = ++requestNumber;
        if (!query) {
            rows.innerHTML = initialRows;
            pagination.innerHTML = initialPagination;
            spinner.style.display = 'none';
            return;
        }
        timer = setTimeout(async function () {
            controller = new AbortController();
            spinner.style.display = 'inline-block';
            try {
                const url = @json(url('/admin/search-students')) + '?query=' + encodeURIComponent(query);
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
                    signal: controller.signal
                });
                if (!response.ok) throw new Error('Search failed');
                const data = await response.json();
                if (currentRequest !== requestNumber) return;
                rows.innerHTML = data.rows || '<tr><td colspan="7" class="text-center py-4">No students found.</td></tr>';
                pagination.innerHTML = data.pagination || '';
            } catch (error) {
                if (error.name !== 'AbortError' && currentRequest === requestNumber) {
                    console.error('Student search failed:', error);
                    rows.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-danger">Unable to search students. Please try again.</td></tr>';
                    pagination.innerHTML = '';
                }
            } finally {
                if (currentRequest === requestNumber) spinner.style.display = 'none';
            }
        }, 260);
    });

    @if($errors->hasAny(['admission_no', 'reg_no', 'surname', 'first_name', 'other_name', 'gender', 'programme', 'admission_year', 'class', 'phone_no', 'state', 'lga', 'dob', 'address', 'picture_dir']))
    if (typeof window.jQuery !== 'undefined' && window.jQuery.fn.modal) {
        window.jQuery('#createStudentModal').modal('show');
    }
    @endif

    // Preserve standard form POST and its Laravel validation/redirect flow.
    const form = document.getElementById('createStudentForm');
    if (form) form.addEventListener('submit', function () {
        if (!form.checkValidity()) return;
        const save = document.getElementById('saveBtn');
        if (save) { save.disabled = true; save.innerHTML = '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> Saving...'; }
    });
});
</script>
@endsection
