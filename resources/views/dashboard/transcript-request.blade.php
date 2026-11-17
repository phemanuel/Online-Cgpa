@extends('layouts.other-pages')

@section('pageTitle', 'E-Result | Transcript Requests')
@section('heading', 'Transcript Requests')
@section('subtitle', 'Review and manage transcript applications')

@section('content')

<style>
.oys-transcript{--green:#23643A;--deep:#174A2A;--burgundy:#641510;--gold:#D5AA43;--border:#e5e9e5;--muted:#647269;color:#24352b;font-family:inherit}
.oys-transcript *{box-sizing:border-box}.oys-transcript .page-head{display:flex;align-items:center;justify-content:space-between;gap:18px;flex-wrap:wrap;margin-bottom:22px}
.oys-transcript .eyebrow{font-size:11px;letter-spacing:1.7px;text-transform:uppercase;color:var(--green);font-weight:800;margin:0 0 7px}
.oys-transcript h2{font-size:clamp(22px,3vw,29px);line-height:1.3;color:#172c1c;margin:0;font-weight:800}.oys-transcript .subtitle{color:var(--muted);margin:6px 0 0;font-size:13px}
.oys-transcript .btn-oys{display:inline-flex;align-items:center;gap:9px;justify-content:center;text-decoration:none;border-radius:11px;padding:11px 16px;font-size:13px;font-weight:750;transition:.2s;border:1px solid transparent;cursor:pointer}
.oys-transcript .btn-oys.primary{background:var(--green);color:white}.oys-transcript .btn-oys.primary:hover{background:var(--deep);color:white}.oys-transcript .btn-oys.light{border-color:#cdded1;background:#fff;color:var(--deep)}.oys-transcript .btn-oys.light:hover{background:#edf5ee}
.oys-transcript .stat-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;margin-bottom:22px}.oys-transcript .stat{display:flex;align-items:center;gap:14px;padding:19px;border-radius:16px;background:#fff;border:1px solid var(--border);min-width:0}
.oys-transcript .stat .ico{height:45px;width:45px;flex:0 0 45px;display:grid;place-items:center;background:#e9f3ed;color:var(--green);border-radius:12px;font-size:18px}.oys-transcript .stat:nth-child(2) .ico{background:#fff6e6;color:#a77414}.oys-transcript .stat:nth-child(3) .ico{background:#fbeeee;color:var(--burgundy)}
.oys-transcript .stat small{font-size:12px;color:var(--muted);display:block}.oys-transcript .stat strong{font-size:25px;line-height:1.25;display:block;color:#172c1c}.oys-transcript .stat a{color:var(--green);font-size:12px;text-decoration:none;font-weight:700}
.oys-transcript .panel{border:1px solid var(--border);border-radius:17px;background:#fff;overflow:hidden;margin-bottom:20px;box-shadow:0 6px 28px rgba(20,50,26,.03)}
.oys-transcript .panel-head{padding:20px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:15px;flex-wrap:wrap}.oys-transcript .panel-head h3{font-size:16px;color:#1e3324;font-weight:800;margin:0}.oys-transcript .panel-head p{font-size:12px;color:var(--muted);margin:4px 0 0}
.oys-transcript .search{position:relative;max-width:340px;width:100%}.oys-transcript .search input{width:100%;border:1px solid #dce6dd;background:#fbfcfb;border-radius:10px;padding:11px 12px 11px 37px;outline:none;font-size:13px}.oys-transcript .search input:focus,.oys-transcript .field:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(35,100,58,.09)}.oys-transcript .search i{position:absolute;top:14px;left:13px;color:#829083}
.oys-transcript .table-scroll{width:100%;overflow-x:auto}.oys-transcript table{width:100%;border-collapse:collapse;min-width:1060px}.oys-transcript th{background:#f7faf7;color:#536456;letter-spacing:.55px;text-transform:uppercase;font-size:10.5px;font-weight:800;text-align:left;padding:14px 16px;border-bottom:1px solid var(--border);white-space:nowrap}.oys-transcript td{font-size:12.5px;padding:15px 16px;vertical-align:middle;border-bottom:1px solid #eef0ed;color:#263b2b}.oys-transcript tr:last-child td{border-bottom:0}.oys-transcript tbody tr:hover{background:#fbfdfb}.oys-transcript .request-id{font-weight:800;color:var(--deep)}.oys-transcript .text-muted{color:var(--muted)!important}.oys-transcript .ellipsis{max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.oys-transcript .pager{padding:16px 21px;border-top:1px solid var(--border)}
.oys-transcript .alert-oys{padding:14px 17px;border-radius:12px;margin-bottom:18px;font-size:13px}.oys-transcript .alert-oys.success{background:#eef8f0;color:#1c6636;border:1px solid #bee4c7}.oys-transcript .alert-oys.error{background:#fff0f0;color:#8f2424;border:1px solid #f3cccc}
.oys-transcript .empty{text-align:center;padding:42px 20px;color:var(--muted);font-size:13px}.oys-transcript .empty i{font-size:27px;color:#9bac9e;display:block;margin-bottom:11px}
.oys-transcript .detail-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:15px;padding:22px}.oys-transcript .detail-item{background:#f9fbf9;border:1px solid #eaf0ea;border-radius:11px;padding:13px 15px;min-width:0}.oys-transcript .detail-item small{display:block;color:var(--muted);font-size:11px;margin-bottom:6px}.oys-transcript .detail-item strong{display:block;font-size:13px;color:#1d3424;overflow-wrap:anywhere}
.oys-transcript .field-group{margin:0 0 18px}.oys-transcript .field-label{display:block;color:#2d4231;font-weight:750;font-size:12px;margin:0 0 7px}.oys-transcript .field{display:block;width:100%;padding:11px 13px;border:1px solid #d9e4db;border-radius:10px;outline:none;background:#fff;font-size:13px;color:#22372b}.oys-transcript textarea.field{min-height:112px;resize:vertical}.oys-transcript .help{display:block;font-size:11px;color:var(--muted);margin-top:6px}.oys-transcript .invalid{color:#a52929;font-size:12px;margin-top:6px;display:block}.oys-transcript .form-body{padding:22px}.oys-transcript .form-footer{padding:15px 22px;border-top:1px solid var(--border);display:flex;justify-content:flex-end;gap:10px}
.oys-transcript .two-col{display:grid;grid-template-columns:minmax(0,1.25fr) minmax(320px,.85fr);gap:20px;align-items:start}.oys-transcript .timeline{padding:22px}.oys-transcript .event{display:flex;gap:12px;padding-bottom:19px;position:relative}.oys-transcript .event:not(:last-child):before{content:'';position:absolute;top:23px;bottom:1px;left:10px;width:2px;background:#e5ece5}.oys-transcript .event-dot{z-index:1;background:#e8f3ea;color:var(--green);border-radius:50%;width:22px;height:22px;display:grid;place-items:center;font-size:10px;flex-shrink:0}.oys-transcript .event-body{flex:1;min-width:0}.oys-transcript .event-top{display:flex;justify-content:space-between;flex-wrap:wrap;gap:7px;align-items:center}.oys-transcript .event-top strong{font-size:12px;color:#203b26}.oys-transcript .event p{font-size:12px;color:#4d5e50;margin:6px 0}.oys-transcript .event small{color:var(--muted);font-size:11px}.oys-transcript .chip{background:#e9f4eb;color:#1d6638;border-radius:20px;padding:5px 10px;font-size:10px;font-weight:800}
@media(max-width:1050px){.oys-transcript .two-col{grid-template-columns:1fr}}@media(max-width:760px){.oys-transcript .stat-grid{grid-template-columns:1fr}.oys-transcript .detail-grid{grid-template-columns:1fr;padding:16px}.oys-transcript .panel-head{padding:17px}.oys-transcript .form-body,.oys-transcript .timeline{padding:17px}.oys-transcript .search{max-width:none}}
</style>

<div class="oys-transcript" id="transcriptRequestsPage">
    <div class="page-head">
        <div><p class="eyebrow">Transcript management</p><h2>Transcript Requests</h2><p class="subtitle">View applications, track requests and open individual records.</p></div>
    </div>
    @if(session('success'))
        <div class="alert-oys success" role="status"><i class="fas fa-check-circle mr-1"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-oys error" role="alert"><i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-oys error" role="alert"><strong>Please correct the errors below.</strong></div>
    @endif

    <div class="stat-grid">
        <div class="stat"><span class="ico"><i class="fas fa-users"></i></span><div><small>Registered users</small><strong>{{ $users->count() }}</strong><a href="{{ route('users') }}">View users <i class="fas fa-arrow-right"></i></a></div></div>
        <div class="stat"><span class="ico"><i class="fas fa-file-signature"></i></span><div><small>Transcript requests</small><strong>{{ method_exists($user_requests, 'total') ? $user_requests->total() : $user_requests->count() }}</strong><a href="{{ route('transcript-request') }}">View requests <i class="fas fa-arrow-right"></i></a></div></div>
        <div class="stat"><span class="ico"><i class="fas fa-file-pdf"></i></span><div><small>Transcript uploads</small><strong>{{ $user_transcript->count() }}</strong><a href="{{ route('user-transcript-upload') }}">View uploads <i class="fas fa-arrow-right"></i></a></div></div>
    </div>
    <section class="panel" aria-labelledby="requests-heading">
        <div class="panel-head"><div><h3 id="requests-heading">All transcript requests</h3><p>Search the requests currently displayed on this page.</p></div><label class="search"><i class="fas fa-search" aria-hidden="true"></i><input id="transcriptRequestSearch" type="search" placeholder="Search request ID, name, matric no..." aria-label="Search visible transcript requests"></label></div>
        <div class="table-scroll"><table id="transcriptRequestsTable"><thead><tr><th>Request ID</th><th>Email address</th><th>Matric no.</th><th>Full name</th><th>Graduation year</th><th>Programme</th><th>Clearance no.</th><th>Date</th><th>Action</th></tr></thead><tbody>
        @forelse($user_requests as $rd)
            <tr class="request-row">
                <td class="request-id">{{ $rd->request_id }}</td><td class="ellipsis" title="{{ $rd->email }}">{{ $rd->email }}</td><td>{{ $rd->matric_no }}</td><td>{{ $rd->certificate_name }}</td><td>{{ $rd->graduation_year }}</td><td>{{ $rd->programme }}</td><td>{{ $rd->clearance_no }}</td>
                <td class="text-muted">{{ $rd->created_at ? \Carbon\Carbon::parse($rd->created_at)->format('d M Y') : '—' }}</td>
                <td><a class="btn-oys light" href="{{ route('transcript-request-view', ['id' => $rd->id]) }}" aria-label="View request {{ $rd->request_id }}"><i class="fas fa-eye"></i> View</a></td>
            </tr>
        @empty
            <tr><td colspan="9"><div class="empty"><i class="far fa-folder-open"></i>No transcript requests are available.</div></td></tr>
        @endforelse
        </tbody></table></div>
        <div id="transcriptSearchEmpty" class="empty" hidden><i class="fas fa-search"></i>No matching requests on this page.</div>
        @if(method_exists($user_requests, 'links'))<div class="pager">{{ $user_requests->links() }}</div>@endif
    </section>
</div>
<script>
(function () {
    const input = document.getElementById('transcriptRequestSearch');
    const rows = Array.from(document.querySelectorAll('#transcriptRequestsTable tbody tr.request-row'));
    const empty = document.getElementById('transcriptSearchEmpty');
    if (!input) return;
    input.addEventListener('input', function () {
        const term = input.value.trim().toLocaleLowerCase();
        let shown = 0;
        rows.forEach(function (row) {
            const match = row.textContent.toLocaleLowerCase().includes(term);
            row.hidden = !match;
            if (match) shown++;
        });
        if (empty) empty.hidden = rows.length === 0 || shown > 0;
    });
})();
</script>
@endsection
