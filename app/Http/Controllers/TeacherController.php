<?php

namespace App\Http\Controllers;

use App\Models\AvailableSchedule;
use App\Models\Country;
use App\Models\File;
use App\Models\Payment;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use App\Notifications\TeacherWarning;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use function Deployer\add;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('teachers.index')->with(['teachers' => $teachers]);
    }

    public function list()
    {
        $teachers = Teacher::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('teachers.list')->with(['teachers' => $teachers]);
    }

    public function stuDetail($id, Request $request)
    {
        $teacher = Teacher::with('user')->find($id);
        $addminutes = Config::get('myapp.ticket_minutes');
        if ($request->startDate) {
            $startDate = Carbon::parse($request->startDate)->startOfWeek(Carbon::SUNDAY);
        } else {
            $startDate = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        }
        if($startDate->lessThan(now())){
            $from = now()->format('Y-m-d');
        }else {
            $from = $startDate->format('Y-m-d');
        }
        $to = $startDate->copy()->addDays(6)->format('Y-m-d');
        $availableSchedules = AvailableSchedule::select('date', 'start_time', 'end_time', 'teacher_id', 'status')->where('teacher_id', $id)->whereBetween('date', [$from, $to])->where('status',0)->get()->mapToGroups(function ($item, $key) {
            if(Carbon::parse($item['date'].' '.$item['start_time'])->greaterThan(now())){
                return [$item['date'] => $item];
            }else {
                return [];
            }
        });
        return view('teachers.stuDetail')->with(['startDate' => $startDate, 'teacher' => $teacher, 'addminutes' => $addminutes, 'availableSchedules' => $availableSchedules]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $countries = Country::all();
        return view('teachers.create')->with(['subjects' => $subjects, 'countries' => $countries]);
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
            'l_name' => 'required',
            'phone' => 'required|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'job_type' => 'required',
            'address' => 'required',
            'education' => 'required',
            'country' => 'required',
            'profile_image' => 'required|mimes:jpeg,png'
        ]);
        $user = User::create([
            'email' => $request->email,
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'role' => User::TEACHER,
            'phone' => $request->phone,
            'password' => Hash::make($request->passwprd),
            'status' => User::CONFIRMED,
        ]);
        $profileImage = Storage::disk('s3')->put(config('app.env') . '/images/teacher', $request->file('profile_image'));
        $teacher = Teacher::create([
            'user_id' => $user->id,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'job_type' => $request->job_type,
            'salary_rate' => $request->salary_rate ?? 0,
            'profile_image' => $profileImage,
            'country_id' => $request->country,
            'responsibility' => $request->responsibility,
            'address' => $request->address,
            'education' => $request->education ?? '',
            'job_history' => $request->job_history ?? '',
            'certificates' => $request->certificates ?? '',
            'strong_points' => $request->strong_points ?? ''
        ]);
        $teacher->subjects()->attach($request->subject_type);

        return redirect()->route('teachers.list')->with('success', 'New Teacher Record created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $addminutes = Config::get('myapp.ticket_minutes');
        $teacher = Teacher::with('user')->find($id);
        if ($request->startDate) {
            $startDate = Carbon::parse($request->startDate)->startOfWeek(Carbon::SUNDAY);
        } else {
            $startDate = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        }
        $from = $startDate->format('Y-m-d');
        $to = $startDate->copy()->addDays(6)->format('Y-m-d');
        $availableSchedules = AvailableSchedule::select('date', 'start_time', 'end_time', 'teacher_id', 'status')->where('teacher_id', $id)->whereBetween('date', [$from, $to])->get()
            ->mapToGroups(function ($item, $key) {
                return [$item['date'] => $item];
            });
        return view('teachers.detail')->with(['startDate' => $startDate, 'teacher' => $teacher, 'addminutes' => $addminutes, 'availableSchedules' => $availableSchedules]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::with('user')->find($id);
        $teachsubject = [];
        foreach ($teacher->subjects as $subject) {
            array_push($teachsubject, $subject->pivot->subject_id);
        }
        $subjects = Subject::all();
        $countries = Country::all();
        return view('teachers.edit')->with(['teacher' => $teacher, 'subjects' => $subjects, 'countries' => $countries, 'teachsubjects' => $teachsubject]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::with('user')->find($id);
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'phone' => 'required|max:15',
            'email' => ['required', Rule::unique('users')->ignore($teacher->user->id), 'email'],
            'gender' => 'required',
            'dob' => 'required',
            'job_type' => 'required',
            'address' => 'required',
            'education' => 'required',
            'country' => 'required',
            'profile_image' => 'nullable|mimes:jpeg,png'
        ]);

        if ($request->profile_image) {
            $imageUrl = Storage::disk('s3')->put(config('app.env') . '/images/teacher', $request->file('profile_image'));
        } else {
            $imageUrl = $teacher->profile_image;
        }
        $teacher->user->email = $request->email;
        $teacher->user->f_name = $request->f_name;
        $teacher->user->l_name = $request->l_name;
        $teacher->user->phone = $request->phone;
        $teacher->user->save();

        $teacher->gender = $request->gender;
        $teacher->dob = $request->dob;
        $teacher->job_type = $request->job_type;
        $teacher->salary_rate = $request->salary_rate;
        $teacher->profile_image = $imageUrl;
        $teacher->country_id = $request->country;
        $teacher->responsibility = $request->responsibility;
        $teacher->address = $request->address;
        $teacher->education = $request->education;
        $teacher->job_history = $request->job_history;
        $teacher->certificates = $request->certificates;
        $teacher->strong_points = $request->strong_points;
        $teacher->skype_link = $request->skype_link;
        $teacher->zoom_link = $request->zoom_link;
        $teacher->nrc = $request->nrc;
        $teacher->passport = $request->passport;
        $teacher->save();
        $teacher->subjects()->detach();
        $teacher->subjects()->attach($request->subject_type);
        return redirect()->route('teachers.list')->with('success', 'Teacher Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->user->delete();
        $teacher->delete();
        return redirect()->route('teachers.list')->with('success', 'Teacher Record deleted successfully!');
    }

    //for individual payment list
  
  
    public function markAbsent(Request $request, Teacher $teacher)
    {
        $teacher->absence_count += 1;
        $teacher->save();

        if ($teacher->absence_count == 3) {
            Notification::send($teacher->user,new TeacherWarning($teacher->user->name));
            return redirect()->route('teachers.list')->with('success', 'Warning Letter send to the Teacher successfully!');
        }
        return redirect()->route('teachers.list')->with('success', 'Teacher marked as absent successfully!');
    }
   public function payment($id)
   {
       
    $teacher = Teacher::with('user')->find($id);
    $payments=Payment::where('teacher_id',$id)
                      ->get();
    $currentmonth=date('m');
    $currentyear=date('Y');
    return view('teachers.payment',['teacher'=>$teacher,'payments'=>$payments,'month'=>$currentmonth,'year'=>$currentyear]);
   }
   public function student($id)
   {
       
    $teacher = Teacher::with('user')->find($id);
    return view('teachers.students',['teacher'=>$teacher]);
   }
   public function files($id)
   {
    $teacher = Teacher::with('user')->find($id);         
    return view('teachers.files',['teacher'=>$teacher]);
   }
   public function paymentSearch(Request $request)
   {
    $teacher = Teacher::with('user')->find($request->teacherid);
    $payments=Payment::whereMonth('date',$request->month)
                      ->whereYear('date',$request->year)
                      ->where('teacher_id',$request->teacherid)
                      ->get();
    $currentmonth=$request->month;
    $currentyear=$request->year;
    
    return view('teachers.payment',['teacher'=>$teacher,'payments'=>$payments,'month'=>$currentmonth,'year'=>$currentyear]);
   }
}
