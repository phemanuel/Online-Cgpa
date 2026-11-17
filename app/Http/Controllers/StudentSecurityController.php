<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\StudentSecurityQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentSecurityController extends Controller
{
    /**
     * Display security question setup.
     */
    public function showSetup()
    {
        $matricNo = session('security_setup_matric');

        if (!$matricNo) {
            return redirect()
                ->route('student-login')
                ->with('error', 'Your security setup session has expired.');
        }

        $student = Registration::where(
            'admission_no',
            $matricNo
        )->first();

        if (!$student) {
            session()->forget('security_setup_matric');

            return redirect()
                ->route('student-login')
                ->with('error', 'Student record not found.');
        }

        // If already has two questions, no need to setup again
        if ($student->securityQuestions()->count() >= 2) {
            return redirect()
                ->route('student-login');
        }

        $questions = [
            'What is the name of your first school?',
            'What is your favourite colour?',
            'What is your childhood nickname?',
            'What is the name of your favourite teacher?',
            'What city were you born in?',
            'What is the name of your best friend?',
        ];

        return view(
            'student.security-setup',
            compact('student', 'questions')
        );
    }


    /**
     * Save security questions.
     */
    public function saveSetup(Request $request)
    {
        $request->validate([
            'security_question' => 'required|array|size:2',
            'security_question.*' => 'required|string|max:255',

            'security_answer' => 'required|array|size:2',
            'security_answer.*' => 'required|string|min:2|max:255',
        ]);

        $matricNo = session('security_setup_matric');

        if (!$matricNo) {
            return redirect()
                ->route('student-login')
                ->with('error', 'Your security setup session has expired.');
        }

        $student = Registration::where(
            'admission_no',
            $matricNo
        )->first();

        if (!$student) {
            session()->forget('security_setup_matric');

            return redirect()
                ->route('student-login')
                ->with('error', 'Student record not found.');
        }

        // Prevent adding more than two
        if ($student->securityQuestions()->count() >= 2) {
            session()->forget('security_setup_matric');

            return redirect()
                ->route('student-login')
                ->with('success', 'Security questions have already been configured.');
        }

        // Prevent duplicate questions
        if (
            count(array_unique($request->security_question)) !== 2
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Please select two different security questions.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Save questions and answers
        |--------------------------------------------------------------------------
        */

        foreach ($request->security_question as $index => $question) {

            StudentSecurityQuestion::create([
                'student_id'        => $student->id,
                'security_question' => $question,
                'security_answer'   => Hash::make(
                    strtolower(
                        trim($request->security_answer[$index])
                    )
                ),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Remove setup session
        |--------------------------------------------------------------------------
        */

        session()->forget('security_setup_matric');


        /*
        |--------------------------------------------------------------------------
        | Log the student in
        |--------------------------------------------------------------------------
        */

        Auth::guard('student')->login($student);


        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Security questions saved successfully. Welcome!'
            );
    }
}