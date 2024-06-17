<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 1){
            $files = File::with('users','subject')->paginate(10);
        }else {
            $files = File::with('users','subject')->whereHas('users',function($q){
                $q->where('user_id',Auth::user()->id);
            })->paginate(10);
        }
        return view('files.index')->with(['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('files.create')->with(['subjects' => $subjects]);
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
            'subject_id' => 'required|exists:subjects,id',
            'file' => 'required|mimes:pdf,doc,docx'
        ]);
        $fileUrl = Storage::disk('s3')->putFileAs(config('app.env') . '/files/'.$request->subject_id, $request->file('file'),$request->file('file')->getClientOriginalName());
        File::create([
            'subject_id' => $request->subject_id,
            'file_url' => $fileUrl
        ]);
        return redirect()->route('files.list')->with('success', 'New File created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        $subjects = Subject::all();
        return view('files.edit')->with(['subjects' => $subjects, 'file' => $file]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'dFile' => 'nullable|mimes:pdf,doc,docx'
        ]);
        if($request->dFile){
            $fileUrl = Storage::disk('s3')->putFileAs(config('app.env') . '/files/'.$request->subject_id, $request->file('dFile'),$request->file('dFile')->getClientOriginalName());
        }else {
            $fileUrl = $file->file_url;
        }
        
        $file->update([
            'subject_id' => $request->subject_id,
            'file_url' => $fileUrl
        ]);
        return redirect()->route('files.list')->with('success', 'File updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        $file->users()->detach();
        $file->delete();
        return redirect()->route('files.list')->with('success', 'File deleted successfully!');
    }

    public function assignUser($file)
    {
        $file = File::with('subject.teachers.user')->findOrFail($file);
        $assignedUsers = $file->users()->get();
        return view('files.assign')->with(['file' => $file, 'assignedUsers' => $assignedUsers]);
    }

    public function saveAssign(Request $request, File $file)
    {
        $request->validate([
            'teacher_id' => 'required'
        ]);
        $file->users()->detach();
        $file->users()->attach($request->teacher_id);
        return redirect()->route('files.list')->with('success', 'File assigned successfully!');
    }
}
