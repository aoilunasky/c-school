<?php

namespace Database\Seeders;

use App\Models\TermsAndCondition;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
                [
                    'f_name' => 'Admin',
                    'l_name' => 'One',
                    'role' => User::ADMIN,
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('password'),
                    'status' => User::CONFIRMED,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
        TermsAndCondition::insert(
            [
                [
                    'content' => "<h1>School rules</h1><p><strong>◎ Notes on admission</strong></p><ul><li>Please pay the tuition fee by the start of the lesson.</li><li>Please make additional payment before the number of lessons runs out.</li></ul><p><strong>About lesson reservation policy</strong></p><ul><li><p>Lessons can be reserved from 2 days later.</p></li><li><p>Lessons can be booked from 9am to 8pm.</p></li><li><p>Up to 6 hours of lessons can be booked per day.</p></li</ul><p><strong>About lesson cancellation policy</strong></p><p>Lessons are set so that both students and teachers can cancel at least<strong><u>6 hours</u>&nbsp;</strong>&nbsp;in advance.</p><p><strong><u>If the cancellation time is less than 6 hours, the</u></strong><br />student cannot cancel and the lesson will be completed once.<br />As a penalty, the instructor will add an hour&#39;s worth of lessons to the students.</p><p><strong>◎ About the validity period of the lesson</strong></p><p>The lesson is valid for one year.</p><p>Every time you purchase a lesson, you can take the lesson for one year from that day.</p><p>If one year has passed since the last purchase date, the lesson will be automatically canceled.</p>",
                    'role' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'content' => "<h1>School rules</h1><p><strong>◎ Notes on admission</strong></p><ul><li>Please pay the tuition fee by the start of the lesson.</li><li>Please make additional payment before the number of lessons runs out.</li></ul><p><strong>About lesson reservation policy</strong></p><ul><li><p>Lessons can be reserved from 2 days later.</p></li><li><p>Lessons can be booked from 9am to 8pm.</p></li><li><p>Up to 6 hours of lessons can be booked per day.</p></li</ul><p><strong>About lesson cancellation policy</strong></p><p>Lessons are set so that both students and teachers can cancel at least<strong><u>6 hours</u>&nbsp;</strong>&nbsp;in advance.</p><p><strong><u>If the cancellation time is less than 6 hours, the</u></strong><br />student cannot cancel and the lesson will be completed once.<br />As a penalty, the instructor will add an hour&#39;s worth of lessons to the students.</p><p><strong>◎ About the validity period of the lesson</strong></p><p>The lesson is valid for one year.</p><p>Every time you purchase a lesson, you can take the lesson for one year from that day.</p><p>If one year has passed since the last purchase date, the lesson will be automatically canceled.</p>",
                    'role' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]
        );
    }
}
