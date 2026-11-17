@extends('layouts.other-pages')
@section('pageTitle', 'Grading System | OYSCOHEST Result Portal')
@section('heading', 'Grading System')
@section('subtitle', 'Grading rules and pass-mark settings')
@section('content')

<style>
.oys-grade{--g:#23643A;--deep:#174A2A;--wine:#641510;--gold:#D5AA43;--line:#dfe9e2;--muted:#637369;max-width:1160px;margin:auto;padding:4px 0 44px;color:#26392d}
.oys-grade,.oys-grade *{box-sizing:border-box}
.oys-grade .g-head{display:flex;justify-content:space-between;gap:18px;align-items:center;flex-wrap:wrap;margin-bottom:22px}
.oys-grade .g-overline{text-transform:uppercase;letter-spacing:.12em;font-size:11px;font-weight:800;color:var(--g);margin-bottom:7px}
.oys-grade h1{color:var(--deep);font-size:clamp(24px,3vw,31px);font-weight:800;margin:0 0 6px}
.oys-grade .g-desc{color:var(--muted);font-size:13px;margin:0;line-height:1.6}
.oys-grade .g-actions{display:flex;gap:9px;flex-wrap:wrap}
.oys-grade .g-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:43px;padding:10px 17px;border-radius:10px;font-size:12px;font-weight:750;border:1px solid var(--line);background:#fff;color:var(--deep);text-decoration:none;cursor:pointer}
.oys-grade .g-btn:hover{text-decoration:none;background:#f0f7f2;color:var(--deep)}
.oys-grade .g-primary{background:var(--g);border-color:var(--g);color:white}
.oys-grade .g-primary:hover{background:var(--deep);color:white}
.oys-grade .g-card{background:#fff;border:1px solid var(--line);border-radius:16px;box-shadow:0 10px 32px rgba(24,76,39,.055);overflow:hidden;margin-bottom:18px}
.oys-grade .g-card-top{padding:22px 25px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;background:linear-gradient(105deg,#f6faf7,#fff);border-bottom:1px solid #edf1ed}
.oys-grade .g-card-title{display:flex;align-items:center;gap:12px}
.oys-grade .g-card-icon{width:43px;height:43px;border-radius:12px;background:#e7f2e9;color:var(--g);display:grid;place-items:center;font-size:18px;flex-shrink:0}
.oys-grade .g-card h2{font-size:16px;font-weight:800;color:var(--deep);margin:0 0 4px}
.oys-grade .g-card-title p{color:var(--muted);font-size:12px;margin:0}
.oys-grade .g-badge{padding:8px 13px;font-size:12px;font-weight:800;border-radius:9px;color:var(--deep);background:#e8f4eb;border:1px solid #cbe3d1}
.oys-grade .g-table-wrap{overflow-x:auto}
.oys-grade table{border-collapse:collapse;width:100%;min-width:570px;font-size:13px;margin:0}
.oys-grade th{padding:15px 17px;background:#f6f9f6;color:#53695a;text-transform:uppercase;letter-spacing:.06em;text-align:left;font-size:11px;border-bottom:1px solid var(--line)}
.oys-grade td{padding:16px 17px;border-bottom:1px solid #edf1ed;color:#304434;vertical-align:middle}
.oys-grade tbody tr:last-child td{border-bottom:0}
.oys-grade tbody tr:hover{background:#fbfdfb}
.oys-grade .g-range{font-weight:800;color:var(--deep)}
.oys-grade .g-grade{display:inline-block;background:#edf5ef;border-radius:7px;color:var(--g);padding:6px 11px;font-weight:800}
.oys-grade .g-note{padding:17px 24px;border-top:1px solid #ebf0ec;font-size:12px;color:var(--muted);line-height:1.65;background:#fcfdfc}
.oys-grade .g-alert{padding:13px 16px;margin-bottom:18px;border-radius:10px;border:1px solid #cde6d3;background:#eef9f0;color:#225e36;font-size:13px}
.oys-grade .g-alert.error{background:#fff2f0;color:#96362b;border-color:#f0d0c9}
.oys-grade .g-body{padding:23px 25px}
.oys-grade .g-input{height:43px;width:100%;padding:9px 12px;border:1px solid #d6e3d9;border-radius:9px;font-size:13px;color:#26392d;background:white}
.oys-grade .g-input:focus{outline:none;border-color:var(--g);box-shadow:0 0 0 3px rgba(35,100,58,.10)}
.oys-grade .g-input-error{font-size:11px;color:#a2382a;display:block;margin-top:5px}
.oys-grade .g-footer{display:flex;gap:10px;justify-content:flex-end;flex-wrap:wrap;padding:18px 25px;border-top:1px solid #edf1ed;background:#fcfdfc}
.oys-grade .g-modal{border:0;border-radius:16px;width:min(94vw,465px);padding:0;box-shadow:0 20px 75px rgba(15,40,25,.22);color:#26392d}
.oys-grade .g-modal::backdrop{background:rgba(15,32,22,.55)}
.oys-grade .g-modal-head{padding:22px 24px;border-bottom:1px solid #e9efe9;display:flex;justify-content:space-between;align-items:center}
.oys-grade .g-modal-head h3{font-size:17px;color:var(--deep);font-weight:800;margin:0}
.oys-grade .g-modal-body{padding:23px 24px}
.oys-grade .g-label{font-size:12px;font-weight:750;margin-bottom:8px;display:block;color:#354c39}
.oys-grade .g-modal-foot{display:flex;justify-content:flex-end;gap:10px;border-top:1px solid #edf0ed;padding:17px 24px}
.oys-grade .g-hint{color:var(--muted);font-size:12px;margin:8px 0 0}
.oys-grade .g-rowlabel{font-weight:800;color:var(--g)}
.oys-grade .g-save-msg{font-size:12px;margin-top:10px;display:block}
@media(max-width:640px){.oys-grade .g-head{align-items:flex-start}.oys-grade .g-actions{width:100%}.oys-grade .g-actions>*{flex:1}.oys-grade .g-card-top,.oys-grade .g-body,.oys-grade .g-footer{padding-left:16px;padding-right:16px}}
</style>
<div class="oys-grade" id="oysGradingPage"><div class="g-head"><div><div class="g-overline">Academic Administration</div><h1>Grading System</h1><p class="g-desc">Manage score ranges, grade points and grade classifications for examination results.</p></div><div class="g-actions"><button type="button" class="g-btn" id="gradePrint"><i class="fas fa-print"></i> Print</button><a href="{{ route('grading-edit') }}" class="g-btn g-primary"><i class="fas fa-edit"></i> Edit Grading</a></div></div>
@if(session('success'))<div class="g-alert" role="status"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif
@if(session('error'))<div class="g-alert error" role="alert"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif
@if($errors->any())<div class="g-alert error" role="alert">Please review the highlighted information and try again.</div>@endif
<section class="g-card"><div class="g-card-top"><div class="g-card-title"><div class="g-card-icon"><i class="fas fa-award"></i></div><div><h2>Current Grade Boundaries</h2><p>Six score bands used in result computation</p></div></div><div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap"><span class="g-badge">Pass Mark: <span id="currentPassMark">{{ $passMark->pass_mark ?? 0 }}%</span></span><button type="button" id="setPassMarkBtn" class="g-btn"><i class="fas fa-sliders-h"></i> Set Pass Mark</button></div></div>
<div class="g-table-wrap"><table id="gradePrintTable"><thead><tr><th>Band</th><th>Score From (%)</th><th>Score To (%)</th><th>Unit / Point</th><th>Letter Grade</th></tr></thead><tbody>
<tr><td class="g-rowlabel">01</td><td class="g-range">{{ $grading->grade01 ?? '—' }}</td><td class="g-range">{{ $grading->grade02 ?? '—' }}</td><td>{{ $grading->unit01 ?? '—' }}</td><td><span class="g-grade">{{ $grading->lgrade1 ?? '—' }}</span></td></tr>
<tr><td class="g-rowlabel">02</td><td class="g-range">{{ $grading->grade11 ?? '—' }}</td><td class="g-range">{{ $grading->grade12 ?? '—' }}</td><td>{{ $grading->unit02 ?? '—' }}</td><td><span class="g-grade">{{ $grading->lgrade2 ?? '—' }}</span></td></tr>
<tr><td class="g-rowlabel">03</td><td class="g-range">{{ $grading->grade21 ?? '—' }}</td><td class="g-range">{{ $grading->grade22 ?? '—' }}</td><td>{{ $grading->unit03 ?? '—' }}</td><td><span class="g-grade">{{ $grading->lgrade3 ?? '—' }}</span></td></tr>
<tr><td class="g-rowlabel">04</td><td class="g-range">{{ $grading->grade31 ?? '—' }}</td><td class="g-range">{{ $grading->grade32 ?? '—' }}</td><td>{{ $grading->unit04 ?? '—' }}</td><td><span class="g-grade">{{ $grading->lgrade4 ?? '—' }}</span></td></tr>
<tr><td class="g-rowlabel">05</td><td class="g-range">{{ $grading->grade41 ?? '—' }}</td><td class="g-range">{{ $grading->grade42 ?? '—' }}</td><td>{{ $grading->unit05 ?? '—' }}</td><td><span class="g-grade">{{ $grading->lgrade5 ?? '—' }}</span></td></tr>
<tr><td class="g-rowlabel">06</td><td class="g-range">{{ $grading->grade51 ?? '—' }}</td><td class="g-range">{{ $grading->grade52 ?? '—' }}</td><td>{{ $grading->unit06 ?? '—' }}</td><td><span class="g-grade">{{ $grading->lgrade6 ?? '—' }}</span></td></tr>
</tbody></table></div><div class="g-note">Changes to grading thresholds may affect future result computation. Verify all six grade ranges before updating them.</div></section>
<dialog id="passMarkModal" class="g-modal" aria-labelledby="passMarkTitle"><div class="g-modal-head"><h3 id="passMarkTitle"><i class="fas fa-bullseye"></i> Set Pass Mark</h3><button type="button" class="g-btn" id="closePassMark" aria-label="Close">&times;</button></div><form id="passMarkForm"><div class="g-modal-body"><label class="g-label" for="pass_mark">Pass Mark (%)</label><input class="g-input" id="pass_mark" name="pass_mark" type="number" step="0.01" min="0" max="100" required value="{{ $passMark->pass_mark ?? 0 }}"><p class="g-hint">Enter a value between 0 and 100.</p><span id="passMarkError" class="g-input-error" role="alert"></span><span id="passMarkMessage" class="g-save-msg" role="status"></span></div><div class="g-modal-foot"><button class="g-btn" type="button" id="cancelPassMark">Cancel</button><button class="g-btn g-primary" id="savePassMark" type="submit"><i class="fas fa-save"></i> Save Pass Mark</button></div></form></dialog>
</div>
<script>
(function(){
const root=document.getElementById('oysGradingPage');if(!root)return;
const modal=root.querySelector('#passMarkModal'),input=root.querySelector('#pass_mark'),error=root.querySelector('#passMarkError'),message=root.querySelector('#passMarkMessage'),save=root.querySelector('#savePassMark'),badge=root.querySelector('#currentPassMark');
const csrf=@json(csrf_token());
const getUrl=@json(route('passmark.get'));const saveUrl=@json(route('passmark.save'));
function openModal(){if(typeof modal.showModal==='function')modal.showModal();else modal.setAttribute('open','');input.focus()}
function closeModal(){if(typeof modal.close==='function')modal.close();else modal.removeAttribute('open')}
root.querySelector('#setPassMarkBtn').addEventListener('click',async()=>{error.textContent='';message.textContent='';try{const res=await fetch(getUrl,{credentials:'same-origin',headers:{'Accept':'application/json','X-Requested-With':'XMLHttpRequest'}});if(!res.ok)throw Error('Unable to load pass mark');const data=await res.json();input.value=data.pass_mark??0;badge.textContent=(data.pass_mark??0)+'%';openModal()}catch(e){error.textContent='Unable to load the saved pass mark. Please try again.';openModal()}});
root.querySelector('#closePassMark').addEventListener('click',closeModal);root.querySelector('#cancelPassMark').addEventListener('click',closeModal);
root.querySelector('#passMarkForm').addEventListener('submit',async(e)=>{e.preventDefault();error.textContent='';message.textContent='';const value=Number(input.value);if(!Number.isFinite(value)||value<0||value>100){error.textContent='Enter a valid percentage between 0 and 100.';return}save.disabled=true;try{const res=await fetch(saveUrl,{method:'POST',credentials:'same-origin',headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json','Content-Type':'application/x-www-form-urlencoded;charset=UTF-8','X-Requested-With':'XMLHttpRequest'},body:new URLSearchParams({pass_mark:String(value)}).toString()});const data=await res.json();if(!res.ok){error.textContent=data.errors?.pass_mark?.[0]||data.message||'Unable to save pass mark.';return}badge.textContent=value+'%';closeModal();}catch(e){error.textContent='Network error. Please try again.'}finally{save.disabled=false}});
root.querySelector('#gradePrint').addEventListener('click',()=>{const rows=root.querySelector('#gradePrintTable').cloneNode(true);const iframe=document.createElement('iframe');iframe.style.cssText='position:fixed;width:0;height:0;border:0;';document.body.appendChild(iframe);const doc=iframe.contentDocument;doc.open();doc.write('<!doctype html><html><head><title>Grading System</title><style>body{font-family:Arial,sans-serif;padding:26px;color:#222}h1{font-size:20px}p{font-size:12px}table{width:100%;border-collapse:collapse;margin-top:20px}th,td{border:1px solid #bbb;padding:10px;text-align:left;font-size:12px}th{background:#eee}</style></head><body><h1>OYSCOHEST — Grading System</h1><p>Pass Mark: '+badge.textContent.replace(/[^0-9.%]/g,'')+'</p></body></html>');doc.close();doc.body.appendChild(rows);iframe.onload=()=>{};iframe.contentWindow.focus();iframe.contentWindow.print();setTimeout(()=>iframe.remove(),1200)});
})();
</script>
@endsection
