<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\StudentSecurityQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentPasswordResetController extends Controller
{
    public function showForgotPassword()
    {
        return view('student.forgot-password');
    }

   public function verifyStudent(Request $request)
    {
        $request->validate([
            'matricNo' => 'required|string',
        ]);
    
        $student = Registration::where(
            'admission_no',
            $request->matricNo
        )->first();
    
        if (!$student) {
            return back()->with(
                'error',
                'Matric number not found.'
            );
        }
    
        /*
        |--------------------------------------------------------------------------
        | FORGOT PASSWORD FLOW
        |--------------------------------------------------------------------------
        */
    
        session([
            'security_student_id' => $student->id,
            'security_flow'       => 'forgot_password',
    
            // Keep this because it is needed later for password reset
            'password_reset_student_id' => $student->id,
            'password_reset_matric'     => $student->admission_no,
        ]);
    
        session()->save();
    
    
        /*
        |--------------------------------------------------------------------------
        | Check Security Questions
        |--------------------------------------------------------------------------
        */
    
        $questionCount = $student
            ->securityQuestions()
            ->count();
    
    
        /*
        |--------------------------------------------------------------------------
        | No Security Questions
        |--------------------------------------------------------------------------
        */
    
        if ($questionCount < 2) {
    
            return redirect()
                ->route('student.password.security.setup')
                ->with(
                    'info',
                    'Please set up your security questions before continuing.'
                );
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | Already Has Security Questions
        |--------------------------------------------------------------------------
        */
    
        return redirect()
            ->route('student.password.verify.page');
    }

   public function verifyAnswer(Request $request)
    {
        $request->validate([
            'security_answer' => 'required|array|size:2',
            'security_answer.*' => 'required|string|max:255',
        ]);
    
        /*
        |--------------------------------------------------------------------------
        | Get Student
        |--------------------------------------------------------------------------
        */
    
        $studentId = session('security_student_id');
    
        if (!$studentId) {
    
            return redirect()
                ->route('student-login')
                ->with(
                    'error',
                    'Your security verification session has expired. Please try again.'
                );
        }
    
    
        $student = Registration::find($studentId);
    
        if (!$student) {
    
            session()->forget([
                'security_student_id',
                'security_flow',
                'password_reset_student_id',
                'password_reset_verified',
            ]);
    
            return redirect()
                ->route('student-login')
                ->with(
                    'error',
                    'Student record not found.'
                );
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | Get Security Questions
        |--------------------------------------------------------------------------
        */
    
        $securityQuestions = $student
            ->securityQuestions()
            ->orderBy('id')
            ->take(2)
            ->get();
    
    
        if ($securityQuestions->count() !== 2) {
    
            return redirect()
                ->route('student.password.security.setup')
                ->with(
                    'error',
                    'Please complete your security question setup first.'
                );
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | Verify Answers
        |--------------------------------------------------------------------------
        */
    
        foreach ($securityQuestions as $index => $securityQuestion) {
    
            $answer = strtolower(
                trim($request->security_answer[$index])
            );
    
            if (!Hash::check(
                $answer,
                $securityQuestion->security_answer
            )) {
    
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'One or more security answers are incorrect.'
                    );
            }
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | SECURITY VERIFIED
        |--------------------------------------------------------------------------
        */
    
        $flow = session('security_flow');
    
    
        /*
        |--------------------------------------------------------------------------
        | NORMAL LOGIN
        |--------------------------------------------------------------------------
        */
    
        if ($flow === 'login') {
    
            Auth::guard('student')->login($student);
    
            session()->forget([
                'security_student_id',
                'security_setup_matric',
                'security_flow',
            ]);
    
            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'Security verification successful. Welcome!'
                );
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | FORGOT PASSWORD
        |--------------------------------------------------------------------------
        */
    
        if ($flow === 'forgot_password') {
    
            session([
                'password_reset_student_id' => $student->id,
                'password_reset_verified' => true,
            ]);
    
            // Keep security_student_id and security_flow
            // until password reset is completed.
    
            return redirect()
                ->route('student.password.reset')
                ->with(
                    'success',
                    'Security verification successful. You can now reset your password.'
                );
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | UNKNOWN FLOW
        |--------------------------------------------------------------------------
        */
    
        session()->forget([
            'security_student_id',
            'security_setup_matric',
            'password_reset_matric',
            'password_reset_student_id',
            'security_flow',
            'password_reset_verified',
        ]);
    
        return redirect()
            ->route('student-login')
            ->with(
                'error',
                'Invalid security verification session. Please try again.'
            );
    }

    public function showResetPassword()
    {
        
    //     dd([
    //     'message' => 'SHOW RESET PASSWORD WAS CALLED',
    //     'url' => request()->fullUrl(),
    //     'previous_url' => url()->previous(),
    //     'security_student_id' => session('security_student_id'),
    //     'security_flow' => session('security_flow'),
    //     'password_reset_student_id' => session('password_reset_student_id'),
    //     'password_reset_verified' => session('password_reset_verified'),
    // ]);
        if (
            !session('password_reset_verified') ||
            !session('password_reset_student_id')
        ) {
            return redirect()
                ->route('student.password.request')
                ->with('error', 'Please verify your security question first.');
        }

        $student = Registration::find(
            session('password_reset_student_id')
        );

        if (!$student) {
            session()->forget([
                'password_reset_matric',
                'password_reset_verified',
                'password_reset_student_id',
            ]);

            return redirect()
                ->route('student.password.request')
                ->with('error', 'Student record not found.');
        }

        return view('student.reset-password', compact('student'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
        ]);

        if (
            !session('password_reset_verified') ||
            !session('password_reset_student_id')
        ) {
            return redirect()
                ->route('student.password.request')
                ->with('error', 'Your password reset session has expired.');
        }

        $student = Registration::find(
            session('password_reset_student_id')
        );

        if (!$student) {
            session()->forget([
                'password_reset_matric',
                'password_reset_verified',
                'password_reset_student_id',
            ]);

            return redirect()
                ->route('student.password.request')
                ->with('error', 'Student record not found.');
        }

        // Update password
        $student->password = Hash::make($request->password);
        $student->save();

        // Clear password reset session
        session()->forget([
            'password_reset_matric',
            'password_reset_verified',
            'password_reset_student_id',
        ]);

        return redirect()
            ->route('student-login')
            ->with(
                'success',
                'Your password has been reset successfully. You can now log in.'
            );
    }

    public function saveSecuritySetup(Request $request)
    {
        $request->validate([
            'security_question' => 'required|array|size:2',
            'security_question.*' => 'required|string|max:255',

            'security_answer' => 'required|array|size:2',
            'security_answer.*' => 'required|string|min:2|max:255',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Determine Student
        |--------------------------------------------------------------------------
        */

        $studentId = session('password_reset_student_id');

        if ($studentId) {

            $student = Registration::find($studentId);

        } else {

            $matricNo = session('security_setup_matric');

            $student = Registration::where(
                'admission_no',
                $matricNo
            )->first();
        }


        if (!$student) {

            return redirect()
                ->route('student-login')
                ->with('error', 'Student record not found.');
        }


        /*
        |--------------------------------------------------------------------------
        | Check Existing Questions
        |--------------------------------------------------------------------------
        */

        if ($student->securityQuestions()->count() >= 2) {

            return redirect()
                ->route('student.password.verify.page');
        }


        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Questions
        |--------------------------------------------------------------------------
        */

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
        | Save Questions
        |--------------------------------------------------------------------------
        */

        foreach ($request->security_question as $index => $question) {

            StudentSecurityQuestion::create([
                'student_id' => $student->id,

                'security_question' => $question,

                'security_answer' => Hash::make(
                    strtolower(
                        trim(
                            $request->security_answer[$index]
                        )
                    )
                ),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Store Student ID For Verification
        |--------------------------------------------------------------------------
        */

        session([
            'password_reset_student_id' => $student->id,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Go To Security Verification
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('student.password.verify.page')
            ->with(
                'success',
                'Security questions saved. Please verify your answers.'
            );
    }

   public function showSecuritySetup()
    {
        
        $studentId = session('security_student_id');
    
        if (!$studentId) {
    
            return redirect()
                ->route('student-login')
                ->with(
                    'error',
                    'Your security setup session has expired. Please login again.'
                );
        }
    
        $student = Registration::find($studentId);
    
        if (!$student) {
    
            session()->forget([
                'security_student_id',
                'security_flow',
            ]);
    
            return redirect()
                ->route('student-login')
                ->with(
                    'error',
                    'Student record not found.'
                );
        }
    
        // Student already has 2 questions
        if ($student->securityQuestions()->count() >= 2) {
    
            return redirect()
                ->route('student.password.verify.page');
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

   public function showVerifySecurity()
    {
        /*
        |--------------------------------------------------------------------------
        | Get Student From Security Session
        |--------------------------------------------------------------------------
        */
    
        $studentId = session('security_student_id');
    
        // Make sure the security process belongs to a valid session
        if (!$studentId) {
    
            return redirect()
                ->route('student-login')
                ->with(
                    'error',
                    'Your security verification session has expired. Please try again.'
                );
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | Get Student
        |--------------------------------------------------------------------------
        */
    
        $student = Registration::find($studentId);
    
        if (!$student) {
    
            session()->forget([
                'security_student_id',
                'security_flow',
                'password_reset_student_id',
                'password_reset_matric',
                'password_reset_verified',
            ]);
    
            return redirect()
                ->route('student-login')
                ->with(
                    'error',
                    'Student record not found.'
                );
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | Get Security Questions
        |--------------------------------------------------------------------------
        */
    
        $securityQuestions = $student
            ->securityQuestions()
            ->orderBy('id')
            ->take(2)
            ->get();
    
    
        /*
        |--------------------------------------------------------------------------
        | Student Must Have Two Questions
        |--------------------------------------------------------------------------
        */
    
        if ($securityQuestions->count() < 2) {
    
            return redirect()
                ->route('student.password.security.setup')
                ->with(
                    'error',
                    'Please complete your security question setup first.'
                );
        }
    
    
        /*
        |--------------------------------------------------------------------------
        | Display Verification Page
        |--------------------------------------------------------------------------
        */
    
        return view(
            'student.verify-security',
            compact(
                'student',
                'securityQuestions'
            )
        );
    }
    
}