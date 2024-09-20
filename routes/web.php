<?php

use App\Models\TermsAndCondition;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return redirect('login');
});
Route::get('/login/{locale}', function ($locale) {
    App::setlocale($locale);
    return view('auth/login');
});

Route::get('/tnc/student', function () {
    $tnc = TermsAndCondition::where('role', 2)->first();
    return view('tnc')->with(['tnc' => $tnc]);
});

Route::get('/tnc/teacher', function () {
    $tnc = TermsAndCondition::where('role', 1)->first();
    return view('tnc')->with(['tnc' => $tnc]);
});

//  Notifications
Route::get('notifications', [\App\Http\Controllers\NotificationController::class, 'index']);
Route::patch('notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead']);
Route::post('notifications/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllRead']);
Route::post('notifications/{id}/dismiss', [\App\Http\Controllers\NotificationController::class, 'dismiss']);

// Push Subscriptions
Route::post('subscriptions', [\App\Http\Controllers\PushSubscriptionController::class, 'update']);
Route::post('subscriptions/delete', [\App\Http\Controllers\PushSubscriptionController::class, 'destroy']);

// Manifest file (optional if VAPID is used)
Route::get('manifest.json', function () {
    return [
        'name' => config('app.name'),
        'gcm_sender_id' => config('webpush.gcm.sender_id'),
    ];
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', function () {
        return view('profile');
    });
    Route::get('/lang/{locale?}', [\App\Http\Controllers\LocalizationController::class, 'index'])->name('lang');

    Route::get('/test-locale', function () {
        return App::getLocale(); // This should return the current locale
    });

    Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings');
    Route::post('/settings/store', [\App\Http\Controllers\SettingController::class, 'store'])->name('settings.store');

    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/get-events', [\App\Http\Controllers\LessonReservationController::class, 'index'])
        ->name('lessonrv.list');
    Route::get('/event/{lessonReservation}/detail', [\App\Http\Controllers\LessonReservationController::class, 'show'])
        ->name('lessonrv.show');
    Route::get('/event/{lessonReservation}/edit', [\App\Http\Controllers\LessonReservationController::class, 'edit'])
        ->name('lessonrv.edit');
    Route::post('/event/{lessonReservation}/update', [\App\Http\Controllers\LessonReservationController::class, 'update'])
        ->name('lessonrv.update');
    Route::delete('/event/{lessonReservation}/delete', [\App\Http\Controllers\LessonReservationController::class, 'destroy'])
        ->name('lessonrv.delete');

    Route::get('/levels', [\App\Http\Controllers\LevelController::class, 'index'])->name('levels.list');
    Route::get('/levels/new', [\App\Http\Controllers\LevelController::class, 'create'])->name('levels.create');
    Route::post('/levels/store', [\App\Http\Controllers\LevelController::class, 'store'])->name('levels.store');
    Route::get('/levels/{level}/edit', [\App\Http\Controllers\LevelController::class, 'edit'])->name('levels.edit');
    Route::post('/levels/{level}/update', [\App\Http\Controllers\LevelController::class, 'update'])->name('levels.update');
    Route::delete('/levels/{level}/delete', [\App\Http\Controllers\LevelController::class, 'destroy'])->name('levels.delete');

    Route::get('/subjects', [\App\Http\Controllers\SubjectController::class, 'index'])->name('subjects.list');
    Route::get('/subjects/new', [\App\Http\Controllers\SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subject/store', [\App\Http\Controllers\SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{subject}/edit', [\App\Http\Controllers\SubjectController::class, 'edit'])->name('subjects.edit');
    Route::post('/subjects/{subject}/update', [\App\Http\Controllers\SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{subject}/delete', [\App\Http\Controllers\SubjectController::class, 'destroy'])->name('subjects.delete');

    Route::get('/chats', [\App\Http\Controllers\ChatController::class, 'index'])->name('chats');
    Route::post('/chat/sendnoti', [\App\Http\Controllers\ChatController::class, 'sendNoti']);

    Route::get('/terms-and-conditions', [\App\Http\Controllers\TermsandconditionsController::class, 'index'])->name('terms-and-conditions');
    Route::post('/terms-and-conditions-update', [\App\Http\Controllers\TermsandconditionsController::class, 'create'])->name('terms-and-conditions-update');

    Route::get('/students', [\App\Http\Controllers\StudentController::class, 'index'])->name('students.list');
    Route::get('/student/new', [\App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
    Route::get('/student/{student}/show', [\App\Http\Controllers\StudentController::class, 'show'])->name('students.show');
    Route::get('/student/{student}/edit', [\App\Http\Controllers\StudentController::class, 'edit'])->name('students.edit');
    Route::post('/student/store', [\App\Http\Controllers\StudentController::class, 'store'])->name('students.store');
    Route::post('/student/{student}/update', [\App\Http\Controllers\StudentController::class, 'update'])->name('students.update');
    Route::get('/student/{student}/delete', [\App\Http\Controllers\StudentController::class, 'destroy'])->name('students.delete');
    Route::get('/student/{id}/packages', [\App\Http\Controllers\StudentController::class, 'packages'])->name('students.packages');
    Route::post('/student/{packagehistory}/confirm', [\App\Http\Controllers\PackageController::class, 'confirmpackage'])->name('students.confirmpackage');

    Route::get('/teachers', [\App\Http\Controllers\TeacherController::class, 'index'])->name('teachers.list');
    Route::get('/teacher/new', [\App\Http\Controllers\TeacherController::class, 'create'])->name('teachers.create');
    Route::get('/teacher/{id}/show', [\App\Http\Controllers\TeacherController::class, 'show'])->name('teachers.show');
    Route::get('/teacher/{id}/edit', [\App\Http\Controllers\TeacherController::class, 'edit'])->name('teachers.edit');
    Route::post('/teacher/store', [\App\Http\Controllers\TeacherController::class, 'store'])->name('teachers.store');
    Route::post('/teacher/{id}/update', [\App\Http\Controllers\TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teacher/{teacher}/delete', [\App\Http\Controllers\TeacherController::class, 'destroy'])->name('teachers.delete');
    Route::post('/availableschedules/store', [\App\Http\Controllers\AvailableScheduleController::class, 'store'])->name('availableschedules.store');
    Route::get('/teacher/{id}/payment', [\App\Http\Controllers\TeacherController::class, 'payment'])->name('teachers.payment');
    Route::post('/teacher/paymentSearch', [\App\Http\Controllers\TeacherController::class, 'paymentSearch'])->name('teachers.paymentSearch');
    Route::get('/teacher/{id}/student', [\App\Http\Controllers\TeacherController::class, 'student'])->name('teachers.student');
    Route::get('/teacher/{id}/files', [\App\Http\Controllers\TeacherController::class, 'files'])->name('teachers.files');
    Route::post('/teacher/{teacher}/mark-absent', [\App\Http\Controllers\TeacherController::class, 'markAbsent'])->name('teachers.mark_absent');

    Route::get('/mfiles', [\App\Http\Controllers\FileController::class, 'index'])->name('files.list');
    Route::get('/mfiles/new', [\App\Http\Controllers\FileController::class, 'create'])->name('files.create');
    Route::get('/mfiles/{file}/assign', [\App\Http\Controllers\FileController::class, 'assignUser'])->name('files.assign');
    Route::get('/mfiles/{file}/edit', [\App\Http\Controllers\FileController::class, 'edit'])->name('files.edit');
    Route::post('/mfile/store', [\App\Http\Controllers\FileController::class, 'store'])->name('files.store');
    Route::delete('/mfile/{file}/delete', [\App\Http\Controllers\FileController::class, 'destroy'])->name('files.delete');
    Route::post('/mfiles/{file}/save-assign', [\App\Http\Controllers\FileController::class, 'saveAssign'])->name('files.assign.store');
    Route::post('/mfiles/{file}/update', [\App\Http\Controllers\FileController::class, 'update'])->name('files.update');

    Route::get('/packages', [\App\Http\Controllers\PackageController::class, 'index'])->name('packages.list');
    Route::get('/packages/new', [\App\Http\Controllers\PackageController::class, 'create'])->name('packages.create');
    Route::post('/packages/store', [\App\Http\Controllers\PackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{package}/edit', [\App\Http\Controllers\PackageController::class, 'edit'])->name('packages.edit');
    Route::post('/packages/{package}/update', [\App\Http\Controllers\PackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{package}/delete', [\App\Http\Controllers\PackageController::class, 'destroy'])->name('packages.delete');

    //Only For Teachers
    Route::get('/assignments', [\App\Http\Controllers\AssignmentController::class, 'index'])->name('assignments.list');
    Route::get('/assignments/{lessonReservation}/create', [\App\Http\Controllers\AssignmentController::class, 'create'])->name('assignment.create');
    Route::post('/assignments/store', [\App\Http\Controllers\AssignmentController::class, 'store'])->name('assignment.store');
    Route::get('/assignments/{assignment}/show', [\App\Http\Controllers\AssignmentController::class, 'show'])->name('assignment.detail');

    Route::post('/answers/{answer}/feedback', [\App\Http\Controllers\AnswerController::class, 'update'])->name('answer.feedback');
    //All Payments
    Route::get('/payments', [\App\Http\Controllers\PaymentController::class, 'index'])->name('payments.list');
    Route::get('/payment/{payment}/show', [\App\Http\Controllers\PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payment/searchPayments', [\App\Http\Controllers\PaymentController::class, 'searchPayments'])->name('payments.searchPayments');
    Route::get('/payment/{payment}/generatePDF', [\App\Http\Controllers\PaymentController::class, 'generatePDF'])->name('payments.generatePDF');
    Route::get('/payment/{payment}/edit', [\App\Http\Controllers\PaymentController::class, 'edit'])->name('payments.edit');
    Route::post('/payment/{payment}/update', [\App\Http\Controllers\PaymentController::class, 'update'])->name('payments.update');
    /**
     * Only For Studnets
     */
    Route::group(['middleware' => 'auth', 'prefix' => 'student'], function () {
        Route::get('/reports', [\App\Http\Controllers\StudentController::class, 'lessonProgressReport'])->name('student.reports');
        Route::get('/assignments', [\App\Http\Controllers\AssignmentController::class, 'studentAssignments'])->name('student.assignments.list');
        Route::get('/lecturers', [\App\Http\Controllers\TeacherController::class, 'list'])->name('student.teachers.list');
        Route::get('/lecturer/{id}', [\App\Http\Controllers\TeacherController::class, 'stuDetail'])->name('student.teachers.detail');
        Route::get('/booking/{id}/{date}/{time}', [\App\Http\Controllers\LessonReservationController::class, 'create'])->name('student.booking.preview');
        Route::post('/make-booking', [\App\Http\Controllers\LessonReservationController::class, 'store'])->name('student.booking.store');

        Route::post('/answer/submit', [\App\Http\Controllers\AnswerController::class, 'store'])->name('student.answer.submit');

        Route::get('/packages', [\App\Http\Controllers\PackageController::class, 'stuPackageList'])->name('student.packages.list');
        Route::get('/package/{package}/buy', [\App\Http\Controllers\PackageController::class, 'buyPackage'])->name('student.package.buy');
        Route::get('/package/history', [\App\Http\Controllers\PackageController::class, 'history'])->name('studnet.package.history');
        Route::post('/package/confirm', [\App\Http\Controllers\PackageController::class, 'makePurchase'])->name('student.package.makePurchase');
        Route::get('/courses', [\App\Http\Controllers\SubjectController::class, 'list'])->name('student.course.list');
        Route::get('/course/{subject}', [\App\Http\Controllers\SubjectController::class, 'show'])->name('student.course.show');
        Route::get('/dashboard', [\App\Http\Controllers\StudentController::class, 'dashboard'])->name('student.dashboard');
    });
});
