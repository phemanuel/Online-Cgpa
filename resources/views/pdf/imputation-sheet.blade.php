<!DOCTYPE html>
<html>
<head>
    <title>Result Imputation Sheet</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .page-break{
            page-break-after: always;
        }

        .header{
            text-align:center;
            margin-bottom:20px;
        }

        .header h2,
        .header h3,
        .header h4,
        .header p{
            margin:3px;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:15px;
        }

        table, th, td{
            border:1px solid #000;
        }

        th, td{
            padding:6px;
        }

        th{
            text-align:center;
        }

        .course-info{
            margin-top:10px;
        }

        .course-info p{
            margin:4px 0;
        }

    </style>
</head>

<body>

@foreach($courses as $course)

    <div class="header">

        <h2>OYO STATE COLLEGE OF HEALTH, SCIENCE AND TECHNOLOGY</h2>
        <h4>Eleyele, Ibadan.</h4>

        <h3>RESULT IMPUTATION SHEET</h3>

        <p>
            <strong>Programme:</strong> {{ $programme }}
        </p>

        <p>
            <strong>Level:</strong> {{ $studentLevel }}
            &nbsp;&nbsp;&nbsp;

            <strong>Semester:</strong> {{ $semester }}
        </p>

        <p>
            <strong>Admission Year:</strong> {{ $admission_year }}
        </p>

    </div>

    <div class="course-info">

        <p>
            <strong>Course Title:</strong>
            {{ $course->course_title }}
        </p>

        <p>
            <strong>Course Code:</strong>
            {{ $course->course_code }}
        </p>

        <p>
            <strong>Course Unit:</strong>
            {{ $course->course_unit }}
        </p>

    </div>

    <table>

        <thead>

            <tr>
                <th width="5%">S/N</th>

                <th width="15%">
                    Admission No
                </th>

                <th width="40%">
                    Student Name
                </th>

                <th width="10%">CA</th>

                <th width="10%">Exam</th>

                <th width="10%">Total</th>

                <th width="10%">Remark</th>
            </tr>

        </thead>

        <tbody>

            @foreach($students as $index => $student)

                <tr>

                    <td align="center">
                        {{ $index + 1 }}
                    </td>

                    <td style="font-size:11px;">
                        {{ $student->admission_no }}
                    </td>

                    <td>
                        {{ strtoupper($student->surname) }}
                        {{ strtoupper($student->first_name) }}
                    </td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td></td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <br><br><br>

    <table width="100%" style="border:0;">

        <tr style="border:0;">

            <!-- Lecturer Section -->

            <td style="border:0; width:50%;">

                <strong>Lecturer's Name:</strong>

                ___________________________________

                <br><br><br>

                <strong>Signature/Date:</strong>

                ___________________________________

            </td>

            <!-- HOD Section -->

            <td style="border:0; width:50%; text-align:left;">

                <strong>HOD:</strong>

                {{ $hod->hod_name ?? '__________________' }}

                <br><br><br>

                <strong>Signature/Date:</strong>

                ___________________________________

            </td>

        </tr>

    </table>

    <!-- PAGE BREAK -->

    <div class="page-break"></div>

@endforeach

</body>
</html>