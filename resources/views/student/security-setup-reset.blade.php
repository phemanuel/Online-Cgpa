<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Security Question Setup | OYSCOHEST E-Result</title>
<link rel="icon" href="{{ asset('loginback/vendor/images/favicon.png') }}">
<link rel="stylesheet" href="{{ asset('login/css/opensans-font.css') }}">
<style>
:root{--green:#23643a;--deep:#174a2a;--burgundy:#641510;--gold:#d5aa43;--ink:#1d3025;--muted:#627568;--line:#dfe8df;--bg:#f5f8f4}
*{box-sizing:border-box}html,body{margin:0;min-height:100%;font-family:"Open Sans",Arial,sans-serif;color:var(--ink)}
body{background:linear-gradient(130deg,rgba(23,74,42,.87),rgba(100,21,16,.62)),url('{{ asset('login/images/login-bg.jpg') }}') center/cover fixed}
.security-shell{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:36px 18px}
.security-card{display:grid;grid-template-columns:minmax(260px,.85fr) minmax(0,1.15fr);width:min(940px,100%);background:#fff;border-radius:22px;overflow:hidden;box-shadow:0 24px 75px rgba(8,35,19,.28)}
.security-aside{background:linear-gradient(165deg,#174a2a,#23643a 70%,#164025);padding:38px 34px;display:flex;flex-direction:column;position:relative;min-height:510px;color:#fff;overflow:hidden}
.security-aside:after{content:"";position:absolute;right:-100px;bottom:-120px;width:280px;height:280px;border:50px solid rgba(213,170,67,.13);border-radius:50%;pointer-events:none}
.brand{display:flex;align-items:center;gap:12px;position:relative;z-index:1}.brand img{width:48px;height:48px;object-fit:contain;background:#fff;border-radius:12px;padding:5px}.brand span{font-weight:800;font-size:15px;line-height:1.35}.brand small{display:block;color:#d2e3d6;font-weight:500;font-size:12px;margin-top:3px}
.security-aside .visual{margin:auto 0 25px;position:relative;z-index:1}.security-aside .visual img{width:100%;max-height:240px;object-fit:contain;border-radius:12px}.security-aside h2{font-size:27px;margin:0 0 10px;line-height:1.2}.security-aside p{font-size:14px;color:#e0e9e0;line-height:1.7;margin:0}.accent{width:48px;height:4px;border-radius:9px;background:var(--gold);margin-bottom:18px}
.security-main{padding:44px 48px}.eyebrow{font-size:11px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--green);margin:0 0 12px}.security-main h1{font-size:27px;line-height:1.2;margin:0 0 12px;font-weight:800}.intro{font-size:13.5px;color:var(--muted);line-height:1.65;margin:0 0 24px}
.question{padding:20px;border:1px solid var(--line);background:#fbfcfa;border-radius:15px;margin-bottom:17px}.question-title{font-size:12px;color:var(--green);font-weight:800;letter-spacing:.035em;margin:0 0 12px}.question-text{font-size:14px;font-weight:700;line-height:1.5;margin-bottom:14px}.field{margin-bottom:16px}.field:last-child{margin-bottom:0}.field label{display:block;font-size:12px;font-weight:750;margin-bottom:8px}.field input,.field select{display:block;width:100%;min-height:45px;border:1px solid #cad9cc;border-radius:9px;background:#fff;padding:10px 13px;font-size:14px;color:var(--ink);outline:none;transition:border-color .2s,box-shadow .2s}.field select{padding-right:24px}.field input:focus,.field select:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(35,100,58,.13)}.field input.is-invalid,.field select.is-invalid{border-color:#b52c2c}.invalid{color:#ac2727;font-size:12px;margin-top:6px;display:block}
.note{font-size:12px;color:#5b6d5e;line-height:1.55;margin:0 0 21px;padding:12px 14px;border-left:3px solid var(--gold);background:#fff9eb;border-radius:0 9px 9px 0}
.alertbox{border-radius:10px;padding:12px 14px;margin-bottom:17px;font-size:13px;line-height:1.5}.alertbox.error{color:#842b27;background:#fff0ef;border:1px solid #f4c9c5}.alertbox.success{color:#175c32;background:#eaf7ee;border:1px solid #b9e2c8}
.submit{width:100%;border:0;border-radius:10px;background:var(--green);color:#fff;min-height:47px;padding:12px 18px;font-size:14px;font-weight:750;cursor:pointer;margin-top:8px}.submit:hover{background:var(--deep)}.back{text-align:center;margin-top:19px}.back a{color:var(--burgundy);font-size:13px;font-weight:700;text-decoration:none}.back a:hover{text-decoration:underline}.status{display:none;color:#9c2f25;font-size:12px;margin-bottom:12px}.status.visible{display:block}
@@media(max-width:750px){.security-shell{padding:18px 12px}.security-card{grid-template-columns:1fr}.security-aside{min-height:0;padding:22px 25px}.security-aside .visual{display:none}.security-aside .accent{margin-top:24px}.security-aside h2{font-size:19px}.security-aside p{font-size:12px}.security-main{padding:30px 24px}.security-main h1{font-size:24px}}
@@media(max-width:400px){.security-main{padding:24px 18px}.question{padding:15px}.security-shell{padding:10px}}
</style>
</head>
<body>
<main class="security-shell">
<div class="security-card">
<aside class="security-aside">
<div class="brand"><img src="{{ asset('dashboard/assets/img/logo.png') }}" alt="College logo"><span>OYSCOHEST<small>E-Result Student Portal</small></span></div>
<div class="visual"><img src="{{ asset('login/images/form-v7.jpg') }}" alt="Student account security"></div>
<div><div class="accent"></div><h2>Secure your account</h2><p>Your account information deserves careful protection. Follow the steps to continue securely.</p></div>
</aside>
<section class="security-main" aria-labelledby="security-title">
<p class="eyebrow">Student account security</p>
<h1 id="security-title">Set up security questions</h1>
<p class="intro">Choose memorable answers for both questions to help recover your account.</p>
<form id="security-setup-form" action="{{ route('student.password.security.setup.save') }}" method="POST">
@csrf
@if(session('success'))<div class="alertbox success" role="status">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alertbox error" role="alert">{{ session('error') }}</div>@endif
@if($errors->any())<div class="alertbox error" role="alert">Please review the highlighted fields and try again.</div>@endif
<p class="note">Choose <strong>two different security questions</strong> and enter answers you can remember. These will help you recover your account if you forget your password.</p>
<div class="question">
<p class="question-title">Security question 1</p>
<div class="field">
<label for="security_question_1">Select question</label>
<select name="security_question[]" id="security_question_1" required class="@error('security_question.0') is-invalid @enderror">
<option value="">-- Select a question --</option>
@foreach($questions as $question)
<option value="{{ $question }}" @selected(old('security_question.0') == $question)>{{ $question }}</option>
@endforeach
</select>
@error('security_question.0')<span class="invalid">{{ $message }}</span>@enderror
</div>
<div class="field">
<label for="security_answer_1">Your answer</label>
<input type="text" name="security_answer[]" id="security_answer_1" autocomplete="off" required value="{{ old('security_answer.0') }}" class="@error('security_answer.0') is-invalid @enderror">
@error('security_answer.0')<span class="invalid">{{ $message }}</span>@enderror
</div>
</div><div class="question">
<p class="question-title">Security question 2</p>
<div class="field">
<label for="security_question_2">Select question</label>
<select name="security_question[]" id="security_question_2" required class="@error('security_question.1') is-invalid @enderror">
<option value="">-- Select a question --</option>
@foreach($questions as $question)
<option value="{{ $question }}" @selected(old('security_question.1') == $question)>{{ $question }}</option>
@endforeach
</select>
@error('security_question.1')<span class="invalid">{{ $message }}</span>@enderror
</div>
<div class="field">
<label for="security_answer_2">Your answer</label>
<input type="text" name="security_answer[]" id="security_answer_2" autocomplete="off" required value="{{ old('security_answer.1') }}" class="@error('security_answer.1') is-invalid @enderror">
@error('security_answer.1')<span class="invalid">{{ $message }}</span>@enderror
</div>
</div>
<div id="duplicate-question-error" class="status" role="alert">Please select two different security questions.</div>
<button type="submit" class="submit">Continue</button>
<div class="back"><a href="{{ route('student-login') }}">← Back to Login</a></div>
</form>
</section>
</div>
</main>
<script>
(function () {
 const first=document.getElementById('security_question_1');
 const second=document.getElementById('security_question_2');
 const message=document.getElementById('duplicate-question-error');
 const form=document.getElementById('security-setup-form');
 if(!first||!second||!form)return;
 function sync(){
   for(const opt of first.options){opt.disabled=opt.value!==''&&opt.value===second.value;}
   for(const opt of second.options){opt.disabled=opt.value!==''&&opt.value===first.value;}
   const duplicate=first.value!==''&&first.value===second.value;
   message.classList.toggle('visible',duplicate);
   second.setCustomValidity(duplicate?'Select two different security questions.':'');
 }
 first.addEventListener('change',sync);second.addEventListener('change',sync);
 form.addEventListener('submit',sync);sync();
})();
</script>
</body>
</html>
