@extends('layouts.other-pages')

@section('pageTitle', 'HOD List | OYSCOHEST Result Portal')

@section('content')
<style>
.oys-hod-list{--hl-green:#23643A;--hl-deep:#174A2A;--hl-burgundy:#641510;--hl-gold:#D5AA43;--hl-line:#e1e9e3;--hl-muted:#66756d;max-width:1250px;margin:0 auto;padding:0 0 45px;color:#273b2d}
.oys-hod-list,.oys-hod-list *{box-sizing:border-box}
.oys-hod-list .hl-heading{display:flex;justify-content:space-between;align-items:flex-start;gap:18px;flex-wrap:wrap;margin-bottom:24px}
.oys-hod-list .hl-kicker{display:flex;align-items:center;gap:9px;color:var(--hl-green);font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:1.15px;margin-bottom:8px}
.oys-hod-list .hl-kicker:before{content:"";width:19px;height:3px;border-radius:3px;background:var(--hl-gold)}
.oys-hod-list h1{font-size:clamp(23px,3vw,31px);font-weight:780;color:#243a29;line-height:1.25;margin:0 0 7px}
.oys-hod-list .hl-subtitle{margin:0;font-size:13px;line-height:1.65;color:var(--hl-muted)}
.oys-hod-list .hl-actions{display:flex;flex-wrap:wrap;gap:10px;align-items:center}
.oys-hod-list .hl-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;border-radius:10px;padding:11px 16px;font-size:12px;font-weight:750;border:1px solid transparent;text-decoration:none;cursor:pointer;transition:background .15s ease,transform .15s ease;white-space:nowrap}
.oys-hod-list .hl-btn:hover{text-decoration:none;transform:translateY(-1px)}
.oys-hod-list .hl-primary{background:var(--hl-green);color:#fff;border-color:var(--hl-green)}
.oys-hod-list .hl-primary:hover{background:var(--hl-deep);color:#fff}
.oys-hod-list .hl-secondary{background:#fff;color:var(--hl-deep);border-color:#dce7df}
.oys-hod-list .hl-secondary:hover{background:#f0f7f2;color:var(--hl-deep)}
.oys-hod-list .hl-metric{display:flex;align-items:center;gap:15px;border:1px solid #dbe8df;border-radius:15px;padding:20px 22px;background:linear-gradient(115deg,#fff 45%,#f2faf4);margin-bottom:22px;max-width:360px}
.oys-hod-list .hl-metric-icon{width:50px;height:50px;border-radius:13px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:#e5f3e9;color:var(--hl-green);font-size:20px}
.oys-hod-list .hl-metric-label{font-size:12px;color:var(--hl-muted);margin:0 0 5px}
.oys-hod-list .hl-metric-value{font-size:29px;color:var(--hl-deep);font-weight:850;line-height:1;margin:0}
.oys-hod-list .hl-alert{padding:13px 16px;border-radius:10px;font-size:13px;display:flex;gap:9px;align-items:start;margin-bottom:18px}
.oys-hod-list .hl-alert.success{background:#edf9ef;color:#205d32;border:1px solid #cfe7d5}
.oys-hod-list .hl-alert.error{background:#fff0f0;color:#8a2d2d;border:1px solid #f2cece}
.oys-hod-list .hl-card{background:#fff;border:1px solid var(--hl-line);border-radius:16px;box-shadow:0 9px 30px rgba(22,71,36,.055);overflow:hidden}
.oys-hod-list .hl-card-top{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:15px;padding:22px 24px;border-bottom:1px solid #e9eee9;background:linear-gradient(105deg,#fff 60%,#f5faf6)}
.oys-hod-list .hl-card-title{display:flex;align-items:center;gap:12px}
.oys-hod-list .hl-card-icon{width:43px;height:43px;border-radius:11px;background:#e8f4ea;color:var(--hl-green);display:flex;align-items:center;justify-content:center;font-size:17px}
.oys-hod-list .hl-card-title h2{font-size:16px;font-weight:780;color:#283d2e;margin:0 0 4px}
.oys-hod-list .hl-card-title p{font-size:12px;color:var(--hl-muted);margin:0}
.oys-hod-list .hl-search-wrap{position:relative;width:100%;max-width:320px}
.oys-hod-list .hl-search-wrap i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#849489;font-size:13px;pointer-events:none}
.oys-hod-list .hl-search{width:100%;height:43px;border-radius:10px;border:1px solid #dce7df;padding:0 13px 0 37px;font-size:13px;background:#fff;outline:none;color:#263a2d}
.oys-hod-list .hl-search:focus{border-color:var(--hl-green);box-shadow:0 0 0 3px rgba(35,100,58,.1)}
.oys-hod-list .hl-scroll{overflow-x:auto;width:100%}
.oys-hod-list .hl-table{width:100%;min-width:785px;border-collapse:collapse;margin:0;font-size:13px}
.oys-hod-list .hl-table thead th{text-transform:uppercase;letter-spacing:.6px;font-size:10px;font-weight:800;color:#5d7162;text-align:left;padding:15px 17px;background:#f6f9f6;border-bottom:1px solid #e3ebe5;white-space:nowrap}
.oys-hod-list .hl-table tbody td{padding:15px 17px;border-bottom:1px solid #edf1ed;vertical-align:middle;color:#35483a}
.oys-hod-list .hl-table tbody tr:hover{background:#fafdfa}
.oys-hod-list .hl-table tbody tr:last-child td{border-bottom:0}
.oys-hod-list .hl-index{font-weight:800;color:#899a8c}
.oys-hod-list .hl-name{font-weight:750;color:#263b2e}
.oys-hod-list .hl-programme{display:inline-block;padding:6px 10px;border-radius:8px;background:#f1f6f2;color:#275c38;line-height:1.4;font-size:12px}
.oys-hod-list .hl-signature{width:112px;height:51px;object-fit:contain;border:1px solid #e5ebe7;background:#fff;border-radius:8px;padding:4px}
.oys-hod-list .hl-no-signature{font-size:11px;color:#9b7463;font-style:italic}
.oys-hod-list .hl-row-actions{display:flex;align-items:center;gap:8px}
.oys-hod-list .hl-small-btn{height:34px;min-width:36px;padding:0 10px;border:1px solid #d9e7dd;border-radius:8px;background:#fff;display:inline-flex;justify-content:center;align-items:center;gap:6px;font-size:12px;font-weight:750;color:var(--hl-green);text-decoration:none}
.oys-hod-list .hl-small-btn:hover{background:#edf7ef;color:var(--hl-green);text-decoration:none}
.oys-hod-list .hl-small-btn.danger{color:#9b3535;border-color:#f0d9d9}
.oys-hod-list .hl-small-btn.danger:hover{background:#fff1f1;color:#9b3535}
.oys-hod-list .hl-empty{text-align:center;padding:48px 22px!important;color:var(--hl-muted)!important}
.oys-hod-list .hl-empty i{display:block;font-size:29px;color:#98b7a0;margin-bottom:12px}
.oys-hod-list .hl-footer{border-top:1px solid #e9eee9;padding:14px 24px;display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;font-size:12px;color:var(--hl-muted);background:#fff}
@media(max-width:680px){.oys-hod-list .hl-heading{gap:14px}.oys-hod-list .hl-actions{width:100%}.oys-hod-list .hl-actions .hl-btn{flex:1}.oys-hod-list .hl-card-top{padding:19px 16px}.oys-hod-list .hl-search-wrap{max-width:none}.oys-hod-list .hl-footer{padding:13px 16px}}
</style>

<div class="oys-hod-list" id="oysHodPage">
    <header class="hl-heading">
        <div>
            <div class="hl-kicker">Academic Administration</div>
            <h1>Heads of Department</h1>
            <p class="hl-subtitle">Manage departmental leadership, programme assignments and signatures.</p>
        </div>
        <div class="hl-actions">
            <button type="button" class="hl-btn hl-secondary" id="hlPrintButton"><i class="fas fa-print" aria-hidden="true"></i> Print All</button>
            <a href="{{ route('hod-add') }}" class="hl-btn hl-primary"><i class="fas fa-plus" aria-hidden="true"></i> Add HOD</a>
        </div>
    </header>

    <div class="hl-metric">
        <div class="hl-metric-icon"><i class="fas fa-user-tie" aria-hidden="true"></i></div>
        <div>
            <p class="hl-metric-label">Total Heads of Department</p>
            <p class="hl-metric-value">{{ $allHod->count() }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="hl-alert success" role="status"><i class="fas fa-check-circle" aria-hidden="true"></i><span>{{ session('success') }}</span></div>
    @endif
    @if(session('error'))
        <div class="hl-alert error" role="alert"><i class="fas fa-exclamation-circle" aria-hidden="true"></i><span>{{ session('error') }}</span></div>
    @endif

    <section class="hl-card" aria-label="HOD list">
        <div class="hl-card-top">
            <div class="hl-card-title">
                <div class="hl-card-icon"><i class="fas fa-list" aria-hidden="true"></i></div>
                <div>
                    <h2>HOD Directory</h2>
                    <p>View and update the department heads on record.</p>
                </div>
            </div>
            <div class="hl-search-wrap">
                <i class="fas fa-search" aria-hidden="true"></i>
                <input id="hlSearch" type="search" class="hl-search" placeholder="Search name, department or programme" aria-label="Search HOD directory" autocomplete="off">
            </div>
        </div>

        <div class="hl-scroll">
            <table class="hl-table" id="hlTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">HOD Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Programme</th>
                        <th scope="col">Signature</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allHod as $index => $c)
                        <tr class="hl-data-row">
                            <td class="hl-index">{{ $index + 1 }}</td>
                            <td><span class="hl-name">{{ $c->hod_name }}</span></td>
                            <td>{{ $c->dept }}</td>
                            <td><span class="hl-programme">{{ $c->course }}</span></td>
                            <td>
                                @if(!empty($c->sign))
                                    <img class="hl-signature" src="{{ asset('signature/' . $c->sign) }}" alt="Signature of {{ $c->hod_name }}" loading="lazy" onerror="this.style.display='none';this.nextElementSibling.style.display='inline';">
                                    <span class="hl-no-signature" style="display:none">Not available</span>
                                @else
                                    <span class="hl-no-signature">Not available</span>
                                @endif
                            </td>
                            <td>
                                <div class="hl-row-actions">
                                    <a href="{{ route('hod-edit', ['id' => $c->id]) }}" class="hl-small-btn" aria-label="Edit {{ $c->hod_name }}"><i class="fas fa-edit" aria-hidden="true"></i> Edit</a>
                                    <a href="{{ route('hod-delete', ['id' => $c->id]) }}" class="hl-small-btn danger" aria-label="Delete {{ $c->hod_name }}" onclick="return confirm('Are you sure you want to delete this HOD?');"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="hlEmptyOriginal"><td colspan="6" class="hl-empty"><i class="fas fa-user-tie" aria-hidden="true"></i>No HOD records found. Use Add HOD to create the first record.</td></tr>
                    @endforelse
                    @if($allHod->count() > 0)
                        <tr id="hlNoMatches" style="display:none"><td colspan="6" class="hl-empty"><i class="fas fa-search" aria-hidden="true"></i>No HOD records match your search.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
        <footer class="hl-footer">
            <span id="hlShownCount">Showing {{ $allHod->count() }} of {{ $allHod->count() }} HOD records</span>
            <span>OYSCOHEST · Academic Records</span>
        </footer>
    </section>

    {{-- Dedicated report content: print all records, regardless of live search. --}}
    <div id="hlPrintableReport" hidden>
        <div class="print-head">
            <h1>Oyo State College of Health, Science and Technology</h1>
            <p>Heads of Department — Full Directory</p>
        </div>
        <table>
            <thead><tr><th>#</th><th>HOD Name</th><th>Department</th><th>Programme</th></tr></thead>
            <tbody>
                @forelse($allHod as $index => $c)
                    <tr><td>{{ $index + 1 }}</td><td>{{ $c->hod_name }}</td><td>{{ $c->dept }}</td><td>{{ $c->course }}</td></tr>
                @empty
                    <tr><td colspan="4">No HOD records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
(function () {
    function initialiseHodList() {
        var root = document.getElementById('oysHodPage');
        if (!root || root.dataset.initialised === '1') return;
        root.dataset.initialised = '1';

        var search = document.getElementById('hlSearch');
        var rows = Array.prototype.slice.call(root.querySelectorAll('.hl-data-row'));
        var noMatches = document.getElementById('hlNoMatches');
        var shownCount = document.getElementById('hlShownCount');

        search.addEventListener('input', function () {
            var term = search.value.trim().toLocaleLowerCase();
            var visible = 0;
            rows.forEach(function (row) {
                // Search the human-readable identity fields, not the action links.
                var cells = row.querySelectorAll('td');
                var searchable = [cells[1], cells[2], cells[3]].map(function (cell) { return cell.textContent; }).join(' ').toLocaleLowerCase();
                var matched = searchable.indexOf(term) !== -1;
                row.style.display = matched ? '' : 'none';
                if (matched) visible++;
            });
            if (noMatches) noMatches.style.display = visible ? 'none' : '';
            shownCount.textContent = 'Showing ' + visible + ' of ' + rows.length + ' HOD records';
        });

        document.getElementById('hlPrintButton').addEventListener('click', function () {
            var report = document.getElementById('hlPrintableReport');
            var printWindow = window.open('', '_blank', 'width=1000,height=720');
            if (!printWindow) {
                alert('Your browser blocked the print window. Please allow pop-ups and try again.');
                return;
            }
            printWindow.document.open();
            printWindow.document.write('<!doctype html><html lang="en"><head><meta charset="utf-8"><title>OYSCOHEST — HOD Directory</title><style>@page{size:A4 portrait;margin:16mm}body{font-family:Arial,Helvetica,sans-serif;color:#203629;padding:10px}h1{text-align:center;font-size:19px;margin:0 0 8px}p{text-align:center;margin:0 0 22px;font-size:13px}table{width:100%;border-collapse:collapse;font-size:11px}th,td{border:1px solid #8da393;padding:9px;text-align:left;vertical-align:top}th{background:#ecf4ee}thead{display:table-header-group}tr{break-inside:avoid}</style></head><body>' + report.innerHTML + '</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
        });
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initialiseHodList);
    else initialiseHodList();
})();
</script>
@endsection
