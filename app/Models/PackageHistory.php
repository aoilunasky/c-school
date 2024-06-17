<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PackageHistory extends Pivot
{

    const PENDING = 0;
    const CONFIRM = 1;

    protected $table = "package_histories";
    
    protected $fillable = ['package_id', 'student_id', 'date', 'status', 'ticket_amt', 'fees','type', 'invoice_url'];

}
