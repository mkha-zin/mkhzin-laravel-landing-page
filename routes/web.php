<?php

use App\Http\Controllers\AppLandingController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\LandingController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'localization'], static function () {
    Route::get('/', [LandingController::class, 'index'])->name('home');
    Route::post('save-visitor-msg', [LandingController::class, 'visitorMsg'])->name('save-visitor-msg');
    Route::post('subscribe', [LandingController::class, 'subscribe'])->name('subscribe');
    Route::get('sections', [LandingController::class, 'sections']);
    Route::get('sections/{id}/details', [LandingController::class, 'sectionDetails']);
    Route::get('estore', [AppLandingController::class, 'viewStore']);
    Route::get('offers', [LandingController::class, 'offers']);
    Route::get('about', [LandingController::class, 'about']);
    Route::get('blog', [LandingController::class, 'blog']);
    Route::get('blog/{id}', [LandingController::class, 'post']);
    Route::get('branches', [LandingController::class, 'branches']);
    Route::get('branch/{id}/offers', [LandingController::class, 'branchOffers'])->name('branch.offers');

    Route::get('view-pdf/{id}', [LandingController::class, 'viewPdf']);

    Route::get('contact', [LandingController::class, 'contact']);
    Route::get('vision', [LandingController::class, 'vision']);
    Route::get('goals', [LandingController::class, 'goals']);
    Route::get('fleet', [LandingController::class, 'fleet']);
    Route::get('storages', [LandingController::class, 'storage'])->name('storage');

    Route::get('vouchers', [LandingController::class, 'vouchers']);
    Route::post('vouchers', [LandingController::class, 'checkVouchers']);
    Route::post('use_voucher', [LandingController::class, 'useVoucher'])->name('use_voucher');
    Route::get('cancel_voucher', [LandingController::class, 'cancelVoucher']);

    Route::get('/download_csv', [LandingController::class, 'download'])->name('document.download');
    Route::get('/download_applicator', [LandingController::class, 'downloadApplicatorFiles'])->name('joinus.download');

    Route::get('/departments/{key}', [LandingController::class, 'departments'])->name('departments');

    Route::get('login/{to}', static function ($to) {
        if (Auth::user())
            Auth::logout();
        if ($to === 'home') {
            return redirect('/');
        }

        return redirect('admin/login');
    })->name('login.reset');

    Route::prefix('jobs')->group(static function () {
        Route::get('/', [JobsController::class, 'index'])->name('jobs.index');
        Route::get('/{job}/apply', [JobsController::class, 'apply'])->name('jobs.apply');
        Route::post('/{job}/apply', [JobsController::class, 'store'])->name('jobs.apply.submit');

        Route::get('/general-application', function () {
            return view('jobs.general_application');
        })->name('jobs.general-application');
        Route::post('/general-application', [JobsController::class, 'storeGeneral'])->name('jobs.general-application.submit');

        Route::get('/download_cv', [JobsController::class, 'download'])->name('resume.download');
    });

    Route::get('test', function () {
       return view('branch');
    });

});


Route::get('set-locale/{locale}', static function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->middleware(Localization::class)->name('locale.setting');

