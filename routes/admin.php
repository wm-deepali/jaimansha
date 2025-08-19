<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Settings\AccountSettingController;
use App\Http\Controllers\Admin\Settings\ProfileSettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContentManagement\HeaderController;
use App\Http\Controllers\Admin\ContentManagement\FooterController;
use App\Http\Controllers\Admin\ContentManagement\SocialMediaController;
use App\Http\Controllers\Admin\ContentManagement\SliderController;
use App\Http\Controllers\Admin\ContentManagement\AboutUsController;
use App\Http\Controllers\Admin\ContentManagement\VisionMissionController;
use App\Http\Controllers\Admin\ContentManagement\ObjectivesController;
use App\Http\Controllers\Admin\ContentManagement\ManagementCommitteeController;
use App\Http\Controllers\Admin\ContentManagement\TeamController;
use App\Http\Controllers\Admin\ContentManagement\AwardsCertificationsController;
use App\Http\Controllers\Admin\ContentManagement\LegalController;
use App\Http\Controllers\Admin\ContentManagement\ScholasticsController;
use App\Http\Controllers\Admin\ContentManagement\CoScholasticController;
use App\Http\Controllers\Admin\ContentManagement\SponsorshipController;
// use App\Http\Controllers\Admin\ContentManagement\SponsorshipRegistationController;
use App\Http\Controllers\Admin\ContentManagement\SponsorshipRegistationController;

use App\Http\Controllers\Admin\ContentManagement\DonatePageController;

use App\Http\Controllers\Admin\ManageIntroduction\IntroductionController;
use App\Http\Controllers\Admin\ManageIntroduction\IntroductionFeatureController;

use App\Http\Controllers\Admin\ScholarshipManagement\ScholarshipController;
use App\Http\Controllers\Admin\ScholarshipManagement\ScholarshipContentController;
use App\Http\Controllers\Admin\ScholarshipManagement\ScholarshipEnquiryController;

use App\Http\Controllers\Admin\MembershipManagement\MembershipPageController;
use App\Http\Controllers\Admin\MembershipManagement\MembershipPackageController;
use App\Http\Controllers\Admin\MembershipManagement\MembershipEnquiryController;
use App\Http\Controllers\Admin\MembershipManagement\RegisteredMemberController;
use App\Http\Controllers\Admin\MembershipManagement\MemberNotificationController;

use App\Http\Controllers\Admin\EMagazine\EMagazineCategoryController;
use App\Http\Controllers\Admin\EMagazine\EMagazineAuthorController;
use App\Http\Controllers\Admin\EMagazine\EMagazinePublicationController;
use App\Models\Admin\scholarship\ScholarshipEnquiry;

use App\Http\Controllers\Admin\Publications\PublicationArticleController;
use App\Http\Controllers\Admin\Publications\PublicationCategoryController;
use App\Http\Controllers\Admin\Publications\PublicationAuthorController;

use App\Http\Controllers\Admin\Donations\DonationDonorController;
use App\Http\Controllers\Admin\Donations\DonationTransactionController;

use App\Http\Controllers\Admin\Gallery\GalleryCategoryController;
use App\Http\Controllers\Admin\Gallery\GalleryMediaController;

use App\Http\Controllers\Admin\ContentManagement\AwardsController;
use App\Http\Controllers\Admin\Courses\CourseAdmissionController;
use App\Http\Controllers\Admin\Courses\CourseCategoryController;
use App\Http\Controllers\Admin\Courses\CourseContentController;

use App\Http\Controllers\Admin\BlogsFaq\BlogCategoryController;
use App\Http\Controllers\Admin\BlogsFaq\BlogContentController;
use App\Http\Controllers\Admin\BlogsFaq\FaqManagementController;
use App\Models\Admin\ManageIntroduction\Introduction;

use App\Http\Controllers\Admin\event\EventManagmentController;
use App\Http\Controllers\Admin\event\RegistationManagmentController;


use App\Http\Controllers\Admin\Donations\DonationCategoryController;
use App\Http\Controllers\Admin\Donations\DonationCaseController;

use App\Http\Controllers\Admin\Program\ProgramController;
use App\Http\Controllers\Admin\Feedback\FeedbackController;
// use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\BrochureController;

use App\Http\Controllers\Admin\FormRequestController;
use App\Http\Controllers\Admin\NewsletterController;

use App\Http\Controllers\Admin\DonationSetting\DonationController;
use App\Http\Controllers\Admin\Donations\DonationSauseController;


// Guest-only routes (if already logged in, redirect to dashboard)
Route::middleware('admin_guest')->group(function () {
    Route::get('admin/login', [AccountSettingController::class, 'showLoginForm'])->name('admin.account.login');
    Route::post('admin/login', [AccountSettingController::class, 'login'])->name('admin.account.login.submit');
});

// Authenticated admin-only routes
Route::middleware('admin_auth')->group(function () {
    Route::prefix('admin/settings')->group(function () {
        Route::get('/account', [AccountSettingController::class, 'index'])->name('admin.settings.account');
        Route::get('/profile', [ProfileSettingController::class, 'index'])->name('admin.settings.profile');
        Route::post('/account/change-password', [AccountSettingController::class, 'changePassword'])->name('admin.settings.account.changePassword');
    });

    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('admin/logout', [AccountSettingController::class, 'logout'])->name('admin.account.logout');
    Route::get('/admin/content/header', [HeaderController::class, 'index'])->name('admin.content.header');
    Route::post('admin/header/store', [HeaderController::class, 'store'])->name('admin.header.store');


    Route::prefix('admin/header')->group(function () {
        Route::get('/edit/{id}', [HeaderController::class, 'edit'])->name('admin.header.edit');
        Route::post('/update/{id}', [HeaderController::class, 'update'])->name('admin.header.update');
        // Route::get('/delete/{id}', [HeaderController::class, 'destroy'])->name('admin.header.delete');
        Route::delete('/delete/{id}', [HeaderController::class, 'destroy'])->name('admin.header.delete');

        Route::get('admin/header', [HeaderController::class, 'index'])->name('admin.header.index');
    });

    Route::prefix('admin/footer')->name('admin.footer.')->controller(FooterController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });


    Route::prefix('admin/socialmedia')->name('admin.socialmedia.')->group(function () {
        Route::get('/', [SocialMediaController::class, 'view'])->name('view');
        Route::post('/update', [SocialMediaController::class, 'update'])->name('update');
    });

    Route::prefix('admin/sliders')->name('admin.sliders.')->controller(SliderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::prefix('admin/manageintroduction/introduction')
        ->name('admin.manageintroduction.introduction.')
        ->controller(IntroductionController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });


    Route::prefix('admin/manageintroduction/feature')
        ->name('admin.manageintroduction.feature.')
        ->controller(IntroductionFeatureController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus.index');
        Route::post('/aboutus/store', [AboutUsController::class, 'store'])->name('aboutus.store');
        Route::post('/aboutus/update/{id}', [AboutUsController::class, 'update'])->name('aboutus.update');
        Route::delete('/aboutus/delete/{id}', [AboutUsController::class, 'destroy'])->name('aboutus.destroy');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('vision', VisionMissionController::class);

    });

    Route::prefix('admin')->name('admin.events.')->group(function () {
        Route::resource('event', EventManagmentController::class);
    });

    Route::prefix('admin')->name('admin.events.')->group(function () {
        Route::resource('registation', RegistationManagmentController::class);
    });
    Route::prefix('admin/donate')->name('admin.donate.')->group(function () {
        Route::get('/', [DonatePageController::class, 'index'])->name('index');
        Route::post('/store', [DonatePageController::class, 'store'])->name('store');
        Route::put('/update/{id}', [DonatePageController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [DonatePageController::class, 'destroy'])->name('delete');
    });



    Route::prefix('admin/content')->name('admin.')->group(function () {
        Route::get('/objectives', [ObjectivesController::class, 'index'])->name('objectives.index');
        Route::post('/objectives/store', [ObjectivesController::class, 'store'])->name('objectives.store');
        Route::get('/objectives/edit/{id}', [ObjectivesController::class, 'edit'])->name('objectives.edit');
        // Route::post('/objectives/update/{id}', [ObjectivesController::class, 'update'])->name('objectives.update');
        Route::put('/objectives/update/{id}', [ObjectivesController::class, 'update'])->name('objectives.update');

        Route::delete('/objectives/delete/{id}', [ObjectivesController::class, 'destroy'])->name('objectives.destroy');
    });


    Route::prefix('admin/content')->name('admin.managementcommittee.')->group(function () {
        Route::get('/management-committee', [ManagementCommitteeController::class, 'index'])->name('index');
        Route::post('/management-committee/store', [ManagementCommitteeController::class, 'store'])->name('store');
        Route::put('/management-committee/update/{id}', [ManagementCommitteeController::class, 'update'])->name('update');
        Route::get('/management-committee/edit/{id}', [ManagementCommitteeController::class, 'edit'])->name('edit');
        Route::delete('/management-committee/delete/{id}', [ManagementCommitteeController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('team', TeamController::class);
    });

    Route::prefix('admin/awards')->name('admin.awards.')->group(function () {
        Route::get('/', [AwardsController::class, 'index'])->name('index');
        Route::post('/store', [AwardsController::class, 'store'])->name('store');
        Route::post('/update/{id}', [AwardsController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AwardsController::class, 'destroy'])->name('destroy');
    });



    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('certifications', AwardsCertificationsController::class);
        Route::get('certifications/view/{id}', [AwardsCertificationsController::class, 'show'])->name('certifications.view');
        Route::put('certifications/update/{id}', [AwardsCertificationsController::class, 'update'])->name('certifications.update');
    });


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('legal', LegalController::class);
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('scholastics', ScholasticsController::class);

    });


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('co_scholastics', CoScholasticController::class);

    });



    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/sponsorship', [SponsorshipController::class, 'index'])->name('sponsorship.index');
        Route::post('/sponsorship', [SponsorshipController::class, 'store'])->name('sponsorship.store');
        Route::put('/sponsorship/update/{id}', [SponsorshipController::class, 'update'])->name('sponsorship.update');
        Route::delete('/sponsorship/{id}', [SponsorshipController::class, 'destroy'])->name('sponsorship.destroy');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/sponsorship_registation', [SponsorshipRegistationController::class, 'index'])->name('sponsorship_registation.index');
        Route::post('/sponsorship_registation', [SponsorshipRegistationController::class, 'store'])->name('sponsorship_registation.store');
        Route::put('/sponsorship_registation/update/{id}', [SponsorshipRegistationController::class, 'update'])->name('sponsorship_registation.update');
        Route::delete('/sponsorship_registation/{id}', [SponsorshipRegistationController::class, 'destroy'])->name('sponsorship_registation.destroy');
    });

    Route::prefix('admin')->name('admin.')->group(function () {

        // Scholarship Content Routes
        Route::get('/scholarship-content', [ScholarshipContentController::class, 'index'])->name('scholarship_content.index');
        Route::get('/scholarship-content/create', [ScholarshipContentController::class, 'create'])->name('scholarship_content.create');
        Route::post('/scholarship-content', [ScholarshipContentController::class, 'store'])->name('scholarship_content.store');
        Route::get('/scholarship-content/edit/{id}', [ScholarshipContentController::class, 'edit'])->name('scholarship_content.edit');
        Route::put('/scholarship-content/update/{id}', [ScholarshipContentController::class, 'update'])->name('scholarship_content.update');
        Route::delete('/scholarship-content/{id}', [ScholarshipContentController::class, 'destroy'])->name('scholarship_content.delete');

    });


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
        Route::get('scholarships/create', [ScholarshipController::class, 'create'])->name('scholarships.create');
        Route::post('scholarships/store', [ScholarshipController::class, 'store'])->name('scholarships.store');
        Route::get('scholarships/edit/{id}', [ScholarshipController::class, 'edit'])->name('scholarships.edit');
        Route::post('scholarships/update/{id}', [ScholarshipController::class, 'update'])->name('scholarships.update');
        Route::get('scholarships/delete/{id}', [ScholarshipController::class, 'delete'])->name('scholarships.delete');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('scholarshipenquiries', ScholarshipEnquiryController::class);
    });


    // Route::get('/admin/scholarship-enquiries/view/{id}', [ScholarshipEnquiryController::class, 'show']);

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('membership', MembershipPageController::class)->except(['show']);
    });


    Route::prefix('admin/membership/packages')->name('admin.membership.packages.')->group(function () {
        Route::get('/', [MembershipPackageController::class, 'index'])->name('index');
        Route::get('/create', [MembershipPackageController::class, 'create'])->name('create');
        Route::post('/store', [MembershipPackageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [MembershipPackageController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [MembershipPackageController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [MembershipPackageController::class, 'destroy'])->name('destroy');
    });



    Route::get('admin/membership/enquiry/index', [MembershipEnquiryController::class, 'index'])->name('admin.membership.enquiry.index');
    Route::post('admin/membership/enquiry/store', [MembershipEnquiryController::class, 'store'])->name('admin.membership.enquiry.store');
    Route::put('admin/membership/enquiry/update/{id}', [MembershipEnquiryController::class, 'update'])->name('admin.membership.enquiry.update');
    Route::delete('admin/membership/enquiry/delete/{id}', [MembershipEnquiryController::class, 'destroy'])->name('admin.membership.enquiry.delete');

    // Registered Members routes
    Route::get('admin/membership/registered/index', [RegisteredMemberController::class, 'index'])->name('admin.membership.registered.index');
    Route::post('admin/membership/registered/store', [RegisteredMemberController::class, 'store'])->name('admin.membership.registered.store');
    Route::put('admin/membership/registered/update/{id}', [RegisteredMemberController::class, 'update'])->name('admin.membership.registered.update');
    Route::delete('admin/membership/registered/delete/{id}', [RegisteredMemberController::class, 'destroy'])->name('admin.membership.registered.delete');

    // View/Edit in MembershipController
    Route::get('view/{id}', [RegisteredMemberController::class, 'view'])->name('admin.membership.registered.view');
    Route::get('edit/{id}', [RegisteredMemberController::class, 'edit'])->name('admin.membership.registered.edit');
    Route::delete('delete/{id}', [RegisteredMemberController::class, 'destroy'])->name('admin.membership.registered.delete');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('notifications', [MemberNotificationController::class, 'index'])->name('notifications.index');
        Route::post('notifications', [MemberNotificationController::class, 'store'])->name('notifications.store');
        Route::put('notifications/{id}', [MemberNotificationController::class, 'update'])->name('notifications.update');
        Route::delete('notifications/{id}', [MemberNotificationController::class, 'destroy'])->name('notifications.destroy');
    });

    Route::prefix('admin/emagazine/categories')->name('admin.emagazine.categories.')->group(function () {
        Route::get('/', [EMagazineCategoryController::class, 'index'])->name('index');
        Route::post('/store', [EMagazineCategoryController::class, 'store'])->name('store');

        // âœ… Only this one for updating
        Route::put('/update/{id}', [EMagazineCategoryController::class, 'update'])->name('update');

        Route::delete('/delete/{id}', [EMagazineCategoryController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('admin/emagazine/authors')->name('admin.emagazine.authors.')->group(function () {
        Route::get('/', [EMagazineAuthorController::class, 'index'])->name('index');
        Route::post('/store', [EMagazineAuthorController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [EMagazineAuthorController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [EMagazineAuthorController::class, 'update'])->name('update'); // ðŸ”¥ Important
        // Route::post('/update/{id}', [EMagazineAuthorController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [EMagazineAuthorController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/emagazine/publication')->name('admin.emagazine.publication.')->group(function () {
        Route::get('/', [EMagazinePublicationController::class, 'index'])->name('index');
        Route::post('/store', [EMagazinePublicationController::class, 'store'])->name('store');
        Route::post('/update/{id}', [EMagazinePublicationController::class, 'update'])->name('update');
        Route::put('/update/{id}', [EMagazineCategoryController::class, 'update'])->name('update');
        Route::put('/update/{id}', [EMagazineCategoryController::class, 'update'])->name('update');

        Route::post('/delete/{id}', [EMagazinePublicationController::class, 'destroy'])->name('destroy');
        Route::get('/get/{id}', [EMagazinePublicationController::class, 'getPublication'])->name('get');
    });


    Route::prefix('admin/publications/categories')->name('admin.publications.categories.')->group(function () {
        Route::get('/', [PublicationCategoryController::class, 'index'])->name('index');
        Route::post('/store', [PublicationCategoryController::class, 'store'])->name('store');

        // âœ… Only this one for updating
        Route::put('/update/{id}', [PublicationCategoryController::class, 'update'])->name('update');

        Route::delete('/delete/{id}', [PublicationCategoryController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('admin/publications/authors')->name('admin.publications.authors.')->group(function () {
        Route::get('/', [PublicationAuthorController::class, 'index'])->name('index');
        Route::post('/store', [PublicationAuthorController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PublicationAuthorController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PublicationAuthorController::class, 'update'])->name('update'); // ðŸ”¥ Important
        // Route::post('/update/{id}', [PublicationAuthorController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [PublicationAuthorController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/publications/publication')->name('admin.publications.publication.')->group(function () {
        Route::get('/', [PublicationArticleController::class, 'index'])->name('index');
        Route::post('/store', [PublicationArticleController::class, 'store'])->name('store');
        Route::post('/update/{id}', [PublicationArticleController::class, 'update'])->name('update');
        Route::put('/update/{id}', [PublicationCategoryController::class, 'update'])->name('update');
        Route::put('/update/{id}', [EMagazineCategoryController::class, 'update'])->name('update');

        Route::post('/delete/{id}', [PublicationArticleController::class, 'destroy'])->name('destroy');
        Route::get('/get/{id}', [PublicationArticleController::class, 'getPublication'])->name('get');
    });


    Route::prefix('admin/donations/donors')->name('admin.donations.donors.')->group(function () {
        Route::get('/', [DonationDonorController::class, 'index'])->name('index');
        Route::get('/create', [DonationDonorController::class, 'create'])->name('create');
        Route::post('/store', [DonationDonorController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DonationDonorController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [DonationDonorController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [DonationDonorController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('admin/donations/transactions')->name('admin.donations.transactions.')->group(function () {
        Route::get('/', [DonationTransactionController::class, 'index'])->name('index');
        Route::get('/create', [DonationTransactionController::class, 'create'])->name('create');
        Route::post('/store', [DonationTransactionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DonationTransactionController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [DonationTransactionController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [DonationTransactionController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('admin/gallery/categories')->name('admin.gallery.categories.')->group(function () {
        Route::get('/', [GalleryCategoryController::class, 'index'])->name('index');
        Route::post('/store', [GalleryCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [GalleryCategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [GalleryCategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [GalleryCategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/gallery/media')->name('admin.gallery.media.')->group(function () {
        Route::get('/', [GalleryMediaController::class, 'index'])->name('index');
        Route::post('/store', [GalleryMediaController::class, 'store'])->name('store');
        Route::put('/update/{id}', [GalleryMediaController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [GalleryMediaController::class, 'destroy'])->name('destroy');
        Route::patch('/status/{id}', [GalleryMediaController::class, 'toggleStatus'])->name('status');
    });

    Route::prefix('admin/courses/categories')->name('admin.courses.categories.')->group(function () {
        Route::get('/', [CourseCategoryController::class, 'index'])->name('index');
        Route::post('/store', [CourseCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CourseCategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CourseCategoryController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CourseCategoryController::class, 'destroy'])->name('destroy'); // âœ… Required
    });

    Route::prefix('admin/courses/content')->name('admin.courses.content.')->group(function () {
        Route::get('/', [CourseContentController::class, 'index'])->name('index');
        Route::post('/store', [CourseContentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CourseContentController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CourseContentController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CourseContentController::class, 'destroy'])->name('destroy'); // âœ… Required
    });


    Route::prefix('admin/courses/admissionenquiries')->name('admin.courses.admissionenquiries.')->group(function () {
        Route::get('/', [CourseAdmissionController::class, 'index'])->name('index');
        Route::post('/store', [CourseAdmissionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CourseAdmissionController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CourseAdmissionController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [CourseAdmissionController::class, 'destroy'])->name('destroy'); // âœ… Required
    });


    // web.php ya admin routes file mein
    Route::prefix('admin/blogs/categories')->name('admin.blogs.categories.')->group(function () {
        Route::get('/', [BlogCategoryController::class, 'index'])->name('index');
        Route::post('/store', [BlogCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BlogCategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BlogCategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BlogCategoryController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('admin/blogs/contents')->name('admin.blogs.contents.')->group(function () {
        Route::get('/', [BlogContentController::class, 'index'])->name('index');
        Route::post('/store', [BlogContentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BlogContentController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BlogContentController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BlogContentController::class, 'destroy'])->name('delete');
    });

    Route::prefix('admin/blogs/faqs')->name('admin.blogs.faqs.')->group(function () {
        Route::get('/', [FaqManagementController::class, 'index'])->name('index');
        Route::post('/store', [FaqManagementController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [FaqManagementController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [FaqManagementController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [FaqManagementController::class, 'destroy'])->name('delete');
    });


    Route::prefix('admin/settings')->name('admin.settings.')->group(function () {
        Route::get('/profile', [ProfileSettingController::class, 'index'])->name('profile');
        Route::post('/profile/store', [ProfileSettingController::class, 'store'])->name('profile.store');
        // Route::post('/profile/update/{id}', [ProfileSettingController::class, 'update'])->name('profile.update');
        Route::post('/profile/password/{id}', [ProfileSettingController::class, 'updatePassword'])->name('profile.password');
        Route::delete('/profile/delete/{id}', [ProfileSettingController::class, 'destroy'])->name('profile.delete');
        // Route::get('/profile/change-password/{id}', [ProfileSettingController::class, 'changePasswordForm'])->name('profile.changePassword');
        Route::post('/profile/change-password/{id}', [ProfileSettingController::class, 'changePassword'])->name('profile.changePassword');
        Route::put('/profile/update/{id}', [ProfileSettingController::class, 'update'])->name('profile.update');

    });




    Route::prefix('admin/program')->name('admin.program.')->group(function () {
        Route::get('/', [ProgramController::class, 'index'])->name('index');
        Route::get('/create', [ProgramController::class, 'create'])->name('create');
        Route::post('/store', [ProgramController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProgramController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProgramController::class, 'update'])->name('update');
        Route::get('/show/{id}', [ProgramController::class, 'show'])->name('show');
        Route::post('/delete/{id}', [ProgramController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('admin')->name('admin.')->group(function () {

        // Donation Category Routes
        Route::get('/donation-categories', [DonationCategoryController::class, 'index'])->name('donation-category.index');
        Route::get('/donation-categories/create', [DonationCategoryController::class, 'create'])->name('donation-category.create');
        Route::post('/donation-categories', [DonationCategoryController::class, 'store'])->name('donation-category.store');
        Route::get('/donation-categories/{id}/edit', [DonationCategoryController::class, 'edit'])->name('donation-category.edit');
        Route::put('/donation-categories/{id}', [DonationCategoryController::class, 'update'])->name('donation-category.update');
        Route::delete('/donation-categories/{id}', [DonationCategoryController::class, 'destroy'])->name('donation-category.destroy');

        // Donation Case Routes
        Route::get('/donation-cases', [DonationCaseController::class, 'index'])->name('donation-cases.index');
        Route::get('/donation-cases/create', [DonationCaseController::class, 'create'])->name('donation-cases.create');
        Route::post('/donation-cases', [DonationCaseController::class, 'store'])->name('donation-cases.store');
        Route::get('/donation-cases/{id}/edit', [DonationCaseController::class, 'edit'])->name('donation-cases.edit');
        Route::put('/donation-cases/{id}', [DonationCaseController::class, 'update'])->name('donation-cases.update');
        Route::delete('/donation-cases/{id}', [DonationCaseController::class, 'destroy'])->name('donation-cases.destroy');


    });

    Route::prefix('feedback')->name('admin.feedback.')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('index');
        Route::post('/store', [FeedbackController::class, 'store'])->name('store');
        Route::put('/update/{id}', [FeedbackController::class, 'update'])->name('update');
        Route::delete('/{id}', [FeedbackController::class, 'destroy'])->name('delete');
    });



    Route::prefix('admin')->name('admin.')->group(function () {

        // Contacts List
        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

        // Add Contact
        Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

        // Update Contact
        Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');

        // Delete Contact
        Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/brochures', [BrochureController::class, 'index'])->name('brochures.index');
        Route::post('/brochures/store', [BrochureController::class, 'store'])->name('brochures.store');
        Route::get('/brochures/edit/{id}', [BrochureController::class, 'edit'])->name('brochures.edit');
        Route::post('/brochures/update/{id}', [BrochureController::class, 'update'])->name('brochures.update');
        Route::delete('/brochures/delete/{id}', [BrochureController::class, 'destroy'])->name('brochures.destroy');
    });

    Route::prefix('admin/form-requests')->group(function () {
        Route::get('/', [FormRequestController::class, 'index'])->name('admin.form_requests.index');
        Route::get('/create', [FormRequestController::class, 'create'])->name('admin.form_requests.create');
        Route::post('/', [FormRequestController::class, 'store'])->name('admin.form_requests.store');
        Route::get('/{id}', [FormRequestController::class, 'show'])->name('admin.form_requests.show');
        Route::get('/{id}/edit', [FormRequestController::class, 'edit'])->name('admin.form_requests.edit');
        Route::put('/{id}', [FormRequestController::class, 'update'])->name('admin.form_requests.update');
        Route::delete('/{id}', [FormRequestController::class, 'destroy'])->name('admin.form_requests.destroy');
    });

    Route::prefix('admin/newsletters')->group(function () {
        Route::get('/', [NewsletterController::class, 'index'])->name('admin.newsletters.index');
        Route::post('/', [NewsletterController::class, 'store'])->name('admin.newsletters.store');
        Route::post('/{id}', [NewsletterController::class, 'update'])->name('admin.newsletters.update');
        Route::delete('/{id}', [NewsletterController::class, 'destroy'])->name('admin.newsletters.destroy');
    });



    // Complaints & Suggestions routes
    Route::prefix('admin/complaints')->name('admin.complaints.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\complaints\ComplaintSuggestionController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\Admin\complaints\ComplaintSuggestionController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\complaints\ComplaintSuggestionController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [\App\Http\Controllers\Admin\complaints\ComplaintSuggestionController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [\App\Http\Controllers\Admin\complaints\ComplaintSuggestionController::class, 'destroy'])->name('destroy');
    });

    // Become Volunteers routes
    Route::prefix('admin/become_volunteers')->name('admin.become_volunteers.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\volunteers\BecomeVolunteerController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\Admin\volunteers\BecomeVolunteerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\volunteers\BecomeVolunteerController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [\App\Http\Controllers\Admin\volunteers\BecomeVolunteerController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [\App\Http\Controllers\Admin\volunteers\BecomeVolunteerController::class, 'destroy'])->name('destroy');
    });

    // News routes
    Route::prefix('admin/news')->name('admin.news.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\news\NewsController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\Admin\news\NewsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\news\NewsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [\App\Http\Controllers\Admin\news\NewsController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [\App\Http\Controllers\Admin\news\NewsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/jobs')->name('admin.jobs.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\job\JobOpeningController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\Admin\job\JobOpeningController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\job\JobOpeningController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [\App\Http\Controllers\Admin\job\JobOpeningController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [\App\Http\Controllers\Admin\job\JobOpeningController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('admin/career_inquiries')->name('admin.career_inquiries.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\career\CareerInquiryController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\career\CareerInquiryController::class, 'show'])->name('show');
        Route::delete('/destroy/{id}', [\App\Http\Controllers\Admin\career\CareerInquiryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/marquees')->name('admin.marquees.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\marquee\MarqueeController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\Admin\marquee\MarqueeController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\marquee\MarqueeController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [\App\Http\Controllers\Admin\marquee\MarqueeController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [\App\Http\Controllers\Admin\marquee\MarqueeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/popup')->name('admin.popup.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\popup\PopupController::class, 'index'])->name('index');
        Route::put('/update/{id}', [\App\Http\Controllers\Admin\popup\PopupController::class, 'update'])->name('update');
        Route::delete('/image/{image}', [\App\Http\Controllers\Admin\popup\PopupController::class, 'deleteImage'])->name('image.delete');
    });

    // Delete a popup image


    Route::prefix('admin/donation')->name('admin.donation.')->group(function () {
        Route::get('/', [DonationController::class, 'index'])->name('index'); // List
        Route::get('/create', [DonationController::class, 'create'])->name('create'); // Show create form
        Route::post('/', [DonationController::class, 'store'])->name('store'); // Store new record
        Route::get('/{id}/edit', [DonationController::class, 'edit'])->name('edit'); // Show edit form
        Route::put('/{id}', [DonationController::class, 'update'])->name('update'); // Update record
        Route::delete('/{id}', [DonationController::class, 'destroy'])->name('destroy'); // Delete record
    });


    Route::prefix('admin/donations/sauses')->name('admin.donations.sauses.')->group(function () {
        Route::get('/', [DonationSauseController::class, 'index'])->name('index');
        Route::post('/', [DonationSauseController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DonationSauseController::class, 'edit'])->name('edit');  // optional if you want separate edit page
        Route::put('/{id}', [DonationSauseController::class, 'update'])->name('update');
        Route::delete('/{id}', [DonationSauseController::class, 'destroy'])->name('destroy');
    });


});

