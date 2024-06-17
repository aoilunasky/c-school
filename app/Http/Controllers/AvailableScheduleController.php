<?php

namespace App\Http\Controllers;

use App\Models\AvailableSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvailableScheduleController extends Controller
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
        if(count(array_filter($request->hasData)) >0){
            foreach ($request->date as $date) {
                $updateId = [];
                foreach (array_filter($request[$date]) as $time) {
                    $updateId[] = AvailableSchedule::updateOrCreate([
                        'teacher_id' => $request->teacher_id,
                        'date' => $date,
                        'start_time' => $time,
                    ], [
                        'teacher_id' => $request->teacher_id,
                        'start_time' => $time,
                        'date' => $date,
                        'end_time' => Carbon::parse($time)->addMinutes(15)->format('H:i:s'),
                        'status' => 0,
                    ])->id;
                }
                AvailableSchedule::where('date',$date)->where('teacher_id',$request->teacher_id)->whereNotIn('id',$updateId)->delete();
    
            }
            return redirect()->back()->with('success', 'Teacher Available Time added successfully!');
        }else {
            return redirect()->back()->with('error', 'Can Not Add Empty Teacher Available Time!!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AvailableSchedule  $availableSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(AvailableSchedule $availableSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AvailableSchedule  $availableSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(AvailableSchedule $availableSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AvailableSchedule  $availableSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AvailableSchedule $availableSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AvailableSchedule  $availableSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(AvailableSchedule $availableSchedule)
    {
        //
    }
}
