<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageHistory;
use App\Models\Student;
use App\Models\User;
use App\Notifications\PackageBuyToAdmin;
use App\Notifications\PackageConfirmed;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Str;
use PDF;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::paginate(10);
        return view('packages.index')->with(['packages' => $packages]);
    }

    public function stuPackageList()
    {
        $packages = Package::where('id', '<>', 1)->paginate(10);
        return view('packages.stu-index')->with(['packages' => $packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packages.create');
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
            'title' => 'required',
            'total_hour' => 'required|numeric|gt:0',
            'fees' => 'required|numeric|gt:0'
        ]);
        $ticketAmt = (60 / 15) * $request->total_hour;
        Package::create([
            'title' => $request->title,
            'total_hours' => $request->total_hour,
            'ticket_amount' => $ticketAmt,
            'fees' => $request->fees
        ]);
        return redirect()->route('packages.list')->with('success', 'New Package Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function buyPackage(Package $package)
    {
        return view('packages.buy')->with(['package' => $package]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('packages.edit')->with(['package' => $package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'title' => 'required',
            'total_hour' => 'required|numeric|gt:0',
            'fees' => 'required|numeric|gte:0'
        ]);
        $minutesPerTicket = Config::get('myapp.ticket_minutes');
        $ticketAmt = (60 / $minutesPerTicket) * $request->total_hour;
        $package->update([
            'title' => $request->title,
            'total_hours' => $request->total_hour,
            'ticket_amount' => $ticketAmt,
            'fees' => $request->fees
        ]);
        return redirect()->route('packages.list')->with('success', 'Package Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.list')->with('success', 'Package Deleted Successfully!');
    }

    public function makePurchase(Request $request)
    {
        $package = Package::find($request->packageid);
        $student = Student::find(Auth::user()->student->id);

        $student->packages()->attach($package->id, ['date' => Carbon::now()->format('Y-m-d'), 'status' => 0, 'ticket_amt' => $package->ticket_amount, 'fees' => $package->fees, 'type' => 1, 'card_name' => $request->owner, 'card_number' => $request->cardnumber, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        $user = User::where('role', 1)->get();
        Notification::send($user, new PackageBuyToAdmin($student->id));

        return redirect()->route('studnet.package.history')->with('success', 'Package Bought Request Send Successfully! Please wait for admin confirmation.');
    }

    public function history()
    {
        $id = Auth::user()->student->id;
        $student = Student::where('id', $id)->with('packages')->first();
        $packages = $student->packages()->orderBy('package_histories.id', 'desc')->get();

        return view('students.ownedpackage')->with(['student' => $student, 'packages' => $packages]);
    }

    /**
     * Confirm student bought package by admin
     */
    public function confirmpackage(Request $request, PackageHistory $packagehistory)
    {
        $tax = Config::get('myapp.tax');
        $student = Student::find($packagehistory->student_id);
        $packagehistory->status = PackageHistory::CONFIRM;
        $packagehistory->save();
        $package = Package::find($packagehistory->package_id);

        $data['studentName'] = $student->user->name;
        $data['date'] = now()->toDateString();
        $data['invoiceNo'] = rand(100000, 999999);
        $data['packageName'] = $package->title;
        $data['amount'] = $package->fees;
        $data['tax'] = $tax;
        $slugMail = Str::slug(Str::before($student->user->email, '@'));
        $path = config('app.env') . '/invoices/' . $slugMail . '/INV-' . $data['invoiceNo'] . '.pdf';

        $pdf = PDF::loadView('pdfs.studentInvoice', compact('data'));
        Storage::disk('s3')->put($path, $pdf->output(), 'public');
        
        $packagehistory->invoice_url = $path;
        $packagehistory->save();

        $student->user->notify(new PackageConfirmed($path));

        return redirect()->route('students.packages', $packagehistory->student_id)->with('success', 'Package Purchased Successfully Confirmed!!');;
    }
}
