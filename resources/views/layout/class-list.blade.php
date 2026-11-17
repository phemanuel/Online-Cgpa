@extends('layouts.other-pages')

@section('pageTitle', 'Class List | OYSCOHEST Result Portal')

@section('content')

<style>
    /* ========================================
       OYSCOHEST CLASS LIST
       Green primary / Brown secondary / Gold accent
    ======================================== */

    .oys-class-page {
        --class-green: #23643a;
        --class-green-dark: #174a2a;
        --class-green-light: #eaf5ed;
        --class-brown: #641510;
        --class-gold: #d5aa43;
        --class-border: #e4e9e5;
        --class-text: #28332d;
        --class-muted: #718078;

        max-width: 1150px;
        margin: 0 auto;
        padding-bottom: 30px;
    }

    .oys-class-page *,
    .oys-class-page *::before,
    .oys-class-page *::after {
        box-sizing: border-box;
    }

    /* PAGE HEADING */

    .oys-class-heading {
        margin-bottom: 28px;
    }

    .oys-class-heading-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .oys-class-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 10px;
        color: var(--class-green);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .oys-class-eyebrow::before {
        content: '';
        width: 19px;
        height: 3px;
        background: var(--class-gold);
        border-radius: 5px;
    }

    .oys-class-title {
        margin: 0 0 9px;
        color: var(--class-text);
        font-size: clamp(23px, 3vw, 29px);
        font-weight: 700;
        letter-spacing: -.7px;
        line-height: 1.3;
    }

    .oys-class-description {
        margin: 0;
        color: var(--class-muted);
        font-size: 13px;
        line-height: 1.8;
    }

    .oys-class-page .oys-class-home {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 11px 16px;
        border: 1px solid var(--class-border);
        border-radius: 10px;
        background: #fff;
        color: var(--class-green);
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: .2s ease;
    }

    .oys-class-page .oys-class-home:hover {
        color: var(--class-green-dark);
        border-color: var(--class-green);
        background: var(--class-green-light);
    }

    /* MAIN FORM CARD */

    .oys-class-card {
        overflow: hidden;
        border: 1px solid var(--class-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 8px 30px rgba(30, 65, 40, .045);
    }

    .oys-class-card-header {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 24px 28px;
        border-bottom: 1px solid #edf0ed;
        background: linear-gradient(
            110deg,
            #ffffff 0%,
            #f7fbf7 100%
        );
    }

    .oys-class-header-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 48px;
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--class-green-light);
        color: var(--class-green);
        font-size: 22px;
    }

    .oys-class-card-header h2 {
        margin: 0 0 5px;
        color: var(--class-text);
        font-size: 17px;
        font-weight: 700;
    }

    .oys-class-card-header p {
        margin: 0;
        color: var(--class-muted);
        font-size: 12px;
        line-height: 1.7;
    }

    .oys-class-card-body {
        padding: 30px 28px;
    }

    .oys-class-fields {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .oys-class-field {
        min-width: 0;
    }

    .oys-class-field-full {
        grid-column: 1 / -1;
    }

    .oys-class-label {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        color: #37463c;
        font-size: 12px;
        font-weight: 700;
    }

    .oys-class-label i {
        color: var(--class-green);
        font-size: 15px;
    }

    .oys-class-required {
        color: var(--class-brown);
        font-weight: 700;
    }

    .oys-class-select-wrap {
        position: relative;
    }

    .oys-class-select {
        width: 100%;
        min-height: 51px;
        padding: 12px 43px 12px 15px;
        appearance: none;
        -webkit-appearance: none;
        border: 1px solid #dce4df;
        border-radius: 10px;
        outline: none;
        background: #fcfdfc;
        color: var(--class-text);
        font-family: inherit;
        font-size: 13px;
        font-weight: 500;
        line-height: 1.5;
        transition:
            border-color .2s,
            background .2s,
            box-shadow .2s;
    }

    .oys-class-select:focus {
        background: #fff;
        border-color: var(--class-green);
        box-shadow: 0 0 0 4px rgba(35, 100, 58, .10);
    }

    .oys-class-select:disabled {
        cursor: not-allowed;
        opacity: .65;
    }

    .oys-class-select-wrap::after {
        content: '';
        position: absolute;
        top: 50%;
        right: 19px;
        width: 8px;
        height: 8px;
        border-right: 2px solid var(--class-green);
        border-bottom: 2px solid var(--class-green);
        transform: translateY(-70%) rotate(45deg);
        pointer-events: none;
    }

    .oys-class-select.is-invalid {
        border-color: #bd3542;
    }

    .oys-class-error {
        display: block;
        margin-top: 8px;
        color: #bd3542;
        font-size: 12px;
        line-height: 1.6;
    }

    .oys-class-help {
        margin-top: 8px;
        color: #88948b;
        font-size: 11px;
        line-height: 1.65;
    }

    /* FOOTER AND ACTIONS */

    .oys-class-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        padding: 21px 28px;
        border-top: 1px solid #edf0ed;
        background: #fbfcfb;
    }

    .oys-class-footer-note {
        display: flex;
        align-items: center;
        gap: 9px;
        color: var(--class-muted);
        font-size: 11px;
        line-height: 1.7;
    }

    .oys-class-footer-note i {
        color: var(--class-green);
        font-size: 16px;
    }

    .oys-class-page .oys-class-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        min-height: 46px;
        padding: 12px 23px;
        border: 0;
        border-radius: 10px;
        background: var(--class-green);
        color: #fff;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition:
            background .2s,
            box-shadow .2s,
            transform .2s;
    }

    .oys-class-page .oys-class-submit:hover {
        background: var(--class-green-dark);
        color: #fff;
        box-shadow: 0 7px 17px rgba(35, 100, 58, .18);
        transform: translateY(-1px);
    }

    .oys-class-page .oys-class-submit:focus-visible {
        outline: 3px solid rgba(35, 100, 58, .3);
        outline-offset: 3px;
    }

    /* INFORMATION SECTION */

    .oys-class-info {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-top: 20px;
        padding: 19px 21px;
        border: 1px solid #d9eadf;
        border-radius: 12px;
        background: #f5faf6;
    }

    .oys-class-info-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 36px;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #e3f1e7;
        color: var(--class-green);
        font-size: 18px;
    }

    .oys-class-info h3 {
        margin: 0 0 5px;
        color: var(--class-green-dark);
        font-size: 12px;
        font-weight: 700;
    }

    .oys-class-info p {
        margin: 0;
        color: #64786a;
        font-size: 12px;
        line-height: 1.8;
    }

    /* RESPONSIVE */

    @media (max-width: 767px) {
        .oys-class-heading {
            margin-bottom: 20px;
        }

        .oys-class-card-header {
            padding: 20px;
        }

        .oys-class-card-body {
            padding: 23px 20px;
        }

        .oys-class-fields {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .oys-class-field-full {
            grid-column: auto;
        }

        .oys-class-card-footer {
            padding: 20px;
            align-items: stretch;
            flex-direction: column;
        }

        .oys-class-page .oys-class-submit {
            width: 100%;
        }

        .oys-class-info {
            padding: 16px;
        }
    }

    @media (max-width: 420px) {
        .oys-class-title {
            font-size: 23px;
        }

        .oys-class-card-header {
            gap: 12px;
        }

        .oys-class-header-icon {
            flex-basis: 42px;
            width: 42px;
            height: 42px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .oys-class-page * {
            transition: none !important;
        }
    }
</style>

<div class="oys-class-page">

    <!-- ==========================================
         PAGE HEADER
    =========================================== -->

    <div class="oys-class-heading">

        <div class="oys-class-heading-top">

            <div>

                <div class="oys-class-eyebrow">
                    Academic Management
                </div>

                <h1 class="oys-class-title">
                    Class List
                </h1>

                <p class="oys-class-description">
                    Select a programme, admission year, and academic
                    level to access the corresponding class list.
                </p>

            </div>

            <a
                href="{{ route('admin-dashboard') }}"
                class="oys-class-home"
            >
                <i class="fas fa-home" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>

        </div>

    </div>

    <!-- ==========================================
         CLASS LIST FORM
    =========================================== -->

    <div class="oys-class-card">

        <div class="oys-class-card-header">

            <div class="oys-class-header-icon">
                <i class="fas fa-users" aria-hidden="true"></i>
            </div>

            <div>
                <h2>Find a Class</h2>
                <p>
                    Specify the academic criteria below to continue.
                </p>
            </div>

        </div>

        <form
            action="{{ route('class-list.action') }}"
            method="GET"
            id="classListForm"
        >

            <div class="oys-class-card-body">

                <!-- PROGRAMME -->

                <div class="oys-class-fields">

                    <div class="oys-class-field oys-class-field-full">

                        <label
                            for="programme"
                            class="oys-class-label"
                        >
                            <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                            Programme
                            <span class="oys-class-required">*</span>
                        </label>

                        <div class="oys-class-select-wrap">

                            <select
                                name="programme"
                                id="programme"
                                class="oys-class-select @error('programme') is-invalid @enderror"
                                required
                                @error('programme')
                                    aria-invalid="true"
                                    aria-describedby="programme-error"
                                @enderror
                            >

                                <option value="" disabled
                                    {{ old('programme', request('programme')) === null || old('programme', request('programme')) === '' ? 'selected' : '' }}>
                                    Select a programme
                                </option>

                                @foreach($programmes as $d)
                                    <option
                                        value="{{ $d->department }}"
                                        {{ old('programme', request('programme')) == $d->department ? 'selected' : '' }}
                                    >
                                        {{ $d->department }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        @error('programme')
                            <span class="oys-class-error" id="programme-error" role="alert">
                                {{ $message }}
                            </span>
                        @enderror

                        <div class="oys-class-help">
                            Choose the programme or department
                            associated with the class.
                        </div>

                    </div>

                    <!-- ADMISSION YEAR -->

                    <div class="oys-class-field">

                        <label
                            for="admissionYear"
                            class="oys-class-label"
                        >
                            <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                            Admission Year
                            <span class="oys-class-required">*</span>
                        </label>

                        <div class="oys-class-select-wrap">

                            <select
                                name="admissionYear"
                                id="admissionYear"
                                class="oys-class-select @error('admissionYear') is-invalid @enderror"
                                required
                                @error('admissionYear')
                                    aria-invalid="true"
                                    aria-describedby="admissionYear-error"
                                @enderror
                            >

                                <option value="" disabled
                                    {{ old('admissionYear', request('admissionYear')) === null || old('admissionYear', request('admissionYear')) === '' ? 'selected' : '' }}>
                                    Select admission year
                                </option>

                                @php
                                    $currentYear = (int) date('Y');
                                @endphp

                                @for($year = $currentYear; $year >= 2018; $year--)

                                    <option
                                        value="{{ $year }}"
                                        {{ old('admissionYear', request('admissionYear')) == $year ? 'selected' : '' }}
                                    >
                                        {{ $year }}
                                    </option>

                                @endfor

                            </select>

                        </div>

                        @error('admissionYear')
                            <span class="oys-class-error" id="admissionYear-error" role="alert">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <!-- ACADEMIC LEVEL -->

                    <div class="oys-class-field">

                        <label
                            for="stdLevel"
                            class="oys-class-label"
                        >
                            <i class="fas fa-layer-group" aria-hidden="true"></i>
                            Academic Level
                            <span class="oys-class-required">*</span>
                        </label>

                        <div class="oys-class-select-wrap">

                            <select
                                name="stdLevel"
                                id="stdLevel"
                                class="oys-class-select @error('stdLevel') is-invalid @enderror"
                                required
                                @error('stdLevel')
                                    aria-invalid="true"
                                    aria-describedby="stdLevel-error"
                                @enderror
                            >

                                <option value="" disabled
                                    {{ old('stdLevel', request('stdLevel')) === null || old('stdLevel', request('stdLevel')) === '' ? 'selected' : '' }}>
                                    Select academic level
                                </option>

                                @foreach($allLevel as $d)

                                    <option
                                        value="{{ $d->level }}"
                                        {{ old('stdLevel', request('stdLevel')) == $d->level ? 'selected' : '' }}
                                    >
                                        {{ $d->level }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        @error('stdLevel')
                            <span class="oys-class-error" id="stdLevel-error" role="alert">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>

            </div>

            <!-- FORM FOOTER -->

            <div class="oys-class-card-footer">

                <div class="oys-class-footer-note">

                    <i class="fas fa-info-circle" aria-hidden="true"></i>

                    <span>
                        All three fields are required to proceed.
                    </span>

                </div>

                <button
                    type="submit"
                    class="oys-class-submit"
                >
                    <span>Proceed to Class List</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>

            </div>

        </form>

    </div>

    <!-- ==========================================
         HELP INFORMATION
    =========================================== -->

    <div class="oys-class-info">

        <div class="oys-class-info-icon">
            <i class="fas fa-lightbulb" aria-hidden="true"></i>
        </div>

        <div>
            <h3>How to access a class list</h3>
            <p>
                Select the programme, the year students were admitted,
                and their academic level. Click
                <strong>Proceed to Class List</strong>
                to continue to the matching records.
            </p>
        </div>

    </div>

</div>

@endsection
