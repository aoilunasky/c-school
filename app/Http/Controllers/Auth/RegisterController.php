<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageHistory;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Notifications\NewStudentRegistered;
use App\Notifications\StudentRegisterInformation;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required'],
            'gender' => ['required'],
            'age' => ['required'],
            'lesson_type' => ['required'],
            'purpose' => ['nullable'],
            'tnc' => ['required']
        ], [
            'tnc.required' => 'Please Read Terms and Condition and check the box.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'f_name' => $data['f_name'],
            'l_name' => $data['l_name'],
            'role' => User::STUDENT,
            'phone' => $data['phone'],
            'status' => User::CONFIRMED,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $student = Student::create([
            'user_id' => $user->id,
            'gender' => $data['gender'],
            'age' => $data['age'],
            'lesson_type' => $data['lesson_type'],
            'purpose' => $data['purpose']
        ]);
        $package = Package::find(1);
        $student->packages()->attach(
            $package->id,
            [
                'date' => now(),
                'status' => PackageHistory::CONFIRM,
                'ticket_amt' => $package->ticket_amount,
                'fees' => $package->fees,
            ]
        );
        $student->ticket_amt = $package->ticket_amount;
        $student->save();

        $admin = User::where('role', 1)->get();
        Notification::send($admin, new NewStudentRegistered($user));

        $student->user->notify(new StudentRegisterInformation($user));
        return $user;
    }
}
