@extends('layouts.other-pages')

@section('pageTitle', 'Account Settings | E-Result')

@section('content')
@php
    $accountUser = auth()->user();
    $accountPhoto = $accountUser->image;
    $accountPhotoPath = (!empty($accountPhoto) && file_exists(public_path('profile_pictures/' . $accountPhoto)))
        ? 'profile_pictures/' . $accountPhoto
        : (file_exists(public_path('profile_pictures/blank.jpg')) ? 'profile_pictures/blank.jpg' : 'uploads/blank.jpg');
@endphp
<style>
.oys-account{--green:#23643a;--deep:#174a2a;--wine:#641510;--gold:#d5aa43;--ink:#192b25;--muted:#728078;--line:#e5ebe7;--canvas:#f7f9f7;color:var(--ink);padding:22px 0 44px}
.oys-account *{box-sizing:border-box}.oys-account .as-shell{max-width:1080px;margin:auto;padding:0 16px}.oys-account .as-crumb{display:flex;align-items:center;gap:9px;flex-wrap:wrap;font-size:13px;color:#77847c;margin-bottom:20px}.oys-account .as-crumb a{color:var(--green);text-decoration:none;font-weight:600}.oys-account .as-header{display:flex;justify-content:space-between;align-items:center;gap:20px;margin-bottom:23px}.oys-account .as-header h1{font-size:clamp(24px,3vw,32px);font-weight:800;letter-spacing:-.7px;margin:0 0 7px;color:var(--deep)}.oys-account .as-header p{color:var(--muted);font-size:14px;margin:0}.oys-account .as-label{font-size:11px;text-transform:uppercase;letter-spacing:1.6px;font-weight:800;color:var(--wine);margin-bottom:8px}.oys-account .as-banner{height:7px;background:linear-gradient(90deg,var(--green) 0 76%,var(--gold) 76% 87%,var(--wine) 87%);border-radius:12px 12px 0 0}.oys-account .as-layout{display:grid;grid-template-columns:minmax(0,1.6fr) minmax(260px,.9fr);gap:20px;align-items:start}.oys-account .as-card{border:1px solid var(--line);background:#fff;border-radius:17px;overflow:hidden;box-shadow:0 8px 32px rgba(17,59,33,.035)}.oys-account .as-card-main{border-top-left-radius:0;border-top-right-radius:0}.oys-account .as-panel{padding:24px 26px;border-bottom:1px solid var(--line)}.oys-account .as-panel:last-child{border-bottom:0}.oys-account .as-section-title{display:flex;align-items:center;gap:11px;margin:0 0 20px;font-weight:750;font-size:17px;color:var(--deep)}.oys-account .as-icon{height:36px;width:36px;display:inline-flex;align-items:center;justify-content:center;border-radius:11px;background:#eef6ef;color:var(--green);font-size:16px;flex-shrink:0}.oys-account .as-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}.oys-account .as-field{min-width:0}.oys-account .as-field-full{grid-column:1/-1}.oys-account .as-field label{display:block;font-size:13px;font-weight:700;color:#364a40;margin-bottom:8px}.oys-account .as-input{width:100%;height:46px;border:1px solid #dbe4dd;border-radius:10px;background:#fff;padding:10px 13px;font-size:14px;color:#223a2d;outline:none;transition:border-color .2s,box-shadow .2s}.oys-account .as-input:focus{border-color:var(--green);box-shadow:0 0 0 3px rgba(35,100,58,.1)}.oys-account .as-input[readonly]{background:#f6f8f6;color:#738078;cursor:default}.oys-account .as-input.is-invalid{border-color:#c65a51}.oys-account .as-error{display:block;color:#b4312b;margin-top:6px;font-size:12px}.oys-account .as-hint{font-size:12px;line-height:1.6;color:var(--muted);margin:7px 0 0}.oys-account .as-pw{display:flex;align-items:center;position:relative}.oys-account .as-pw .as-input{padding-right:75px}.oys-account .as-toggle{position:absolute;right:7px;top:6px;padding:7px 9px;border:0;border-radius:7px;background:#f0f5f1;color:var(--green);font-weight:700;font-size:12px;cursor:pointer}.oys-account .as-actions{display:flex;align-items:center;justify-content:flex-end;gap:12px;padding:20px 26px;background:#fbfcfb}.oys-account .as-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:12px 18px;border-radius:10px;font-weight:750;font-size:13px;text-decoration:none;cursor:pointer;border:1px solid #dce5dd;background:#fff;color:var(--deep)}.oys-account .as-btn-primary{background:var(--green);border-color:var(--green);color:#fff}.oys-account .as-btn-primary:hover{background:var(--deep);color:#fff}.oys-account .as-profile{padding:25px;text-align:center}.oys-account .as-photo{width:112px;height:112px;display:block;object-fit:cover;border-radius:24px;margin:0 auto 15px;border:4px solid #edf4ee;background:#f2f4f2}.oys-account .as-profile h2{font-size:18px;font-weight:750;color:var(--deep);margin:0 0 4px;overflow-wrap:anywhere}.oys-account .as-profile p{margin:0;color:var(--muted);font-size:13px;overflow-wrap:anywhere}.oys-account .as-note{background:#f8faf8;border-top:1px solid var(--line);padding:19px 22px;text-align:left}.oys-account .as-note strong{display:block;color:var(--deep);font-size:13px;margin-bottom:7px}.oys-account .as-note p{font-size:12px;line-height:1.75;margin:0;color:#68796e}.oys-account .as-file{width:100%;font-size:13px;border:1px dashed #b7cbbb;background:#f9fbf9;padding:14px;border-radius:11px;color:#54675a}.oys-account .as-alert{padding:14px 17px;border-radius:10px;margin:0 0 18px;font-size:14px;border:1px solid}.oys-account .as-success{background:#edf7ef;border-color:#cbe8d1;color:#205b30}.oys-account .as-danger{background:#fff1ef;border-color:#f0ccc8;color:#962b24}.oys-account .as-errors{margin:7px 0 0;padding-left:19px}.oys-account .as-smallhead{font-size:12px;font-weight:800;letter-spacing:.8px;color:var(--wine);text-transform:uppercase;margin:0 0 10px}
@media(max-width:790px){.oys-account .as-layout{grid-template-columns:1fr}.oys-account .as-side{grid-row:1}.oys-account .as-profile{display:flex;gap:18px;align-items:center;text-align:left}.oys-account .as-photo{margin:0;width:82px;height:82px;border-radius:17px}.oys-account .as-header{align-items:flex-start}}
@media(max-width:550px){.oys-account{padding-top:9px}.oys-account .as-shell{padding:0 9px}.oys-account .as-grid{grid-template-columns:1fr}.oys-account .as-panel{padding:20px 17px}.oys-account .as-actions{padding:16px;flex-wrap:wrap}.oys-account .as-actions .as-btn{flex:1}.oys-account .as-header h1{font-size:25px}}
</style>

<div class="oys-account">
    <div class="as-shell">
        <div class="as-crumb">
            <a href="{{ route('admin-dashboard') }}">Dashboard</a>
            <span aria-hidden="true">/</span>
            <span>Account Settings</span>
        </div>

        <div class="as-header">
            <div>
                <div class="as-label">Personal Account</div>
                <h1>Account Settings</h1>
                <p>Manage your contact details, profile photo and password.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="as-alert as-success" role="status">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="as-alert as-danger" role="alert">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="as-alert as-danger" role="alert">
                <strong>Please review the highlighted information.</strong>
                <ul class="as-errors">@foreach($errors->all() as $message)<li>{{ $message }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="as-layout">
            <div>
                <div class="as-banner" aria-hidden="true"></div>
                <div class="as-card as-card-main">
                    <form action="{{ route('account-setting.action') }}" method="post" enctype="multipart/form-data" id="oysAccountForm">
                        @csrf
                        <div class="as-panel">
                            <h2 class="as-section-title"><span class="as-icon"><i class="fas fa-user"></i></span> Personal information</h2>
                            <div class="as-grid">
                                <div class="as-field as-field-full">
                                    <label for="oysAccountEmail">Email address</label>
                                    <input class="as-input" id="oysAccountEmail" type="email" value="{{ $accountUser->email }}" readonly aria-describedby="oysEmailHint">
                                    <p class="as-hint" id="oysEmailHint">This email is linked to your account and cannot be changed here.</p>
                                </div>
                                <div class="as-field">
                                    <label for="oysLastName">Last name</label>
                                    <input class="as-input @error('lastName') is-invalid @enderror" id="oysLastName" type="text" name="lastName" value="{{ old('lastName', $accountUser->last_name) }}" autocomplete="family-name">
                                    @error('lastName')<span class="as-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="as-field">
                                    <label for="oysFirstName">First name</label>
                                    <input class="as-input @error('firstName') is-invalid @enderror" id="oysFirstName" type="text" name="firstName" value="{{ old('firstName', $accountUser->first_name) }}" autocomplete="given-name">
                                    @error('firstName')<span class="as-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="as-field as-field-full">
                                    <label for="oysPhoneNo">Phone number</label>
                                    <input class="as-input @error('phoneNo') is-invalid @enderror" id="oysPhoneNo" type="tel" name="phoneNo" value="{{ old('phoneNo', $accountUser->phone_no) }}" autocomplete="tel">
                                    @error('phoneNo')<span class="as-error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="as-panel">
                            <h2 class="as-section-title"><span class="as-icon"><i class="fas fa-camera"></i></span> Profile picture</h2>
                            <div class="as-field">
                                <label for="oysProfilePicture">Upload new photo <span style="font-weight:400;color:#849189">(optional)</span></label>
                                <input class="as-file @error('profilePicture') is-invalid @enderror" type="file" name="profilePicture" id="oysProfilePicture" accept="image/*">
                                <p class="as-hint">Your existing photo will remain unchanged unless you select a replacement.</p>
                                @error('profilePicture')<span class="as-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="as-panel">
                            <h2 class="as-section-title"><span class="as-icon"><i class="fas fa-lock"></i></span> Password &amp; security</h2>
                            <p class="as-hint" style="margin:-8px 0 18px">Leave both password fields blank if you do not want to change your password.</p>
                            <div class="as-grid">
                                <div class="as-field">
                                    <label for="oysAccountPassword">New password</label>
                                    <div class="as-pw">
                                        <input class="as-input @error('password') is-invalid @enderror" type="password" name="password" id="oysAccountPassword" autocomplete="new-password">
                                        <button type="button" class="as-toggle" data-toggle-input="oysAccountPassword" aria-label="Show new password">Show</button>
                                    </div>
                                    @error('password')<span class="as-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="as-field">
                                    <label for="oysAccountPasswordConfirm">Confirm new password</label>
                                    <div class="as-pw">
                                        <input class="as-input" type="password" name="password_confirmation" id="oysAccountPasswordConfirm" autocomplete="new-password">
                                        <button type="button" class="as-toggle" data-toggle-input="oysAccountPasswordConfirm" aria-label="Show password confirmation">Show</button>
                                    </div>
                                </div>
                            </div>
                            <span class="as-error" id="oysAccountPasswordMessage" role="alert" style="display:none"></span>
                        </div>
                        <div class="as-actions">
                            <a class="as-btn" href="{{ route('admin-dashboard') }}">Back to dashboard</a>
                            <button type="submit" class="as-btn as-btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
            <aside class="as-card as-side">
                <div class="as-profile">
                    <img src="{{ asset($accountPhotoPath) }}" id="oysProfilePreview" class="as-photo" alt="Current profile picture">
                    <div>
                        <div class="as-smallhead">Your profile</div>
                        <h2>{{ trim($accountUser->first_name . ' ' . $accountUser->last_name) }}</h2>
                        <p>{{ $accountUser->email }}</p>
                    </div>
                </div>
                <div class="as-note">
                    <strong><i class="fas fa-info-circle" style="color:#23643a;margin-right:5px"></i> Profile updates</strong>
                    <p>Your changes are submitted when you click <strong style="display:inline;font-size:inherit">Save Changes</strong>. Choosing a photo only updates its preview until the form is successfully saved.</p>
                </div>
            </aside>
        </div>
    </div>
</div>
<script>
(function () {
    function initialiseAccountSettings() {
        var fileInput = document.getElementById('oysProfilePicture');
        var preview = document.getElementById('oysProfilePreview');
        var temporaryUrl = null;
        if (fileInput && preview) {
            fileInput.addEventListener('change', function () {
                if (temporaryUrl) { URL.revokeObjectURL(temporaryUrl); temporaryUrl = null; }
                if (this.files && this.files[0] && this.files[0].type.startsWith('image/')) {
                    temporaryUrl = URL.createObjectURL(this.files[0]);
                    preview.src = temporaryUrl;
                }
            });
        }
        document.querySelectorAll('.oys-account [data-toggle-input]').forEach(function (button) {
            button.addEventListener('click', function () {
                var input = document.getElementById(button.getAttribute('data-toggle-input'));
                if (!input) return;
                var visible = input.type === 'password';
                input.type = visible ? 'text' : 'password';
                button.textContent = visible ? 'Hide' : 'Show';
                button.setAttribute('aria-label', (visible ? 'Hide' : 'Show') + ' password');
            });
        });
        var form = document.getElementById('oysAccountForm');
        if (form) form.addEventListener('submit', function (event) {
            var password = document.getElementById('oysAccountPassword').value;
            var confirmation = document.getElementById('oysAccountPasswordConfirm').value;
            var message = document.getElementById('oysAccountPasswordMessage');
            message.style.display = 'none';
            if (password !== confirmation) {
                event.preventDefault();
                message.textContent = 'The new password and confirmation do not match.';
                message.style.display = 'block';
                document.getElementById('oysAccountPasswordConfirm').focus();
            }
        });
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initialiseAccountSettings);
    else initialiseAccountSettings();
})();
</script>
@endsection
