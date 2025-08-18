<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ManagementCommitteeController;
use App\Http\Controllers\Frontend\AwardController;
use App\Http\Controllers\Frontend\TeamController;
use App\Http\Controllers\Frontend\VolunteerController;
use App\Http\Controllers\Frontend\AdvisorController;
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
use App\Http\Controllers\Frontend\TestimonialController;
use App\Http\Controllers\Frontend\EMagazineController;
use App\Http\Controllers\Frontend\EMagazineCoverController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\VideoGalleryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CharityController;

use App\Http\Controllers\Frontend\FormRequestController;

use App\Http\Controllers\Frontend\BecomeVolunttersController;
use App\Http\Controllers\Frontend\ComplaintSuggestionController;
use App\Http\Controllers\Frontend\DonationSauseController;

// Avoid redirect loop
Route::get('/admin/login', function () {
    return redirect('/admin'); // or appropriate controller
});


Route::get('/', [HomeController::class, 'index'])->name('frontend.home');
Route::get('/about', [AboutUsController::class, 'index'])->name('frontend.aboutus');
Route::get('/management-committee', [ManagementCommitteeController::class, 'index'])->name('frontend.managementcommittee');
Route::get('/awards', [AwardController::class, 'index'])->name('frontend.awards');
Route::get('/team', [TeamController::class, 'index'])->name('frontend.team');
Route::get('/advisor', [AdvisorController::class, 'index'])->name('frontend.advisor');
Route::get('/volunteers', [VolunteerController::class, 'index'])->name('frontend.Volunteers');
Route::get('/scholastics', [ScholasticController::class, 'index'])->name('frontend.scholastics');
Route::get('/co-scholastics', [CoScholasticController::class, 'index'])->name('frontend.co_scholastic');
Route::get('/legal', [LegalController::class, 'index'])->name('frontend.legal');
Route::get('/annual-reports', [ReportController::class, 'index'])->name('frontend.report');

// --------------------------------------------------------------------------------------------------------------


Route::get('/sponsorship', [SponshorshipController::class, 'index'])->name('frontend.sponsorship');
Route::get('/sponsorship', [SponshorshipController::class, 'store'])->name('frontend.sponsorship');
Route::post('/sponsorship_registation', [SponshorshipController::class, 'store'])->name('frontend.sponsorship_registation');
Route::get('/sponsorship_registation', [SponshorshipController::class, 'index'])->name('frontend.sponsorship_registation.store');

Route::get('/scholarship', [ScholarshipController::class, 'index'])->name('frontend.scholarship');
Route::post('/scholarship', [ScholarshipController::class, 'store'])->name('frontend.scholarship.store');
Route::get('/program', [ProgramController::class, 'index'])->name('frontend.program');
// Route::get('/programs/{slug}', [ProgramController::class, 'show'])->name('frontend.program.show');
Route::get('/programs/{slug}', [ProgramController::class, 'show'])->name('frontend.program.show');

Route::get('/membership', [MembershipController::class, 'index'])->name('frontend.membership');
Route::get('/membership-detail', [MembershipDetailController::class, 'index'])->name('frontend.membership_detail');
Route::get('/membership-registration', [MembershipRegistationController::class, 'index'])->name('frontend.membership_registration');
Route::post('/membership-registration', [MembershipRegistationController::class, 'store'])->name('frontend.membership_registration.store');
// Route::get('/membership-registration', [MembershipRegistationController::class, 'index'])->name('frontend.membership_registration');

Route::get('/our-donors', [OurDonorsController::class, 'index'])->name('frontend.our_donors');
Route::get('/donate-us', [DonateusController::class, 'index'])->name('frontend.donate_us');
Route::get('/publications', [PublicationController::class, 'index'])->name('frontend.publication');
Route::get('/publications/{id}', [PublicationController::class, 'show'])->name('frontend.publication_details.show');
Route::get('/e-magazines_cover', [EMagazineController::class, 'index'])->name('frontend.emagazine');
Route::get('/e-magazines_cover/{id}', [EMagazineController::class, 'show'])->name('frontend.emagazine_details.show');
Route::get('/emagazines/{id}', [\App\Http\Controllers\Frontend\EMagazineController::class, 'show'])
    ->name('frontend.emagazine_details.show');
Route::get('/e-magazines', [EMagazineCoverController::class, 'index'])->name('frontend.emagazinecover');


Route::prefix('donate-us')->group(function () {
    // Route::get('/', [DonateusController::class, 'index'])->name('frontend.donate_us.index');
    Route::get('/create', [DonateusController::class, 'create'])->name('frontend.donate_us.create');
    Route::post('/store', [DonateusController::class, 'store'])->name('frontend.donate_us.store');
    Route::get('/edit/{id}', [DonateusController::class, 'edit'])->name('frontend.donate_us.edit');
    Route::post('/update/{id}', [DonateusController::class, 'update'])->name('frontend.donate_us.update');
    Route::get('/delete/{id}', [DonateusController::class, 'destroy'])->name('frontend.donate_us.delete');
});
// Event Details

// Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events', [EventController::class, 'index'])
    ->name('frontend.events.index');
// // Route::get('/events/{id}', [EventController::class, 'show'])->name('frontend.events_details');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('frontend.events_details.index');


// Route::prefix('events')->name('frontend.blogs.')->group(function () {
//     Route::get('/', [BlogController::class, 'index'])->name('index');        // All Events
//     Route::get('/{id}', [BlogController::class, 'show'])->name('details');   // Single Event
// });


Route::get('/blog', [BlogController::class, 'index'])->name('frontend.blog.index');
Route::get('/blog_details/{id}', [BlogController::class, 'show'])->name('frontend.blog_details.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('frontend.blog_details.index');




// Route::get('/faq', [FaqController::class, 'index'])->name('frontend.faq');
// Route::get('/contactus', [EMagazineCoverController::class, 'index'])->name('frontend.emagazinecover');


Route::get('/gallery', [GalleryController::class, 'index'])->name('frontend.gallery.index');
Route::get('/videogallery', [VideoGalleryController::class, 'index'])->name('frontend.videogallery.index');
Route::get('/testimonial', [TestimonialController::class, 'index'])->name('frontend.testimonial.index');
Route::post('/testimonial/store', [TestimonialController::class, 'store'])->name('frontend.testimonial.store');



Route::get('/faq', function () {
    return view('frontend.faq.index');
})->name('faq');
Route::get('/news', function () {
    return view('frontend.news.index');
})->name('news');
Route::get('/career', function () {
    return view('frontend.career.index');
})->name('career');

// Contact page show
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Contact form submit
Route::post('/contact', [ContactController::class, 'store'])->name('frontend.contact.store');

// Contact detail show (agar zarurat ho admin ya frontend ke liye)
Route::get('/contact/{id}', [ContactController::class, 'show'])->name('contact.show');

// Route::get('/charity_details/',[CharityController::class,'show'])->name('frontend.charity_details.index');
Route::get('/charity-details/{id}', [CharityController::class, 'show'])->name('frontend.charity_details.index');
Route::get('/charity-details/{slug}', [CharityController::class, 'showBySlug'])->name('frontend.charity_details.index');



// Route::post('/form-request', [FormRequestController::class, 'store'])->name('frontend.formrequest.store');

Route::post('/form-request', [FormRequestController::class, 'store'])->name('frontend.formrequest.store');
Route::get('/form-request', [FormRequestController::class, 'create'])->name('frontend.formrequest.create');


// Route::get('/become_volunteers', function () {
//     return view('frontend.become_volunteers.index');
// });

Route::prefix('/')->name('frontend.')->group(function () {
    Route::get('become_volunteers', [BecomeVolunttersController::class, 'index'])->name('become_volunteers.index');
    Route::post('become_volunteers', [BecomeVolunttersController::class, 'store'])->name('become_volunteers.store');
});


Route::prefix('/')->name('frontend.')->group(function () {
    Route::get('complaint_suggestions', [ComplaintSuggestionController::class, 'index'])->name('complaint_suggestions.index');
    Route::post('complaint_suggestions', [ComplaintSuggestionController::class, 'store'])->name('complaint_suggestions.store');
});

Route::get('/charity-donate', function () {
    return view('frontend.charity.index');
})->name('frontend.charity.index');

Route::post('/donate', [DonationSauseController::class, 'store'])->name('frontend.home.introduction.store');

require __DIR__ . '/admin.php';

