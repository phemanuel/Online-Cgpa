{{--
    Shared navigation for OYSCOHEST Result Portal.
    Staff roles 1/2: full staff navigation with Student, Result, Users dropdowns.
    Staff role 3: instructor navigation with restricted Result dropdown.
    Staff role 4: original limited menu.
    Student guard: original student menu without dropdowns.
    Variables $isStudentPortal, $role, $portalUser, $homeRoute and $accountRoute
    are supplied by result-portal.layouts.dashboard.
--}}
@php
    $links = [
        ['name' => 'Dashboard', 'route' => $homeRoute, 'icon' => 'fa-home'],
    ];

    if ($isStudentPortal) {
        $links[] = ['name' => 'Result', 'route' => 'student-result', 'icon' => 'fa-clipboard-list'];
        $links[] = ['name' => 'Request Transcript', 'route' => 'user-request', 'icon' => 'fa-file-signature'];
        $links[] = [
            'name' => 'Account Settings', 'route' => 'student-account-setting',
            'icon' => 'fa-cog', 'parameters' => ['id' => $portalUser->id],
        ];
        $links[] = ['name' => 'Contact Us', 'route' => 'contact-us', 'icon' => 'fa-envelope'];
    } elseif (in_array($role, [1, 2], true)) {
        $links[] = ['name' => 'Class List', 'route' => 'class-list', 'matches' => ['class-list*'], 'icon' => 'fa-list'];
        $links[] = [
            'name' => 'Student', 'icon' => 'fa-user-graduate',
            'children' => [
                ['name' => 'Student Registration', 'route' => 'student-registration'],
                ['name' => 'Student Migration', 'route' => 'student-migration'],
            ],
        ];
        $links[] = [
            'name' => 'Result', 'icon' => 'fa-clipboard-list',
            'children' => [
                ['name' => 'Result Entry', 'route' => 'result-entry'],
                ['name' => 'Result Computation', 'route' => 'result-compute'],
                ['name' => 'Semester Result', 'route' => 'semester-result'],
                ['name' => 'Semester Result Summary', 'route' => 'semester-summary'],
                ['name' => 'CGPA Summary', 'route' => 'cgpa-summary'],
                ['name' => 'Student Transcript', 'route' => 'student-transcript'],
            ],
        ];
        $links[] = ['name' => 'Course', 'route' => 'course-setup', 'icon' => 'fa-book'];
        $links[] = ['name' => 'HOD', 'route' => 'hod-setup', 'icon' => 'fa-user-tie'];
        $links[] = ['name' => 'Grading System', 'route' => 'grading', 'icon' => 'fa-clipboard-check'];
        $links[] = ['name' => 'Score Sheet', 'route' => 'score-sheet', 'icon' => 'fa-file-alt'];
        $links[] = ['name' => 'Transcript Requests', 'route' => 'transcript-request', 'icon' => 'fa-file-signature'];
        $links[] = [
            'name' => 'Account Settings', 'route' => 'admin-account-setting',
            'icon' => 'fa-cog', 'parameters' => ['id' => $portalUser->id],
        ];
        $links[] = [
            'name' => 'Users', 'icon' => 'fa-users',
            'children' => [
                ['name' => 'Admins', 'route' => 'users'],
                ['name' => 'Instructors', 'route' => 'instructors'],
                ['name' => 'Students', 'route' => 'student'],
            ],
        ];
    } elseif ($role === 3) {
        $links[] = ['name' => 'Class List', 'route' => 'class-list', 'matches' => ['class-list*'], 'icon' => 'fa-list'];
        $links[] = [
            'name' => 'Result', 'icon' => 'fa-clipboard-list',
            'children' => [
                ['name' => 'Result Entry', 'route' => 'result-entry'],
            ],
        ];
        $links[] = ['name' => 'Course', 'route' => 'course-setup', 'icon' => 'fa-book'];
        $links[] = [
            'name' => 'Account Settings', 'route' => 'admin-account-setting',
            'icon' => 'fa-cog', 'parameters' => ['id' => $portalUser->id],
        ];
    } elseif ($role === 4) {
        $links[0]['route'] = 'dashboard'; // Original role-4 dashboard route.
        $links[] = ['name' => 'Result', 'route' => 'student-result', 'icon' => 'fa-clipboard-list'];
        $links[] = ['name' => 'Request Transcript', 'route' => 'user-request', 'icon' => 'fa-file-signature'];
        $links[] = [
            'name' => 'Account Settings', 'route' => 'account-setting',
            'icon' => 'fa-cog', 'parameters' => ['id' => $portalUser->id],
        ];
        $links[] = ['name' => 'Contact Us', 'route' => 'contact-us', 'icon' => 'fa-envelope'];
    }
@endphp

<nav class="oys-nav" aria-label="Main navigation" id="oysReusableNav">
    <span class="oys-nav-heading">MAIN MENU</span>

    @foreach ($links as $index => $link)
        @if (isset($link['children']))
            @php
                $parentActive = collect($link['children'])->contains(
                    fn ($child) => request()->routeIs(...($child['matches'] ?? [$child['route']]))
                );
                $submenuId = 'oys-submenu-' . $index;
            @endphp

            <div class="oys-nav-group {{ $parentActive ? 'is-open is-current-group' : '' }}" data-nav-group>
                <button
                    type="button"
                    class="oys-nav-link oys-nav-parent {{ $parentActive ? 'is-parent-active' : '' }}"
                    aria-expanded="{{ $parentActive ? 'true' : 'false' }}"
                    aria-controls="{{ $submenuId }}"
                    data-nav-group-toggle
                >
                    <i class="fas {{ $link['icon'] }}" aria-hidden="true"></i>
                    <span>{{ $link['name'] }}</span>
                    <i class="fas fa-chevron-down oys-nav-chevron" aria-hidden="true"></i>
                </button>

                <div class="oys-nav-submenu" id="{{ $submenuId }}" @if(!$parentActive) hidden @endif>
                    @foreach ($link['children'] as $child)
                        @php
                            $active = request()->routeIs(...($child['matches'] ?? [$child['route']]));
                        @endphp
                        <a
                            href="{{ route($child['route'], $child['parameters'] ?? []) }}"
                            class="oys-nav-sublink {{ $active ? 'is-active' : '' }}"
                            @if($active) aria-current="page" @endif
                        >
                            <span class="oys-submenu-dot" aria-hidden="true"></span>
                            <span>{{ $child['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            @php
                $active = request()->routeIs(...($link['matches'] ?? [$link['route']]));
            @endphp
            <a
                href="{{ route($link['route'], $link['parameters'] ?? []) }}"
                class="oys-nav-link {{ $active ? 'is-active' : '' }}"
                @if($active) aria-current="page" @endif
            >
                <i class="fas {{ $link['icon'] }}" aria-hidden="true"></i>
                <span>{{ $link['name'] }}</span>
            </a>
        @endif
    @endforeach
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const nav = document.getElementById('oysReusableNav');
    if (!nav) return;

    nav.querySelectorAll('[data-nav-group-toggle]').forEach(function (button) {
        button.addEventListener('click', function () {
            const submenu = document.getElementById(button.getAttribute('aria-controls'));
            const group = button.closest('[data-nav-group]');
            if (!submenu || !group) return;

            const shouldOpen = button.getAttribute('aria-expanded') !== 'true';
            button.setAttribute('aria-expanded', String(shouldOpen));
            submenu.hidden = !shouldOpen;
            group.classList.toggle('is-open', shouldOpen);
        });
    });
});
</script>
