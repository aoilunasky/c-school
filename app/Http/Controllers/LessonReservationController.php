<?php

namespace App\Http\Controllers;

use App\Mail\AcceptLessonCancelToStudent;
use App\Mail\LessonCancelByTeacherToStudent;
use App\Models\AvailableSchedule;
use App\Models\File;
use App\Models\LessonReservation;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Notifications\LessonReservationCancel;
use App\Notifications\LessonReservationTimeChange;
use App\Notifications\NewLessonReservation;
use App\Notifications\ReservationAcceptToStudent;
use App\Rules\CheckValidEndTime;
use App\Rules\CheckValidStartTime;
use App\Rules\CheckValidTicketAmount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class LessonReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $data = LessonReservation::with('teacher.user', 'student.user', 'subject')->whereDate('date', '>=', $request->start)->whereDate('date', '<=', $request->end);
        if ($user->role == User::TEACHER) {
            $data = $data->where('teacher_id', $user->teacher->id);
        }
            $data = $data->get()
            ->map(function ($item, $key) {
                $event['id'] = $item->id;
                $event['start'] = $item->date . 'T' . $item->start_time;
                $event['end'] = $item->date . 'T' . $item->end_time;
                $event['allDay'] = false;
                $event['title'] = $item->student->user->name . ' <=> ' . $item->teacher->user->name . '(on ' . $item->subject->name . ')';
                $event['url'] = url('/event/' . $item->id . '/detail');
                $event['textColor'] = '#ffffff';
                return $event;
            });
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($teacherId, $date, $time)
    {
        $addminutes = Config::get('myapp.ticket_minutes');
        $teacher = Teacher::with('subjects')->find($teacherId);
        $availableTimeSlots = AvailableSchedule::where('teacher_id', $teacherId)->where('date', $date)->where('start_time', '>=', $time)->where('status', 0)->get()->map(function ($item, $key) use ($time, $addminutes) {
            $time = Carbon::parse($time)->addMinutes(($key) * $addminutes)->format('H:i:s');
            if ($item->start_time ==  $time) {
                return $item;
            }
            return false;
        })->reject(function ($value) {
            return $value === false;
        });
        if ($availableTimeSlots->isEmpty()) {
            return redirect()->route('student.teachers.detail', $teacherId)->with('error', 'Teacher is not available at that time slot.');
        }
        return view('lessonreservations.create')->with(['availableTimeSlots' => $availableTimeSlots, 'startTime' => $time, 'teacher' => $teacher, 'date' => $date]);
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
            'studentId' => 'required|exists:students,id',
            'teacherId' => 'required|exists:teachers,id',
            'subject' => 'required| exists:subjects,id',
            'startTime' => ['required', 'exists:available_schedules,id',  new CheckValidStartTime],
            'endTime' => ['required',  new CheckValidEndTime($request->startTime), new CheckValidTicketAmount($request->startTime, $request->studentId)]
        ]);

        $startTime = AvailableSchedule::find($request->startTime);
        $start = Carbon::parse($startTime->start_time);
        $end = Carbon::parse($request->endTime);
        $value = $end->diffInMinutes($start);
        $ticketAmt = $value / 15;
        $teacher = Teacher::find($request->teacherId);
        switch ($request->type) {
            case '1':
                $lessonLink =  $teacher->zoom_link;
                break;
            case '2':
                $lessonLink =  $teacher->skype_link;
                break;
            default:
                $lessonLink =  $teacher->zoom_link;
                break;
        }
        $lessonRv = LessonReservation::create([
            'teacher_id' => $request->teacherId,
            'student_id' => $request->studentId,
            'subject_id' => $request->subject,
            'start_time' => $startTime->start_time,
            'end_time' => $request->endTime,
            'date' => $startTime->date,
            'lesson_link' => $lessonLink,
            'request'  => $request->q
        ]);
        AvailableSchedule::where('teacher_id', $startTime->teacher_id)->where('date', $startTime->date)->where('start_time', '>=', $start->subMinutes(15)->toTimeString())->where('end_time', '<=', $end->addMinutes(15)->toTimeString())->update([
            'status' => 1
        ]);
        $student = Student::find($request->studentId);
        $student->ticket_amt = $student->ticket_amt - $ticketAmt;
        $student->save();

        $files = File::where('subject_id', $request->subject)->pluck('id');
        Auth::user()->files()->attach($files->toArray());
        $lessonRv->refresh();

        $user = User::where('role', 1)->get();
        $user[] = $lessonRv->teacher->user;
        Notification::send($user, new NewLessonReservation($lessonRv));
        $lessonRv->student->user->notify(new ReservationAcceptToStudent($lessonRv));

        return redirect()->route('student.teachers.detail', $request->teacherId)->with('success', 'Lesson Reserved Success.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LessonReservation  $lessonReservation
     * @return \Illuminate\Http\Response
     */
    public function show(LessonReservation $lessonReservation)
    {
        return view('lessonreservations.detail')->with(['event' => $lessonReservation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonReservation  $lessonReservation
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonReservation $lessonReservation)
    {
        return view('lessonreservations.edit')->with(['event' => $lessonReservation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonReservation  $lessonReservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LessonReservation $lessonReservation)
    {
        $startTime = $lessonReservation->date . ' ' . $lessonReservation->start_time;
        if (Carbon::parse($startTime)->subHours(6)->greaterThan(now())) {
            $lessonReservation->update([
                'lesson_link' => $request->lesson_link,
                'request' => $request->q
            ]);
            if (Auth::user()->role == User::ADMIN) {
                $token[] = $lessonReservation->teacher->user->notify(new LessonReservationTimeChange);
            } else if (Auth::user()->role == User::TEACHER) {
                $admin = User::where('role', 1)->get();
                foreach ($admin as $user) {
                    $user->notify(new LessonReservationTimeChange);
                }
            }
            $lessonReservation->student->user->notify(new LessonReservationTimeChange);
            return redirect()->route('home')->with('success', "Lesson Reservation Edited.");
        } else {
            return redirect()->back()->with('error', "Can't edit the lesson.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonReservation  $lessonReservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonReservation $lessonReservation)
    {
        $minutesPerTicket = Config::get('myapp.ticket_minutes');
        $startTime = $lessonReservation->date . ' ' . $lessonReservation->start_time;
        if (Carbon::parse($startTime)->subHours(6)->greaterThan(now())) {
            $duration = Carbon::parse($lessonReservation->end_time)->diffInMinutes(Carbon::parse($lessonReservation->start_time));
            $ticketAmt = $duration / $minutesPerTicket;
            $lessonReservation->student->increaseTicketAmt($ticketAmt);
            $preTimeSlot = Carbon::parse($lessonReservation->start_time)->subMinutes($minutesPerTicket)->format('H:i:s');
            AvailableSchedule::where('teacher_id', $lessonReservation->teacher_id)
                ->where('date', $lessonReservation->date)
                ->where('start_time', '>=', $preTimeSlot)
                ->where('start_time', '<=', $lessonReservation->end_time)
                ->update(['status' => 0]);
            if (Auth::user()->role == User::ADMIN) {
                $lessonReservation->teacher->user->notify(new LessonReservationCancel);
                Mail::to($lessonReservation->student->user)
                    ->later(now()->addMinutes(3), new LessonCancelByTeacherToStudent($lessonReservation));
            } elseif (Auth::user()->role == User::TEACHER) {
                $admin = User::where('role', 1)->get();
                Notification::send($admin, new LessonReservationCancel);
                Mail::to($lessonReservation->student->user)
                    ->later(now()->addMinutes(3), new LessonCancelByTeacherToStudent($lessonReservation));
            } elseif (Auth::user()->role == User::STUDENT) {
                Mail::to($lessonReservation->student->user)
                    ->later(now()->addMinutes(3), new AcceptLessonCancelToStudent($lessonReservation));
            }
            $lessonReservation->delete();
            return redirect()->route('home')->with('success', "Lesson Reservation Canceled.");
        }
        return redirect()->back()->with('error', "Can't cancel the lesson.");
    }
}

