@extends('layouts.other-pages')

@section('pageTitle', 'Result Entry | OYSCOHEST Result Portal')
@section('heading', 'Result Entry')
@section('subtitle', 'Select the academic criteria to access student result entry.')
@section('headerCaption', 'Academic Results')

@push('styles')
<style>
    .re-page{--re-green:#23643a;--re-dark:#174a2a;--re-brown:#641510;--re-gold:#d5aa43;--re-border:#e1e9e3;--re-muted:#6d7c72;max-width:1080px}
    .re-page *,.re-page *::before,.re-page *::after{box-sizing:border-box}
    .re-card{background:#fff;border:1px solid var(--re-border);border-radius:18px;overflow:hidden;box-shadow:0 10px 35px rgba(31,72,44,.05)}
    .re-card-head{padding:23px 27px;display:flex;align-items:center;justify-content:space-between;gap:15px;flex-wrap:wrap;background:linear-gradient(110deg,#fff,#f6faf7);border-bottom:1px solid var(--re-border)}
    .re-head-label{display:flex;align-items:center;gap:14px}
    .re-head-icon{width:47px;height:47px;flex-shrink:0;background:#eaf5ed;color:var(--re-green);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px}
    .re-card-title{margin:0 0 4px;color:#24392a;font-size:17px;font-weight:750}
    .re-card-note{margin:0;font-size:12px;color:var(--re-muted);line-height:1.7}
    .re-summary-btn,.re-back-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;border:1px solid #cfe1d4;background:#fff;color:var(--re-green)!important;border-radius:9px;padding:10px 14px;font-size:12px;font-weight:700;text-decoration:none!important;cursor:pointer}
    .re-summary-btn:hover,.re-back-btn:hover{background:#eaf5ed;border-color:var(--re-green)}
    .re-body{padding:29px 27px 25px}
    .re-section-label{display:flex;gap:9px;align-items:center;color:var(--re-brown);font-size:11px;font-weight:800;letter-spacing:.9px;text-transform:uppercase;margin-bottom:20px}
    .re-section-label::before{content:"";height:3px;width:19px;background:var(--re-gold);border-radius:9px}
    .re-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:24px}
    .re-field{min-width:0}
    .re-field label{display:block;font-weight:700;font-size:12px;color:#34483a;margin:0 0 9px}
    .re-required{color:var(--re-brown)}
    .re-select-wrap{position:relative}
    .re-select-wrap::after{content:"";position:absolute;right:18px;top:50%;width:8px;height:8px;border-right:2px solid var(--re-green);border-bottom:2px solid var(--re-green);transform:translateY(-70%) rotate(45deg);pointer-events:none}
    .re-select{appearance:none;-webkit-appearance:none;background:#fcfdfc;border:1px solid #d8e2da;border-radius:10px;color:#2d3c31;padding:12px 42px 12px 15px;width:100%;height:51px;font:inherit;font-size:13px;outline:none;transition:.2s}
    .re-select:focus{background:#fff;border-color:var(--re-green);box-shadow:0 0 0 4px rgba(35,100,58,.09)}
    .re-select.is-invalid{border-color:#bd3542}
    .re-error{display:block;margin-top:7px;color:#b42335;font-size:12px}
    .re-field-help{color:#829087;font-size:11px;line-height:1.7;margin-top:8px}
    .re-actions{padding:20px 27px;border-top:1px solid #e8eee9;background:#fbfdfb;display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap}
    .re-footnote{font-size:11px;color:var(--re-muted);display:flex;gap:8px;align-items:center}
    .re-footnote i{color:var(--re-green)}
    .re-actions-right{display:flex;gap:11px;align-items:center;flex-wrap:wrap}
    .re-primary{display:inline-flex;align-items:center;justify-content:center;gap:11px;background:var(--re-green);color:#fff!important;border:1px solid var(--re-green);border-radius:9px;padding:12px 22px;min-height:45px;font-size:12px;font-weight:750;cursor:pointer}
    .re-primary:hover{background:var(--re-dark);border-color:var(--re-dark);box-shadow:0 6px 18px rgba(35,100,58,.16)}
    .re-danger{display:inline-flex;align-items:center;justify-content:center;gap:9px;background:#fff;color:#a93236!important;border:1px solid #e9c5c7;border-radius:9px;padding:11px 15px;min-height:45px;font-size:12px;font-weight:700;cursor:pointer}
    .re-danger:hover{background:#fff0f0;border-color:#bf484b}
    .re-danger:disabled{opacity:.55;cursor:wait}
    .re-primary:focus-visible,.re-danger:focus-visible,.re-summary-btn:focus-visible{outline:3px solid rgba(35,100,58,.28);outline-offset:3px}
    .re-helpbox{display:flex;gap:13px;align-items:flex-start;margin-top:19px;padding:17px 19px;border:1px solid #dbe9de;border-radius:12px;background:#f6faf7;color:#657969;font-size:12px;line-height:1.8}
    .re-helpbox i{font-size:19px;color:var(--re-green);margin-top:2px}
    .re-helpbox strong{color:#265336}
    .re-modal .modal-content{border:0;border-radius:16px;overflow:hidden;box-shadow:0 18px 56px rgba(0,0,0,.14)}
    .re-modal .modal-header{background:#f5faf6;border-bottom:1px solid #e2ece4;padding:21px 25px;align-items:center}
    .re-modal .modal-title{font-size:17px;font-weight:750;color:#294c32}
    .re-modal .modal-body{padding:25px}
    .re-modal .modal-footer{padding:17px 25px;border-top:1px solid #e8eee9}
    .re-modal .form-control{border-radius:9px;border:1px solid #d8e2da;height:46px;font-size:13px}
    .re-modal .form-control:focus{border-color:var(--re-green);box-shadow:0 0 0 3px rgba(35,100,58,.1)}
    .re-modal label{font-weight:700;font-size:12px;color:#34483a}
    .re-modal-status{border-radius:9px;background:#f7faf8;border:1px dashed #d5e5d9;color:#687a6d;padding:22px;text-align:center;font-size:13px}
    .re-delete-info{padding:13px 14px;background:#fff5f2;border:1px solid #efd2cb;border-radius:9px;font-size:12px;line-height:1.8;color:#744137}
    .re-delete-info strong{color:#641510}
    @media(max-width:767px){.re-grid{grid-template-columns:1fr;gap:20px}.re-body{padding:22px 19px}.re-card-head{padding:20px 19px}.re-actions{padding:18px 19px;align-items:stretch;flex-direction:column}.re-actions-right{width:100%}.re-primary,.re-danger{flex:1}.re-modal .modal-body{padding:18px}}
    @media(prefers-reduced-motion:reduce){.re-page *{transition:none!important}}
</style>
@endpush

@section('content')
<div class="re-page">
    <div class="re-card">
        <div class="re-card-head">
            <div class="re-head-label">
                <div class="re-head-icon"><i class="fas fa-clipboard-list" aria-hidden="true"></i></div>
                <div>
                    <h2 class="re-card-title">Select Result Criteria</h2>
                    <p class="re-card-note">Choose the programme, admission year, level and semester.</p>
                </div>
            </div>

            {{-- Preserve original account-specific Summary visibility. Backend must enforce access too. --}}
            @if(in_array((int) auth()->id(), [1, 14], true))
                <button type="button" class="re-summary-btn" data-toggle="modal" data-target="#summaryModal">
                    <i class="fas fa-chart-bar" aria-hidden="true"></i> Result Entry Summary
                </button>
            @endif
        </div>

        <form action="{{ route('result-entry-admin.view') }}" method="GET" id="resultEntryForm">
            <div class="re-body">
                <div class="re-section-label">Academic information</div>
                <div class="re-grid">
                    <div class="re-field">
                        <label for="programme">Programme <span class="re-required">*</span></label>
                        <div class="re-select-wrap">
                            <select name="programme" id="programme" class="re-select @error('programme') is-invalid @enderror" required>
                                <option value="">Select a programme</option>
                                @foreach($programmes as $d)
                                    <option value="{{ $d->department }}" {{ old('programme', request('programme')) == $d->department ? 'selected' : '' }}>{{ $d->department }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('programme')<span class="re-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="re-field">
                        <label for="acad_session">Admission Year <span class="re-required">*</span></label>
                        <div class="re-select-wrap">
                            <select name="acad_session" id="acad_session" class="re-select @error('acad_session') is-invalid @enderror" required>
                                <option value="">Select admission year</option>
                                @for($year = (int) date('Y'); $year >= 2018; $year--)
                                    <option value="{{ $year }}" {{ (string)old('acad_session', request('acad_session')) === (string)$year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        @error('acad_session')<span class="re-error">{{ $message }}</span>@enderror
                        <p class="re-field-help">The year the students were admitted.</p>
                    </div>
                    <div class="re-field">
                        <label for="stdLevel">Academic Level <span class="re-required">*</span></label>
                        <div class="re-select-wrap">
                            <select name="stdLevel" id="stdLevel" class="re-select @error('stdLevel') is-invalid @enderror" required>
                                <option value="">Select academic level</option>
                                @foreach($allLevel as $d)
                                    <option value="{{ $d->level }}" {{ old('stdLevel', request('stdLevel')) == $d->level ? 'selected' : '' }}>{{ $d->level }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('stdLevel')<span class="re-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="re-field">
                        <label for="semester">Semester <span class="re-required">*</span></label>
                        <div class="re-select-wrap">
                            <select name="semester" id="semester" class="re-select @error('semester') is-invalid @enderror" required>
                                <option value="FIRST" {{ old('semester', request('semester', 'FIRST')) === 'FIRST' ? 'selected' : '' }}>First Semester</option>
                                <option value="SECOND" {{ old('semester', request('semester')) === 'SECOND' ? 'selected' : '' }}>Second Semester</option>
                            </select>
                        </div>
                        @error('semester')<span class="re-error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="re-actions">
                <div class="re-footnote"><i class="fas fa-info-circle" aria-hidden="true"></i> All four criteria are required.</div>
                <div class="re-actions-right">
                    <button type="button" class="re-danger" id="deleteResultsBtn"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete Results</button>
                    <button type="submit" class="re-primary"><span>Proceed to Result Entry</span><i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="re-helpbox"><i class="fas fa-shield-alt" aria-hidden="true"></i><div><strong>Result records</strong><br>Verify the selected programme, admission year, academic level, and semester before proceeding. Deleting results permanently removes records for the selected criteria if permitted by the server.</div></div>
</div>

{{-- Summary modal: same IDs / endpoint / session1 parameter as original. --}}
@if(in_array((int) auth()->id(), [1, 14], true))
<div class="modal fade re-modal" id="summaryModal" tabindex="-1" role="dialog" aria-labelledby="summaryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="summaryModalLabel"><i class="fas fa-chart-bar mr-2" aria-hidden="true"></i> Result Entry Summary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="sessionFilter">Select Academic Session</label>
                    <select id="sessionFilter" name="session1" class="form-control">
                        <option value="">Select academic session</option>
                        @for($year = (int) date('Y'); $year >= 2018; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div id="summaryContent" class="re-modal-status" role="status" aria-live="polite">Select an academic session to view the summary.</div>
            </div>
            <div class="modal-footer"><button type="button" class="re-back-btn" data-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>
@endif

{{-- A confirmation modal prevents the destructive action from being triggered accidentally. --}}
<div class="modal fade re-modal" id="deleteResultsModal" tabindex="-1" role="dialog" aria-labelledby="deleteResultsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title" id="deleteResultsTitle" style="color:#641510"><i class="fas fa-exclamation-triangle mr-2" aria-hidden="true"></i> Delete Selected Results?</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <div class="modal-body">
                <p style="font-size:13px;color:#4d5a50">You are about to delete results matching these exact criteria:</p>
                <div class="re-delete-info" id="deleteCriteriaDisplay"></div>
                <p class="mt-3 mb-0" style="font-size:12px;color:#a33237;font-weight:700">This action cannot be undone.</p>
                <div id="deleteResultsError" class="alert alert-danger mt-3 mb-0" role="alert" style="display:none"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="re-back-btn" data-dismiss="modal">Cancel</button>
                <button type="button" class="re-danger" id="confirmDeleteResults"><i class="fas fa-trash-alt" aria-hidden="true"></i> Yes, Delete Results</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';
    const form = document.getElementById('resultEntryForm');
    const deleteBtn = document.getElementById('deleteResultsBtn');
    const confirmBtn = document.getElementById('confirmDeleteResults');
    const details = document.getElementById('deleteCriteriaDisplay');
    const errorBox = document.getElementById('deleteResultsError');
    const sessionFilter = document.getElementById('sessionFilter');
    const summaryContent = document.getElementById('summaryContent');
    let activeSummaryRequest = null;

    function selected() {
        const read = id => document.getElementById(id).value;
        return {
            programme: read('programme'),
            admission_year: read('acad_session'),
            level: read('stdLevel'),
            semester: read('semester')
        };
    }
    function validCriteria() {
        if (!form.checkValidity()) {
            form.reportValidity();
            return false;
        }
        return true;
    }
    if (deleteBtn && confirmBtn && details) {
        deleteBtn.addEventListener('click', function () {
            if (!validCriteria()) return;
            const data = selected();
            details.replaceChildren();
            const rows = [
                ['Programme', data.programme], ['Admission Year', data.admission_year],
                ['Academic Level', data.level], ['Semester', data.semester]
            ];
            rows.forEach(([label, value]) => {
                const div = document.createElement('div');
                const strong = document.createElement('strong');
                strong.textContent = label + ': ';
                div.append(strong, document.createTextNode(value));
                details.appendChild(div);
            });
            errorBox.style.display = 'none';
            window.jQuery('#deleteResultsModal').modal('show');
        });
        confirmBtn.addEventListener('click', async function () {
            if (!validCriteria()) return;
            const token = document.querySelector('meta[name="csrf-token"]')?.content;
            if (!token) {
                errorBox.textContent = 'Security token unavailable. Please reload and try again.';
                errorBox.style.display = 'block';
                return;
            }
            confirmBtn.disabled = true;
            const original = confirmBtn.innerHTML;
            confirmBtn.textContent = 'Deleting results...';
            errorBox.style.display = 'none';
            try {
                const response = await fetch(@json(route('admin.results.delete')), {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': token },
                    credentials: 'same-origin',
                    body: JSON.stringify(selected())
                });
                const data = await response.json();
                if (!response.ok || data.success === false) throw new Error(data.message || 'Unable to delete the selected results.');
                window.jQuery('#deleteResultsModal').modal('hide');
                window.alert(data.message || 'Results deleted successfully.');
                window.location.reload();
            } catch (error) {
                errorBox.textContent = error.message || 'Something went wrong. Please try again.';
                errorBox.style.display = 'block';
            } finally {
                confirmBtn.disabled = false;
                confirmBtn.innerHTML = original;
            }
        });
    }

    if (sessionFilter && summaryContent) {
        sessionFilter.addEventListener('change', async function () {
            if (activeSummaryRequest) activeSummaryRequest.abort();
            const session = sessionFilter.value;
            if (!session) { summaryContent.textContent = 'Select an academic session to view the summary.'; return; }
            summaryContent.textContent = 'Loading summary...';
            activeSummaryRequest = new AbortController();
            const query = new URLSearchParams({ session1: session });
            try {
                const response = await fetch(@json(route('admin.results.summary')) + '?' + query.toString(), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'text/html' },
                    credentials: 'same-origin', signal: activeSummaryRequest.signal
                });
                if (!response.ok) throw new Error('Could not load the summary.');
                summaryContent.classList.remove('re-modal-status');
                // This endpoint is expected to return trusted, server-rendered HTML as in the original page.
                summaryContent.innerHTML = await response.text();
            } catch (error) {
                if (error.name === 'AbortError') return;
                summaryContent.classList.add('re-modal-status');
                summaryContent.textContent = 'Unable to load the summary. Please try again.';
            }
        });
    }
})();
</script>
@endpush
