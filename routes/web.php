<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturesController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\LectureOpenController;
use App\Http\Controllers\AdminController;
use App\Models\Exam;
use App\Models\User;
use App\Models\Sale;
use App\Models\Lecture;
use App\Http\Controllers\Dashboard\ExamController;
use App\Http\Controllers\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\ExamResultController;
use App\Http\Controllers\AssistantQuestionsController;
use App\Http\Controllers\AssignmentDashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Assignment Dashboard Routes
Route::prefix('assignments/dashboard')->name('assignments.dashboard')->group(function () {
    Route::get('/', [AssignmentDashboardController::class, 'index']);
    Route::get('/show', [AssignmentDashboardController::class, 'show'])->name('.show');
});

Route::post('/send-reminder', [AssignmentDashboardController::class, 'sendReminder'])->name('send.reminder');
Route::get('/download-assignment/{id}', [AssignmentDashboardController::class, 'downloadAssignment'])->name('download.assignment');

// Exam Answers Route
Route::get('/exam/{exam}/answers/{attempt}', function ($exam, $attempt) {
    return view('exam-answers', ['examId' => $exam, 'attempt' => $attempt]);
})->name('exam.answers')->middleware('auth');

// Assistant Questions Routes
Route::middleware(['auth', 'verified', 'role'])->group(function () {
    Route::get('/assistant/questions', [AssistantQuestionsController::class, 'index'])->name('assistant.questions');
    Route::post('/assistant/answers', [AssistantQuestionsController::class, 'storeAnswer'])->name('assistant.answers.store');
});

// Public Lecture Routes
Route::get('/MrAhmed', [LecturesController::class, 'index'])->name('index');
Route::get('/MrAhmed/{std}', [LecturesController::class, 'ShowRole'])->name('Lec.3');
Route::get('/MrAhmed/{lecs}/{role}', [LecturesController::class, 'Show'])->name('Lec.1');

Route::get('/', function () {
    return view('index');
});

// Student Routes
Route::prefix('Std')->name('dashboard.Std.')->group(function () {
    Route::get('profile', function () {
        return view('dashboard');
    })->name('profile');
});

// Admin Routes
Route::prefix('Adm')->middleware(['auth', 'role'])->name('dashboard.Adm.')->group(function () {
    
    // Profile & General
    Route::get('/profile/{stddd}/{state}', [AdminController::class, 'Fetchstd'])->name('profilestd');
    Route::get('pro', function () { return view('dashboard'); })->name('pro');

    // QR Management
    Route::prefix('Qr')->group(function () {
        Route::get('/', function () { return view('Qr'); })->name('Qr');
        Route::post('/', [AdminController::class, 'Create'])->name('create');
        Route::post('/a', [AdminController::class, 'Result'])->name('Qr.search');
        Route::post('/b', [AdminController::class, 'Result_b'])->name('Qr.searchb');
    });

    // Lecture Management (One/Two)
    Route::prefix('One')->group(function () {
        Route::get('/', function () {
            $exams = Exam::all();
            return view('One', compact('exams'));
        })->name('one');
        Route::post('/c', [AdminController::class, 'createone'])->name('create.one');
        Route::get('/n', function () {
            $count = request()['Numoflink'];
            return view('One', ['count' => $count]);
        })->name('numoflink');
    });

    Route::get('Two', [AdminController::class, 'Fetch'])->name('two');

    // Edit & User Management
    Route::get('Edit/{lec}', function ($lec) {
        $user = User::find($lec);
        return view('Three', compact('user'));
    })->name('Edit_user');
    
    Route::post('Edit/{lec}/Done', [AdminController::class, 'edit'])->name('Edit.1');
    
    Route::get('Edit/{id}/delete', function ($id) {
        User::where('id', $id)->delete();
        return redirect()->back();
    })->name('delete_user');

    // User Search
    Route::post('user', [AdminController::class, 'sea'])->name('sea');
    Route::post('userid', [AdminController::class, 'sea_id'])->name('sea_id');

    // Lectures & Sales Management
    Route::get('Qrs/{lec}', [AdminController::class, 'Qrs_user'])->name('Qrs_user');
    Route::get('Lec/{lec}', [AdminController::class, 'Lec_user'])->name('Lec_user');
    
    Route::get('Lec/{id}/delete', function ($id) {
        Sale::where('id', $id)->update(['state' => 0]);
        return redirect()->back();
    })->name('delete_sell');
    
    Route::get('Lec/{id}/Active', function ($id) {
        Sale::where('id', $id)->update(['state' => 1]);
        return redirect()->back();
    })->name('Active_sell');

    Route::get('Lecs/{std}/{Role}', [AdminController::class, 'Show'])->name('Lecs');
    Route::get('Lecs/{std}/{id}/edit', [AdminController::class, 'edit_lec'])->name('Edit_lec');
    Route::post('Lecs/{std}/{id}/edit/Done', [AdminController::class, 'edit1'])->name('Edit.2');
    
    Route::get('Lecs/{std}/{id}/delete', function ($std, $id) {
        Lecture::where('id', $id)->delete();
        return redirect()->back();
    })->name('delete_lec');

    // Dashboard Exam Management Routes
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        // Exam Routes
        Route::resource('exams', ExamController::class);
        Route::get('exams/{exam}/questions', [ExamController::class, 'questions'])->name('exams.questions');
        Route::get('exams/{exam}/questions/create', [ExamController::class, 'createQuestion'])->name('exams.create-question');
        Route::post('exams/{exam}/questions', [ExamController::class, 'storeQuestion'])->name('exams.store-question');
        Route::delete('exams/{exam}/questions/{question}', [ExamController::class, 'destroyQuestion'])->name('exams.destroy-question');
        Route::get('exams/{exam}/statistics', [ExamController::class, 'statistics'])->name('exams.statistics');
        Route::post('exams/{exam}/toggle-status', [ExamController::class, 'toggleStatus'])->name('exams.toggle-status');
        
        // New Exam Routes
        Route::get('exams-export', [ExamController::class, 'export'])->name('exams.export');
        Route::post('exams/{exam}/duplicate', [ExamController::class, 'duplicate'])->name('exams.duplicate');
        
        // Question Routes
        Route::resource('questions', QuestionController::class);
        Route::post('questions/{question}/toggle-status', [QuestionController::class, 'toggleStatus'])->name('questions.toggle-status');
        
        // New Question Routes
        Route::post('exams/{exam}/questions-import', [QuestionController::class, 'import'])->name('questions.import');
        Route::get('exams/{exam}/questions-export', [QuestionController::class, 'export'])->name('questions.export');
        Route::post('questions/{question}/duplicate', [QuestionController::class, 'duplicate'])->name('questions.duplicate');
        Route::post('exams/{exam}/questions-reorder', [QuestionController::class, 'reorder'])->name('questions.reorder');
        
        // Exam Results Routes
        Route::get('exams/{exam}/results', [ExamResultController::class, 'index'])->name('exams.results');
        Route::get('exams/{exam}/results/{result}', [ExamResultController::class, 'show'])->name('exams.result-details');
        Route::delete('exams/{exam}/results/{result}', [ExamResultController::class, 'destroy'])->name('exams.result-destroy');
        Route::get('exams/{exam}/results-export', [ExamResultController::class, 'export'])->name('exams.results-export');
        
        // New Exam Results Routes
        Route::post('exams/{exam}/results/{result}/recalculate', [ExamResultController::class, 'recalculate'])->name('exams.result-recalculate');
        Route::delete('exams/{exam}/results-clear', [ExamResultController::class, 'clearAllResults'])->name('exams.results-clear');
        Route::get('exams/{exam}/detailed-report', [ExamResultController::class, 'detailedReport'])->name('exams.detailed-report');
        Route::post('exams/{exam}/results/{result}/send', [ExamResultController::class, 'sendResults'])->name('exams.result-send');
    });
});

// QR Check
Route::post('/qr', [QrController::class, 'check'])->name('Check.Qr');

// Courses
Route::middleware(['auth'])->group(function () {
    Route::get('/MrAhmed/{std}/course/{lecs}/{linkv}', [LectureOpenController::class, 'OpenOne'])->name('course.1');
    Route::get('/MrAhmed/{std}/course/Month/{mon}/{id}', [LectureOpenController::class, 'ShowMonthly'])->name('course.4');
    Route::get('/MrAhmed/{std}/course/Term/{ter}/{id}', [LectureOpenController::class, 'ShowTermely'])->name('course.8');
});

// Dashboard Redirect
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('profilestd', [1, 'Center']);
    })->name('dashboard');
});
