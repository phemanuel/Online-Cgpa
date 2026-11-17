<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle', 'Dashboard | OYSCOHEST E-Result')</title>

    {{-- Retain existing dashboard framework and scripts used elsewhere in the portal. --}}
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/custom.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/oyscohest-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('result-portal/css/portal.css') }}">
    @stack('styles')
</head>
<body class="oys-body">
@php
    // 'student' is explicitly selected only by the student-guard dashboard.
    $isStudentPortal = trim($__env->yieldContent('portalAudience', 'staff')) === 'student';
    $portalUser = $isStudentPortal ? auth('student')->user() : auth()->user();
    $role = $isStudentPortal ? null : (int) ($portalUser->user_type_status ?? 0);
    $displayName = $isStudentPortal
        ? ($portalUser->student_full_name ?? 'Student')
        : trim(($portalUser->first_name ?? '') . ' ' . ($portalUser->last_name ?? ''));
    $displayName = $displayName ?: 'Portal user';
    $homeRoute = $isStudentPortal ? 'dashboard' : 'admin-dashboard';
    $accountRoute = $isStudentPortal ? 'student-account-setting'
        : ($role === 4 ? 'account-setting' : 'admin-account-setting');
    $logoutRoute = $isStudentPortal ? 'student-logout' : 'logout';
@endphp

<div class="oys-shell" id="oysPortalShell">
    <div class="oys-backdrop" id="oysSidebarBackdrop"></div>

    <aside class="oys-sidebar" id="oysSidebar" aria-label="Portal sidebar">
        <a href="{{ route($homeRoute) }}" class="oys-logo-area">
            <span class="oys-logo-frame">
                <img src="{{ asset('images/oyscohest-logo.png') }}" alt="OYSCOHEST logo">
            </span>
            <span class="oys-logo-wordmark"><strong>OYSCOHEST</strong><small>E-Result Portal</small></span>
        </a>
        @include('partials.navigation')
        <div class="oys-sidebar-footer">
            <i class="fas fa-shield-alt" aria-hidden="true"></i>
            Official College Portal
        </div>
    </aside>

    <div class="oys-workspace">
        <header class="oys-topbar">
            <div class="oys-topbar-start">
                <button type="button" class="oys-icon-button" id="oysNavToggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="oysSidebar">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
                <div class="oys-topbar-heading">
                    <span>Oyo State College of Health Science and Technology</span>
                    <small>@yield('headerCaption', 'Result Management Portal')</small>
                </div>
            </div>
            <div class="oys-topbar-end">
                <button type="button" class="oys-icon-button oys-fullscreen" id="oysFullScreen" aria-label="Toggle fullscreen">
                    <i class="fas fa-expand" aria-hidden="true"></i>
                </button>
                <div class="dropdown">
                    <button class="oys-account-toggle dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="oys-avatar">{{ mb_strtoupper(mb_substr($displayName, 0, 1)) }}</span>
                        <span class="oys-account-text"><strong>{{ $displayName }}</strong><small>{{ $isStudentPortal ? 'Student' : ($role === 3 ? 'Instructor' : ($role === 4 ? 'Portal User' : 'Staff')) }}</small></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right oys-account-menu">
                        <span class="dropdown-header">Account</span>
                        <a class="dropdown-item" href="{{ route($accountRoute, ['id' => $portalUser->id]) }}"><i class="fas fa-user-cog mr-2"></i> Account settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{ route($logoutRoute) }}"><i class="fas fa-sign-out-alt mr-2"></i> Sign out</a>
                    </div>
                </div>
            </div>
        </header>

        <main class="oys-main" id="main-content">
            <div class="oys-page-heading">
                <div><span class="oys-kicker">RESULT MANAGEMENT</span><h1>@yield('heading', 'Dashboard')</h1><p>@yield('subtitle', 'Overview of your portal account.')</p></div>
                <span class="oys-page-label"><i class="fas fa-circle" aria-hidden="true"></i> Secure Portal</span>
            </div>

            @if(session('success'))
                <div class="alert oys-alert oys-alert-success" role="status"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert oys-alert oys-alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert oys-alert oys-alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i><div>@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div></div>
            @endif

            @yield('content')
        </main>

        <footer class="oys-footer">
            <span>&copy; {{ date('Y') }} Oyo State College of Health Science and Technology</span>
            <a href="https://oyscohest.edu.ng" target="_blank" rel="noopener noreferrer">College Website <i class="fas fa-external-link-alt"></i></a>
        </footer>
    </div>
</div>

<script src="{{ asset('dashboard/assets/js/app.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/scripts.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/custom.js') }}"></script>
<script>
(function () {
    const shell = document.getElementById('oysPortalShell');
    const toggle = document.getElementById('oysNavToggle');
    const backdrop = document.getElementById('oysSidebarBackdrop');
    const fullscreen = document.getElementById('oysFullScreen');
    if (!shell || !toggle) return;
    function setOpen(open) {
        shell.classList.toggle('oys-sidebar-open', open);
        toggle.setAttribute('aria-expanded', String(open));
        document.body.classList.toggle('oys-mobile-nav-open', open && window.innerWidth <= 991);
    }
    toggle.addEventListener('click', function () {
        if (window.innerWidth <= 991) {
            setOpen(!shell.classList.contains('oys-sidebar-open'));
        } else {
            shell.classList.toggle('oys-sidebar-collapsed');
            toggle.setAttribute('aria-expanded', String(!shell.classList.contains('oys-sidebar-collapsed')));
        }
    });
    if (backdrop) backdrop.addEventListener('click', () => setOpen(false));
    document.addEventListener('keydown', e => { if (e.key === 'Escape') setOpen(false); });
    window.addEventListener('resize', () => { if (window.innerWidth > 991) setOpen(false); });
    if (fullscreen && document.fullscreenEnabled) {
        fullscreen.addEventListener('click', () => {
            if (document.fullscreenElement) document.exitFullscreen();
            else document.documentElement.requestFullscreen().catch(() => {});
        });
    } else if (fullscreen) fullscreen.hidden = true;
})();
</script>
@stack('scripts')
</body>
</html>
