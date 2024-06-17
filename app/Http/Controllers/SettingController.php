<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class SettingController extends Controller
{
    public function __construct()
    {
        $onetimeSetup = Config::get('myapp.onetime_setup');
        if ($onetimeSetup) {
            abort(404);
        }
    }

    public function index()
    {
        $configs = Config::get('myapp');
        return view('settings.ots')->with(['configs' => $configs]);
    }

    public function store(Request $request)
    {
        $this->updateDotEnv('ONETIME_SETUP',true);
        $this->updateDotEnv('MINUTES_PER_TICKET',$request->min_per_ticket);
        $this->updateDotEnv('NOTI_MINUTES_BEFORE_LESSON_START',$request->noti_minutes_before_lesson_start);
        $this->updateDotEnv('NOTI_MINUTES_BEFORE_ASSIGNMENT_DUE',$request->noti_minutes_before_assignment_deadline);
        $this->updateDotEnv('THEME',$request->theme);
        $this->updateDotEnv('CANCELLATION_ALLOWED_HOUR',$request->allowed_hour);

        $frontendSite = Config::get('myapp.frontend_site_url');

        $response = Http::post($frontendSite, $request);
        
        return redirect()->route('home');
    }

    protected function updateDotEnv($key, $newValue, $delim = '')
    {
        $path = base_path('.env');
        $oldValue = env($key);
        if ($oldValue === $newValue) {
            return;
        }
        if (file_exists($path)) {
            file_put_contents(
                $path,
                str_replace(
                    $key . '=' . $delim . $oldValue . $delim,
                    $key . '=' . $delim . $newValue . $delim,
                    file_get_contents($path)
                )
            );
        }
    }
}
