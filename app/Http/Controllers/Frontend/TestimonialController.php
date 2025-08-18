<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\feedback\FeedbackModel;

class TestimonialController extends Controller
{

     public function index()
{
    $testimonials = FeedbackModel::latest()->get(); // ya paginate(8)
    return view('frontend.testimonial.index', compact('testimonials'));
}
     
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'mobile' => 'required|digits:10',
        'star_rating' => 'required|integer|min:1|max:5',
        'message' => 'required|string',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $feedback = new FeedbackModel();

    $feedback->name = $request->input('name');
    $feedback->email = $request->input('email');
    $feedback->mobile = $request->input('mobile');
    $feedback->star_rating = $request->input('star_rating');
    $feedback->message = $request->input('message');

    // Handle profile image upload
    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('uploads/feedback'), $imageName);
        $feedback->profile_picture = 'uploads/feedback/' . $imageName;
    }

    $feedback->save();

    return redirect()->back()->with('success', 'Feedback submitted successfully!');
}



}
