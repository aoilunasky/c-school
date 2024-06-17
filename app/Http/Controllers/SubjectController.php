<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::orderBy('id', 'desc')->paginate(10);
        return view('subjects.index')->with(['subjects' => $subjects]);
    }

    public function list()
    {
        $subjects = Subject::paginate(10);
        return view('subjects.stu-list')->with(['subjects' => $subjects]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $levels = Level::all();
        return view('subjects.create')->with(['levels' => $levels]);
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
            'name' => 'required',
            'level_id' => 'required|exists:levels,id',
        ]);
        Subject::create([
            'name' => $request->name,
            'level_id' => $request->level_id,
        ]);
        return redirect()->route('subjects.list')->with('success', 'Subject Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subjects
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('subjects.detail')->with(['subject' => $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $levels = Level::all();
        return view('subjects.edit')->with(['levels' => $levels, 'subject' => $subject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subjects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
            'level_id' => 'required|exists:levels,id',
        ]);
        $subject->update([
            'name' => $request->name,
            'level_id' => $request->level_id,
        ]);
        return redirect()->route('subjects.list')->with('success', 'Subject Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subjects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.list')->with('success', 'Subject Deleted Successfully!');
    }
}
