
@foreach ($users as $key => $rd)
    @php
        $rowNumber = method_exists($users, 'firstItem')
            ? ($users->firstItem() ?? 1) + $key
            : $key + 1;

        $pictureName = $rd->picture_dir
            ? $rd->picture_dir . '.jpg'
            : null;

        $pictureUrl = $pictureName &&
            file_exists(public_path('uploads/' . $pictureName))
                ? asset('uploads/' . $pictureName)
                : asset('uploads/blank.jpg');
    @endphp

    <tr class="oys-student-row">

        <!-- ROW NUMBER -->
        <td class="oys-student-number">
            {{ $rowNumber }}
        </td>

        <!-- PROFILE PICTURE -->
        <td>
            <div class="oys-student-avatar">
                <img
                    src="{{ $pictureUrl }}"
                    alt="Profile picture of {{ $rd->student_full_name }}"
                    width="46"
                    height="46"
                    loading="lazy"
                    onerror="this.onerror=null;this.src='{{ asset('uploads/blank.jpg') }}';"
                >
            </div>
        </td>

        <!-- MATRIC NUMBER -->
        <td>
            <span class="oys-student-matric">
                {{ $rd->admission_no }}
            </span>
        </td>

        <!-- STUDENT NAME -->
        <td>
            <span class="oys-student-name">
                {{ $rd->student_full_name }}
            </span>
        </td>

        <!-- PROGRAMME -->
        <td>
            <span class="oys-student-programme">
                {{ $rd->course ?: 'Not assigned' }}
            </span>
        </td>

        <!-- ADMISSION YEAR -->
        <td>
            <span class="oys-student-year">
                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                {{ $rd->admission_year }}
            </span>
        </td>

        <!-- ACTION -->
        <td>
            <a
                href="{{ route('edit-student', ['id' => $rd->id]) }}"
                class="oys-student-edit"
                title="Edit {{ $rd->student_full_name }}"
                aria-label="Edit {{ $rd->student_full_name }}"
            >
                <i class="fas fa-pen" aria-hidden="true"></i>
                <span>Edit</span>
            </a>
        </td>

    </tr>
@endforeach
