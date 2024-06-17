<?php

return [
    'onetime_setup' => env('ONETIME_SETUP', false),
    'ticket_minutes' => env('MINUTES_PER_TICKET', 15),
    'noti_minutes_before_lesson_start' => env('NOTI_MINUTES_BEFORE_LESSON_START', false),
    'noti_minutes_before_assignment_deadline' => env('NOTI_MINUTES_BEFORE_ASSIGNMENT_DUE', false),
    'theme' =>  env('THEME', 1),
    'frontend_site_url' => env('FRONTEND_SITE_URL','http://localhost:8000'),
    'cancellation_allowed_hour' => env('cancellation',6),
    'tax' => 5,
];