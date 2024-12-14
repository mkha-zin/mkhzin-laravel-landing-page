<?php

use App\Http\Controllers\LandingController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'localization'], function () {
    Route::get('/', [LandingController::class, 'index']);
    Route::post('save-visitor-msg', [LandingController::class, 'visitorMsg'])->name('save-visitor-msg');
    Route::post('subscribe', [LandingController::class, 'subscribe'])->name('subscribe');
    Route::get('sections', [LandingController::class, 'sections']);
    Route::get('sections/{id}/details', [LandingController::class, 'sectionDetails']);
    Route::get('mkhazin-store', [LandingController::class, 'viewStore']);
    Route::get('offers', [LandingController::class, 'offers']);
    Route::get('about', [LandingController::class, 'about']);
    Route::get('jobs', [LandingController::class, 'jobs']);
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
});




Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->middleware(Localization::class)->name('locale.setting');

