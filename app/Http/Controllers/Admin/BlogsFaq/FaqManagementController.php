<?php

namespace App\Http\Controllers\Admin\BlogsFaq;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\blogsfaq\FAQ;

class FaqManagementController extends Controller
{
    // Show all FAQs
    public function index()
    {
        $faqs = FAQ::all();
        return view('admin.blogs.faqs.index', compact('faqs'));
    }

    // Store new FAQ
    public function store(Request $request)
    {
        $faq = new FAQ();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->status = $request->status;
        $faq->save();

        return redirect()->back()->with('success', 'FAQ added successfully');
    }

    // Show form to edit
    public function edit($id)
    {
        $faq = FAQ::find($id);
        return view('admin.blogs.faqs.edit', compact('faq'));
    }

    // Update FAQ
    public function update(Request $request, $id)
    {
        $faq = FAQ::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->status = $request->status;
        $faq->save();

        return redirect()->route('admin.blogs.faqs.index')->with('success', 'FAQ updated successfully');
    }

    // Delete FAQ
    public function destroy($id)
    {
        $faq = FAQ::find($id);
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ deleted successfully');
    }
}
