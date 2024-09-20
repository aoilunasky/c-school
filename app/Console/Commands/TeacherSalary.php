<?php

namespace App\Console\Commands;

use App\Models\Payment;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TeacherSalary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teachersalary:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $current_month = date("m",strtotime(Carbon::now()));
        $teachers=Teacher::all();

        foreach($teachers as $teacher)
        {
            if(count($teacher->lessonReservations) >0)
            {
                $totaltime=0;
                $totalamount=0;
                foreach($teacher->lessonReservations as $reservation)
                {
                    $month=date("m",strtotime($reservation->date));
                    if($month<$current_month)
                    {
                        $time=(strtotime($reservation->end_time)-strtotime($reservation->start_time))/3600;//change to hr
                        $totaltime=$totaltime+$time;   
                    }  
                    
                }
                if($teacher->job_type==1)
                {
                    $totalamount=$totaltime*$teacher->salary_rate;
                }
                else{
                    $totalamount=$teacher->salary_rate;
                }
               $payment= Payment::create([
                            'teacher_id' => $teacher->id,
                            'total_hour' => $totaltime,
                            'amount'     =>$totalamount,
                            'date'       =>date('Y-m-d')
                            // 'date'       =>date('Y-m-d', strtotime('last day of previous month'))
                        ]); 
                        \Log::info($payment);
            }
            
        }
        
     
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
    }
}
