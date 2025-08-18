<?php

use Illuminate\Support\Facades\Route;

// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ManagementCommitteeController;
use App\Http\Controllers\Frontend\AwardController;
use App\Http\Controllers\Frontend\TeamController;
use App\Http\Controllers\Frontend\ScholasticController;
use App\Http\Controllers\Frontend\CoScholasticController;
use App\Http\Controllers\Frontend\LegalController;
use App\Http\Controllers\Frontend\ReportController;
use App\Http\Controllers\Frontend\SponshorshipController;
use App\Http\Controllers\Frontend\ScholarshipController;
use App\Http\Controllers\Frontend\ProgramController;
use App\Http\Controllers\Frontend\MembershipController;
use App\Http\Controllers\Frontend\MembershipDetailController;
use App\Http\Controllers\Frontend\MembershipRegistationController;
use App\Http\Controllers\Frontend\OurDonorsController;
use App\Http\Controllers\Frontend\DonateusController;
use App\Http\Controllers\Frontend\PublicationController;
use App\Http\Controllers\Frontend\EMagazineController;


Route::get('/home', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/about', [AboutUsController::class, 'index'])->name('frontend.aboutus');
Route::get('/management-committee', [ManagementCommitteeController::class, 'index'])->name('frontend.managementcommittee');
Route::get('/awards', [AwardController::class, 'index'])->name('frontend.awards');
Route::get('/team', [TeamController::class, 'index'])->name('frontend.team');
Route::get('/scholastics', [ScholasticController::class, 'index'])->name('frontend.scholastics');
Route::get('/co-scholastics', [CoScholasticController::class, 'index'])->name('frontend.co_scholastic');
Route::get('/legal', [LegalController::class, 'index'])->name('frontend.legal');
Route::get('/annual-reports', [ReportController::class, 'index'])->name('frontend.report');

// --------------------------------------------------------------------------------------------------------------
Route::get('/sponsorship', [SponshorshipController::class, 'index'])->name('frontend.sponsorship');
Route::get('/scholarship', [ScholarshipController::class, 'index'])->name('frontend.scholarship');
Route::post('/scholarship', [ScholarshipController::class, 'store'])->name('frontend.scholarship.store');
Route::get('/program', [ProgramController::class, 'index'])->name('frontend.program');
Route::get('/program-details/{slug}', [ProgramController::class, 'show'])->name('frontend.program.show');
Route::get('/membership', [MembershipController::class, 'index'])->name('frontend.membership');
Route::get('/membership-detail', [MembershipDetailController::class, 'index'])->name('frontend.membership_detail');
Route::get('/membership-registration', [MembershipRegistationController::class, 'index'])->name('frontend.membership_registration');
Route::get('/our-donors', [OurDonorsController::class, 'index'])->name('frontend.our_donors');
Route::get('/donate-us', [DonateusController::class, 'index'])->name('frontend.donate_us');
Route::get('/publications', [PublicationController::class, 'index'])->name('frontend.publication');
Route::get('/e-magazines', [EMagazineController::class, 'index'])->name('frontend.emagazine');

// Event Details

// Route::get('/events', [EventController::class, 'index'])->name('frontend.events.index');
// // Route::get('/events/{id}', [EventController::class, 'show'])->name('frontend.events.details');

Route::prefix('events')->name('frontend.events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');        // All Events
    Route::get('/{id}', [EventController::class, 'show'])->name('details');   // Single Event
});

Route::prefix('events')->name('frontend.blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');        // All Events
    Route::get('/{id}', [BlogController::class, 'show'])->name('details');   // Single Event
});


Route::get('/blog', [BlogController::class, 'index'])->name('frontend.blog.index');
Route::get('/blog_details/{id}', [BlogController::class, 'show'])->name('frontend.blog_details.index');

