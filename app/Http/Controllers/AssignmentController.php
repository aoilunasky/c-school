<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Assignment;
use App\Models\LessonReservation;
use App\Notifications\AssignmentReceive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacherId = Auth::user()->teacher->id;
        $students = LessonReservation::with('student', 'subject', 'teacher')->where('teacher_id', $teacherId)->paginate(10);
        $assignments = Assignment::with('student', 'subject')->where('teacher_id', $teacherId)->paginate(10);
        return view('assignments.index')->with(['students' => $students, 'assignments' => $assignments]);
    }


    public function studentAssignments()
    {
        $studentId = Auth::user()->student->id;
        $assignments = Assignment::with('teacher','subject')->where('student_id',$studentId)->orderBy('created_at','desc')->paginate(10);
        return view('assignments.index')->with(['assignments' => $assignments]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(LessonReservation $lessonReservation)
    {
        return view('assignments.create')->with(['lessonRv' => $lessonReservation]);
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
            'student_id' => 'required| exists:students,id',
            'teacher_id' => 'required| exists:teachers,id',
            'subject_id' => 'required| exists:subjects,id',
            'title' => 'required',
            'deadline' => 'required| date|after:today',
            'question' => 'required|mimes:pdf,doc,docx'
        ]);
        $uuid = (string) Str::uuid();
        $fileUrl = Storage::disk('s3')->putFileAs(config('app.env') . '/assignments', $request->file('question'),$uuid.'.'.$request->file('question')->getClientOriginalExtension());
        $assignment = Assignment::create([
            'title' => $request->title,
            'teacher_id' => $request->teacher_id,
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'question_url' => $fileUrl,
            'deadline' => $request->deadline,
            'status' => Assignment::GIVEN
        ]);
        
        $assignment->refresh();
        $assignment->student->user->notify(new AssignmentReceive);

        return redirect()->route('assignments.list')->with('success', 'Assignment Give Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        return view('assignments.detail')->with(['assignment' => $assignment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
