<?php

namespace App\Http\Controllers\admin\feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\feedback\FeedbackModel as Feedback;

class FeedbackController extends Controller
{
     // Show all feedbacks
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('admin.feedback.index', compact('feedbacks'));
    }

    // Store new feedback
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            $filename = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('uploads/feedbacks'), $filename);
            $data['profile_picture'] = 'uploads/feedbacks/' . $filename;
        }

        Feedback::create($data);

        return redirect()->back()->with('success', 'Feedback added successfully.');
    }
    
    // Update existing feedback
public function update(Request $request, $id)
{
    $feedback = Feedback::findOrFail($id);
    $data = $request->all();

    if ($request->hasFile('profile_picture')) {
        $filename = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->move(public_path('uploads/feedbacks'), $filename);
        $data['profile_picture'] = 'uploads/feedbacks/' . $filename;
    }

    $feedback->update($data);

    return redirect()->route('admin.feedback.index')->with('success', 'Feedback updated successfully.');
}

    // Delete
    public function destroy($id)
    {
        Feedback::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Feedback deleted successfully.');
    }
}
