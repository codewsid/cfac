<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        switch (auth()->user()->role) {
            case 1:
                return redirect('/');
                break;
            case 2:
                return redirect('/office');
                break;
            case 3:
                return redirect('/client');
                break;
            case 4:
                return redirect('/employee');
                break;
            default:
                abort(403);
                break;
        }
    })->name('dashboard');
});

Route::group(['middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified']], function () {

    // ADMIN ROUTES
    Route::group([
        'middleware' => 'admin',
    ], function () {

        Route::get('/', \App\Http\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
        Route::get('/offices', \App\Http\Livewire\Admin\Offices::class)->name('admin.offices');
        Route::get('/report', \App\Http\Livewire\Admin\Report::class)->name('admin.report');

        Route::get('/feedback-criteria', \App\Http\Livewire\Admin\Criteria::class)->name('admin.criteria');
        Route::get('/feedbacks', \App\Http\Livewire\Admin\Feedbacks::class)->name('admin.feedback');
        Route::get('/feedback/{id}/details', \App\Http\Livewire\Admin\FeedbackInfo::class)->name('admin.feedback-info');
        Route::get('/feedback-reply', \App\Http\Livewire\Admin\FeedbackReply::class)->name('admin.reply');

        Route::get('/admin-account', \App\Http\Livewire\Admin\AdminAccount::class)->name('admin.admin-account');
        Route::get('/employee-management', \App\Http\Livewire\Admin\EmployeeManagement::class)->name('admin.employee');
        Route::get('/client-account', \App\Http\Livewire\Admin\ClientAccount::class)->name('admin.client-account');
        Route::get('/office-account', \App\Http\Livewire\Admin\OfficeStaff::class)->name('admin.office-account');
    });

    // OFFICE ROUTES
    Route::group([
        'prefix' => 'office',
        'middleware' => 'office',
    ], function () {

        // Livewire routes
        Route::get('/', \App\Http\Livewire\Office\Main::class)->name('office.main');
        Route::get('/feedback/{id}/details', \App\Http\Livewire\Office\FeedbackInfo::class)->name('office.details');
        Route::get('/office/staff-management', \App\Http\Livewire\Office\StaffManagement::class)->name('office.staff-management');
    });

    // CLIENT ROUTES
    Route::group([
        'prefix' => 'client',
        'middleware' => 'client',
    ], function () {

        // Livewire routes
        Route::get('/', \App\Http\Livewire\Client\Main::class)->name('main');
        Route::get('/feedback-form', \App\Http\Livewire\Client\FeedbackForm::class)->name('client.feedbackform');
        Route::get('/feedback-tracking/{id}', \App\Http\Livewire\Client\TrackFeedback::class)->name('client.feedback-info');
    });

    // EMPLOYEE ROUTES
    Route::group([
        'prefix' => 'employee',
        'middleware' => 'employee',
    ], function () {

        // Livewire routes
        Route::get('/', \App\Http\Livewire\Employee\Main::class)->name('employee');
        Route::get('/feedback/{id}/details', \App\Http\Livewire\Employee\FeedbackInfo::class)->name('employee.details');
    });
});

Route::get('pdf', function () {
    return view('feedback-form-pdf');
});
Route::fallback(fn () => view('fallback'));
