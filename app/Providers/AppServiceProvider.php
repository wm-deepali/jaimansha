<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route; // ✅ Route import
use App\Models\admin\blogsfaq\FAQ;
use App\Models\admin\gallery\Media;
use App\Models\admin\gallery\Category;
use App\Models\admin\contentmanagment\Certification;
use App\Models\admin\donations\DonationCase;
use App\Models\Frontend\VisionAndMission;
use App\Models\admin\donations\DonationCategory;
use App\Models\admin\scholarship\ScholarshipForm;
use App\Models\admin\Program\ProgramModel;
use App\Models\admin\Brochure;
use App\Models\Frontend\Program;
use App\Models\admin\feedback\FeedbackModel;
use App\Models\admin\publications\Article as Publication;
use Illuminate\Pagination\Paginator;
use App\Models\admin\donationsetting\Donation; 
use App\Models\Frontend\{
    Header,
    Banner,
    Charity,
    Introduction,
    Event,
    Team,
    Blog,
    Footer
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot(): void
{
    // ✅ Share common frontend data with all views
    
    
    Paginator::useBootstrap();
    
    
    View::share('header', Header::first());
    
    View::share('publications', Publication::with('author')
        ->whereHas('author', function ($query) {
            $query->where('author_type', 'publication');
        })
        ->latest()
        ->paginate(3)
    );
    
    
    View::share('footer', Footer::with('header')->first());
    View::share('banner', Banner::first());
    View::share('latestIntroduction', Introduction::with('visionAndMission')->latest('updated_at')->first());
    View::share('donates', Charity::all());
    View::share('faq', FAQ::all());
    View::share('vision', VisionAndMission::first());
    View::share('form', ScholarshipForm::first());
    View::share('certifications', Certification::all());
    View::share('event', Event::all());
    View::share('members', Team::where('team_type', 'volunteers')->get());
    View::share('advisors', Team::where('team_type', 'advisor')->get());
    View::share('team', Team::where('team_type', 'our_team')->get());
    View::share('cases', DonationCase::with('category')->get());
    View::share('categories', DonationCategory::all());
    View::share('programs', Program::all());

    // ✅ Gallery video categories
    View::share('videoCategories', Category::with(['media' => function($q) {
        $q->where('media_type', 'video');
    }])->whereHas('media', function($q) {
        $q->where('media_type', 'video');
    })->get());

    // ✅ Gallery media with categories
    View::share('media', Media::with('category')->latest()->get());
    
    View::share('testimonials', FeedbackModel::latest()->get()); 
    View::share('brochures', Brochure::where('status', 1)->latest()->first());

    View::share('blogs', Blog::with('category')->where('status', 'Active')->latest()->paginate(3));
    View::share('programsMenu', ProgramModel::where('status', 1)->select('title', 'slug')->get());
    
            View::share('donationSetting', Donation::first());

}

}
