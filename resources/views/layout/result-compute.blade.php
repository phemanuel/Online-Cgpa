@extends('layouts.other-pages')

@section('pageTitle', 'Result Computation | OYSCOHEST Result Portal')

@section('content')
<style>
    .rc-page{--green:#23643a;--deep:#174a2a;--brown:#641510;--gold:#d5aa43;--muted:#68766e;--border:#e0e8e2;color:#25372b;max-width:1150px;margin:0 auto;padding-bottom:32px}
    .rc-page *{box-sizing:border-box}
    .rc-head{display:flex;align-items:flex-start;justify-content:space-between;gap:18px;flex-wrap:wrap;margin-bottom:24px}
    .rc-eyebrow{display:flex;align-items:center;gap:9px;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:1.25px;color:var(--green);margin-bottom:10px}
    .rc-eyebrow:before{content:"";height:3px;width:22px;border-radius:2px;background:var(--gold)}
    .rc-head h1{font-weight:800;font-size:clamp(24px,3vw,30px);color:#25382b;margin:0 0 8px;line-height:1.3}
    .rc-head p{font-size:13px;color:var(--muted);margin:0;line-height:1.7;max-width:600px}
    .rc-panel{border:1px solid var(--border);border-radius:16px;background:#fff;box-shadow:0 8px 28px rgba(18,57,32,.05);overflow:hidden}
    .rc-panel-head{padding:23px 27px;border-bottom:1px solid #e9efea;display:flex;gap:14px;align-items:center;justify-content:space-between;flex-wrap:wrap;background:linear-gradient(110deg,#fff,#f7faf7)}
    .rc-panel-title{display:flex;align-items:center;gap:13px}
    .rc-panel-title .rc-icon{width:46px;height:46px;display:grid;place-items:center;background:#eaf5ed;color:var(--green);border-radius:12px;font-size:19px;flex-shrink:0}
    .rc-panel-title h2{font-size:17px;font-weight:800;margin:0 0 4px;color:#27392e}
    .rc-panel-title p{font-size:12px;color:var(--muted);margin:0;line-height:1.6}
    .rc-body{padding:28px}
    .rc-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:23px}
    .rc-field{min-width:0}
    .rc-field label{display:block;font-size:12px;color:#34463b;font-weight:800;margin-bottom:9px}
    .rc-field label i{color:var(--green);margin-right:7px}
    .rc-field select{appearance:none;-webkit-appearance:none;width:100%;min-height:49px;padding:10px 43px 10px 14px;border:1px solid #d9e4db;border-radius:9px;background:#fcfdfc;color:#273c30;font-family:inherit;font-size:13px;font-weight:500;outline:none;box-shadow:none;transition:box-shadow .15s,border-color .15s}
    .rc-field select:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(35,100,58,.12)}
    .rc-field select.is-invalid{border-color:#b52b36}
    .rc-select{position:relative}
    .rc-select:after{content:"";pointer-events:none;position:absolute;right:18px;top:calc(50% - 5px);width:8px;height:8px;border-bottom:2px solid var(--green);border-right:2px solid var(--green);transform:rotate(45deg)}
    .rc-error{display:block;font-size:12px;color:#ae2933;margin-top:7px}
    .rc-footer{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:13px;padding:21px 28px;background:#fafcfa;border-top:1px solid #e9efea}
    .rc-footer-note{font-size:11px;color:var(--muted);line-height:1.6}
    .rc-actions{display:flex;flex-wrap:wrap;gap:9px;align-items:center}
    .rc-page .rc-btn{border:1px solid transparent;border-radius:9px;min-height:42px;display:inline-flex;align-items:center;justify-content:center;gap:9px;padding:10px 15px;font-size:12px;font-weight:800;text-decoration:none;cursor:pointer;transition:.16s ease}
    .rc-page .rc-btn:disabled{opacity:.65;cursor:wait}
    .rc-page .rc-btn-primary{background:var(--green);color:white;border-color:var(--green)}
    .rc-page .rc-btn-primary:hover{background:var(--deep);color:white}
    .rc-page .rc-btn-secondary{background:#fff;border-color:#cbdcd0;color:var(--green)}
    .rc-page .rc-btn-secondary:hover{background:#eaf5ed;color:var(--deep)}
    .rc-page .rc-btn-danger{background:#fff5f4;border-color:#ead0cf;color:var(--brown)}
    .rc-page .rc-btn-danger:hover{background:var(--brown);color:#fff}
    .rc-note{margin-top:18px;padding:17px 20px;border:1px solid #dfebdf;border-radius:11px;background:#f5faf6;display:flex;align-items:flex-start;gap:13px;color:#516b59;font-size:12px;line-height:1.8}
    .rc-note i{color:var(--green);font-size:17px;margin-top:3px}
    .rc-modal .modal-content{border:0;border-radius:15px;overflow:hidden}
    .rc-modal .modal-header{background:#f7faf7;border-bottom:1px solid #e5ebe6;padding:20px 24px;align-items:center}
    .rc-modal .modal-title{font-weight:800;font-size:17px;color:var(--deep)}
    .rc-modal .modal-body{padding:24px}
    .rc-modal .modal-footer{border-top:1px solid #e5ebe6;padding:16px 24px}
    .rc-modal .form-control{height:46px;width:100%;border:1px solid #d9e4db;border-radius:9px;font-size:13px}
    .rc-modal label{font-size:12px;font-weight:700;color:#334b3a}
    .rc-alert{font-size:12px;padding:12px 15px;border-radius:9px;line-height:1.7}
    .rc-delete-detail{padding:13px 15px;background:#faf5f4;border:1px solid #efd8d5;border-radius:9px;font-size:13px;line-height:1.9;color:#4d3633}
    .rc-modal .rc-btn{border:1px solid transparent;border-radius:8px;padding:10px 15px;font-size:12px;font-weight:700;cursor:pointer}
    .rc-modal .rc-btn-danger{background:#641510;color:#fff}
    .rc-modal .rc-btn-secondary{background:#f0f4f0;color:#27402e}
    .rc-modal .rc-btn:disabled{opacity:.65;cursor:wait}
    @media(max-width:700px){.rc-grid{grid-template-columns:1fr;gap:18px}.rc-panel-head,.rc-body,.rc-footer{padding:20px}.rc-footer{align-items:stretch;flex-direction:column}.rc-actions{width:100%}.rc-actions .rc-btn{flex:1}.rc-head{margin-bottom:19px}}
    @media(max-width:410px){.rc-actions{flex-direction:column}.rc-actions .rc-btn{width:100%}}
</style>

<div class="rc-page">
    <div class="rc-head">
        <div>
            <div class="rc-eyebrow">Academic Records</div>
            <h1>Result Computation</h1>
            <p>Select the academic criteria to compute, preview, or manage previously computed results.</p>
        </div>
    </div>

    <section class="rc-panel" aria-labelledby="rc-form-title">
        <div class="rc-panel-head">
            <div class="rc-panel-title">
                <div class="rc-icon"><i class="fas fa-calculator" aria-hidden="true"></i></div>
                <div>
                    <h2 id="rc-form-title">Compute Student Results</h2>
                    <p>Choose all four academic criteria before proceeding.</p>
                </div>
            </div>
            @if(in_array((int) auth()->user()->id, [1,14], true))
                <button type="button" class="rc-btn rc-btn-secondary" data-toggle="modal" data-target="#summaryModal">
                    <i class="fas fa-list-alt" aria-hidden="true"></i> View Summary
                </button>
            @endif
        </div>

        <form id="resultComputeForm" action="{{ route('result-compute-action') }}" method="POST">
            @csrf
            <div class="rc-body">
                <div class="rc-grid">
                    <div class="rc-field">
                        <label for="programme"><i class="fas fa-graduation-cap" aria-hidden="true"></i> Programme *</label>
                        <div class="rc-select">
                            <select name="programme" id="programme" required class="@error('programme') is-invalid @enderror">
                                <option value="" disabled {{ old('programme') ? '' : 'selected' }}>Select programme</option>
                                @foreach($programmes as $d)
                                    <option value="{{ $d->department }}" {{ old('programme') == $d->department ? 'selected' : '' }}>{{ $d->department }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('programme')<span class="rc-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="rc-field">
                        <label for="acad_session"><i class="far fa-calendar-alt" aria-hidden="true"></i> Admission Year *</label>
                        <div class="rc-select">
                            <select name="acad_session" id="acad_session" required class="@error('acad_session') is-invalid @enderror">
                                <option value="" disabled {{ old('acad_session') ? '' : 'selected' }}>Select admission year</option>
                                @for($year = (int)date('Y'); $year >= 2018; $year--)
                                    <option value="{{ $year }}" {{ (string)old('acad_session') === (string)$year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        @error('acad_session')<span class="rc-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="rc-field">
                        <label for="stdLevel"><i class="fas fa-layer-group" aria-hidden="true"></i> Academic Level *</label>
                        <div class="rc-select">
                            <select name="stdLevel" id="stdLevel" required class="@error('stdLevel') is-invalid @enderror">
                                <option value="" disabled {{ old('stdLevel') ? '' : 'selected' }}>Select academic level</option>
                                @foreach($allLevel as $d)
                                    <option value="{{ $d->level }}" {{ old('stdLevel') == $d->level ? 'selected' : '' }}>{{ $d->level }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('stdLevel')<span class="rc-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                    <div class="rc-field">
                        <label for="semester"><i class="fas fa-book-open" aria-hidden="true"></i> Semester *</label>
                        <div class="rc-select">
                            <select name="semester" id="semester" required class="@error('semester') is-invalid @enderror">
                                <option value="FIRST" {{ old('semester','FIRST') === 'FIRST' ? 'selected' : '' }}>FIRST</option>
                                <option value="SECOND" {{ old('semester') === 'SECOND' ? 'selected' : '' }}>SECOND</option>
                            </select>
                        </div>
                        @error('semester')<span class="rc-error" role="alert">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="rc-footer">
                <span class="rc-footer-note"><i class="fas fa-info-circle" aria-hidden="true"></i> Computation will use the selected programme, year, level, and semester.</span>
                <div class="rc-actions">
                    <button type="button" id="previewBtn" class="rc-btn rc-btn-secondary"><i class="fas fa-eye" aria-hidden="true"></i> Preview Result</button>
                    <button type="button" id="deleteBtn" class="rc-btn rc-btn-danger"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete Computation</button>
                    <button type="submit" class="rc-btn rc-btn-primary"><i class="fas fa-calculator" aria-hidden="true"></i> Compute Result</button>
                </div>
            </div>
        </form>
    </section>
    <div class="rc-note"><i class="fas fa-shield-alt" aria-hidden="true"></i><span><strong>Important:</strong> Deleting a result computation affects records matching the selected criteria. Verify the selection before confirming a deletion.</span></div>
</div>

{{-- Summary access follows the original view restriction (IDs 1 and 14). The endpoint must enforce its own authorization. --}}
@if(in_array((int) auth()->user()->id, [1,14], true))
<div class="modal fade rc-modal" id="summaryModal" tabindex="-1" role="dialog" aria-labelledby="summaryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="summaryModalLabel"><i class="fas fa-list-alt mr-2"></i> Result Computation Summary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <label for="sessionFilter">Select Session</label>
                <select id="sessionFilter" name="session1" class="form-control">
                    <option value="">Select academic session</option>
                    @for($year=(int)date('Y'); $year>=2018; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
                <div id="summaryContent" class="mt-3" aria-live="polite">
                    <div class="rc-alert" style="background:#f3f7f4;color:#59715f">Select a session to view the summary.</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade rc-modal" id="deleteComputeModal" tabindex="-1" role="dialog" aria-labelledby="deleteComputeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteComputeLabel" style="color:#641510"><i class="fas fa-exclamation-triangle mr-2"></i> Delete Result Computation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p style="font-size:13px;color:#5f6961;line-height:1.8">This will delete the result computation for the selected criteria. This action may not be reversible.</p>
                <div id="deleteCriteria" class="rc-delete-detail"></div>
                <div id="deleteError" class="rc-alert mt-3" role="alert" style="display:none;background:#fff2f1;color:#8a2923"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="rc-btn rc-btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDeleteBtn" class="rc-btn rc-btn-danger"><i class="fas fa-trash-alt mr-1"></i> Confirm Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';
    const form = document.getElementById('resultComputeForm');
    const fields = ['programme', 'acad_session', 'stdLevel', 'semester'];
    const getCriteria = () => Object.fromEntries(fields.map(key => [key, form.elements[key].value]));
    const valid = () => form.reportValidity();
    const preview = document.getElementById('previewBtn');
    const deleteBtn = document.getElementById('deleteBtn');
    const confirmDelete = document.getElementById('confirmDeleteBtn');
    const errorBox = document.getElementById('deleteError');

    preview.addEventListener('click', function () {
        if (!valid()) return;
        const url = new URL(@json(route('result-compute-preview')), window.location.origin);
        Object.entries(getCriteria()).forEach(([key, value]) => url.searchParams.set(key, value));
        window.location.assign(url.toString());
    });

    deleteBtn.addEventListener('click', function () {
        if (!valid()) return;
        const details = getCriteria();
        document.getElementById('deleteCriteria').replaceChildren();
        const labels = {programme:'Programme', acad_session:'Admission Year', stdLevel:'Academic Level', semester:'Semester'};
        const container = document.getElementById('deleteCriteria');
        fields.forEach(key => {
            const line = document.createElement('div');
            const label = document.createElement('strong');
            label.textContent = labels[key] + ': ';
            line.append(label, document.createTextNode(details[key]));
            container.appendChild(line);
        });
        errorBox.style.display = 'none';
        if (window.jQuery && jQuery.fn.modal) jQuery('#deleteComputeModal').modal('show');
        else if (window.confirm('Delete result computation for the selected criteria?')) performDelete();
    });

    async function performDelete() {
        const criteria = getCriteria();
        confirmDelete.disabled = true;
        const previousLabel = confirmDelete.innerHTML;
        confirmDelete.textContent = 'Deleting...';
        errorBox.style.display = 'none';
        try {
            const response = await fetch(@json(route('result-compute-delete')), {
                method: 'POST',
                headers: {'Content-Type':'application/json','Accept':'application/json','X-Requested-With':'XMLHttpRequest','X-CSRF-TOKEN': @json(csrf_token())},
                body: JSON.stringify(criteria)
            });
            const type = response.headers.get('content-type') || '';
            const data = type.includes('application/json') ? await response.json() : {};
            if (!response.ok || data.success === false) {
                throw new Error(data.message || 'The deletion was not completed.');
            }
            if (window.jQuery && jQuery.fn.modal) jQuery('#deleteComputeModal').modal('hide');
            window.alert(data.message || 'Result computation deleted successfully.');
            window.location.reload();
        } catch (error) {
            errorBox.textContent = error.message || 'Unable to delete the computation.';
            errorBox.style.display = 'block';
        } finally {
            confirmDelete.disabled = false;
            confirmDelete.innerHTML = previousLabel;
        }
    }
    confirmDelete.addEventListener('click', performDelete);

    const sessionFilter = document.getElementById('sessionFilter');
    if (sessionFilter) {
        const summaryContent = document.getElementById('summaryContent');
        let currentRequest = null;
        sessionFilter.addEventListener('change', async function () {
            if (currentRequest) currentRequest.abort();
            if (!this.value) {
                summaryContent.textContent = 'Select a session to view the summary.';
                return;
            }
            const controller = new AbortController();
            currentRequest = controller;
            summaryContent.textContent = 'Loading summary...';
            try {
                const url = new URL(@json(route('fetch.results.summary')), window.location.origin);
                url.searchParams.set('session1', this.value);
                const response = await fetch(url.toString(), {headers: {'X-Requested-With':'XMLHttpRequest'}, signal: controller.signal});
                if (!response.ok) throw new Error('Unable to load summary.');
                summaryContent.innerHTML = await response.text(); // Existing route returns trusted server-rendered HTML.
            } catch (error) {
                if (error.name !== 'AbortError') summaryContent.textContent = 'Unable to load summary.';
            }
        });
    }
});
</script>
@endsection
