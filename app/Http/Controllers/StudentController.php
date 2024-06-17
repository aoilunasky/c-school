<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Package;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PackageConfirmed;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('students.index')->with(['students' => $students]);
    }

    public function dashboard()
    {
        $teachers=Teacher::paginate(4);
        $packages = Package::paginate(4);
        $subjects = Subject::paginate(5);
        return view('students.dashboard')->with(['subjects' => $subjects,'packages' => $packages,'teachers' => $teachers]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'f_name' => 'required',
            'phone' => 'required|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'lesson_type' => 'required',
        ]);
        $user = User::create([
            'email' => $request->email,
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'role' => User::STUDENT,
            'phone' => $request->phone,
            'password' => Hash::make($request->passwprd),
            'status' => User::CONFIRMED,
        ]);
        Student::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
            'age' => $request->age,
            'lesson_type' => $request->lesson_type,
            'purpose' => $request->purpose
        ]);
        return redirect()->route('students.list')->with('success', 'New Student Record created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students.detail')->with(['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.edit')->with(['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'f_name' => 'required',
            'phone' => 'required|max:15',
            'email' => ['required', Rule::unique('users')->ignore($student->user->id), 'email'],
            'gender' => 'required',
            'age' => 'required',
            'lesson_type' => 'required',
        ]);

        $student->user->email = $request->email;
        $student->user->f_name = $request->f_name;
        $student->user->l_name = $request->l_name;
        $student->user->phone = $request->phone;
        $student->user->save();

        $student->gender = $request->gender;
        $student->age = $request->age;
        $student->lesson_type = $request->lesson_type;
        $student->purpose = $request->purpose;
        $student->save();
        return redirect()->route('students.list')->with('success', 'Student Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->user->delete();
        $student->delete();
        return redirect()->route('students.list')->with('success', 'Student Record deleted successfully!');
    }

    /**
     * Select Student's Packagehistory
     */
    public function packages($id)
    {
        $student=Student::where('id',$id)->with('packages')->first();
        $packages = $student->packages()->orderBy('package_histories.id', 'desc')->get();

        return view('students.ownedpackage')->with(['student'=>$student,'packages'=>$packages]);
    }


    /**
     * Lesson Progress Report for Student Role
     */
    public function lessonProgressReport()
    {
        $studentId = Auth::user()->student->id;
        $feedbacks = Assignment::with('answer','teacher','subject')->whereHas('answer', function($query){
            $query->whereNotNull('feedback');
        })->paginate(10);
        return view('reports.index')->with(['feedbacks' => $feedbacks]);
    }
}
