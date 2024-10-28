<?php

namespace App\Http\Controllers;

use App\Models\LessonReservation;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use PDF;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('id', 'desc')->paginate(10);
        $currentmonth = date("m");
        $currentyear = date("Y");
        return view('payments.index')->with(['payments' => $payments, 'month' => $currentmonth, 'year' => $currentyear]);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $month = date("m", strtotime($payment->date));
        $reservations = LessonReservation::where('teacher_id', $payment->teacher_id)
            ->whereMonth('date', $month)->get();

        return view('payments.detail')->with(['payment' => $payment, 'reservations' => $reservations]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::with('teacher')->find($id);
        return view('teachers.updateamount', ['payment' => $payment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->amount = $request->amount ?? $payment->amount;
        $payment->note = $request->note ?? $payment->note;
        $payment->update();

        return redirect()->route('teachers.payment', $payment->teacher_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
    public function searchPayments(Request $request)
    {
        $payments = Payment::whereMonth('date', $request->month)->whereYear('date', $request->year)->orderBy('id', 'desc')->paginate(10);
        $currentmonth = $request->month;
        $currentyear = $request->year;
        return view('payments.index')->with(['payments' => $payments, 'month' => $currentmonth, 'year' => $currentyear]);
    }
    public function generatePDF($id)
    {

        $payment = Payment::where('id', $id)->first();
        $month = date("m", strtotime($payment->date)) - 1;
        $reservationsList = LessonReservation::where('teacher_id', $payment->teacher_id)
            ->whereMonth('date', $month)
            ->get();
        foreach ($reservationsList as $reservation) {
            $student = Student::find($reservation->student_id);
            $reservation->student_name = $student->user->name;
            $reservation->hour = (strtotime($reservation->end_time) - strtotime($reservation->start_time)) / 3600;
            $reservation->price = $payment->teacher->salary_rate * $reservation->hour;

        }
        $reservations = $reservationsList->toarray();
        $name = $payment->teacher->user->name;
        $data = [
            'salaryDetail' => $payment->teacher->job_type_name,
            'name' => $name,
            'date' => $payment->date,
            'total' => $payment->amount,
            'reservations' => $reservations,
            'reservationcount' => count($reservations),
            'hourly_rate' => $payment->teacher->salary_rate ?? 0,
            'note' => $payment->note ?? '-',

        ];

        $pdf = PDF::loadView('pdf', $data);
        return $pdf->download('Payment for ' . $name . '.pdf');
    }
}
