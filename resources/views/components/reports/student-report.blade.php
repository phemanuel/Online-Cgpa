@props(['student', 'semester', 'grades', 'hod'])

{{-- Begin Student Report --}}
<div class="card mb-4">
    <div class="card-body">
    

        {{-- Student Information --}}
        <table class="table table-bordered align-middle">
            <tr>
                <td rowspan="4" style="width: 150px; text-align: center;">
    @php
        $picture = $student['studpicture'] ?? null;
        $imagePath = $picture ? public_path('uploads/' . $picture . '.jpg') : null;
    @endphp

    @if($picture && file_exists($imagePath))
        <img 
            src="{{ asset('public/uploads/' . $picture . '.jpg') }}" 
            alt="Student Picture" 
            class="img-thumbnail" 
            style="max-width: 130px;">
    @endif
</td>
                <th>Full Name:</th>
                <td colspan="3">{{ $student['stusurname'] }}</td>
            </tr>
            <tr><th>Matric No:</th><td colspan="3">{{ $student['stuno'] }}</td></tr>
            <tr><th>Level:</th><td>{{ $student['class'] }}</td>
              <th>Semester</th>
              <td>{{ $semester['semester'] }}</td>
            </tr>
            <tr><th>Programme:</th><td colspan="3">{{ $student['coursekeep'] }}</td></tr>
        </table>
    </div>
</div>

{{-- Results --}}
@include('components.reports.results-table', ['student' => $student, 'grades' => $grades, 'hod' => $hod])
