<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Assignment;
use App\Notifications\AssignmentFeedback;
use App\Notifications\AssignmentSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Str;


class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'file' => 'required|mimes:pdf,doc,docx'
        ]);
        $studentId = Auth::user()->student->id;
        $uuid = (string) Str::uuid();
        $fileUrl = Storage::disk('s3')->putFileAs(config('app.env') . '/answers/'.$studentId, $request->file('file'),$uuid.'.'.$request->file('file')->getClientOriginalExtension());
        $answer = Answer::create([
            'assignment_id' => $request->assignment_id,
            'file_url' => $fileUrl,
            'submitted_date' => date('Y-m-d'),
        ]);
        Assignment::find($request->assignment_id)->update(['status',Assignment::ANSWERED]);
        $answer->refresh();
        $answer->assignment->teacher->user->notify(new AssignmentSubmitted);

        return redirect()->route('home')->with('success', 'Assignment Submitted Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            'feedback' => 'required'
        ]);
        $answer->update([
            'feedback' => $request->feedback
        ]);
        $assignment = Assignment::with('student')->find($request->assignment_id);
        $assignment->student->user->notify(new AssignmentFeedback);
        
        return redirect()->route('assignments.list')->with('success', 'Assignment Feedback Give Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
