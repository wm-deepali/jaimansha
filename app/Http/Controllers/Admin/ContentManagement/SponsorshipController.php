<?php

namespace App\Http\Controllers\Admin\ContentManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\Sponsorship;

class SponsorshipController extends Controller
{
    public function index()
    {
        $data = Sponsorship::all();
        return view('admin.sponsorship.index', compact('data'));
    }

    public function create()
    {
        return view('admin.sponsorship.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title1' => 'required|string|max:255',
            'title2' => 'nullable|string|max:255',
            'title3' => 'nullable|string|max:255',
            'title4' => 'nullable|string|max:255',
            'short_description1' => 'nullable|string',
            'short_description2' => 'nullable|string',
            'short_description3' => 'nullable|string',
            'sponsorship_type' => 'required|string|max:100',
            'status' => 'required|in:0,1',
        ]);

        Sponsorship::create($request->only([
            'title1', 'title2', 'title3', 'title4',
            'short_description1', 'short_description2', 'short_description3',
            'sponsorship_type', 'status'
        ]));

        return redirect()->route('admin.sponsorship.index')
            ->with('success', 'Sponsorship Added Successfully!');
    }

    public function edit($id)
    {
        $sponsorship = Sponsorship::findOrFail($id);
        return view('admin.sponsorship.edit', compact('sponsorship'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title1' => 'required|string|max:255',
            'title2' => 'nullable|string|max:255',
            'title3' => 'nullable|string|max:255',
            'title4' => 'nullable|string|max:255',
            'short_description1' => 'nullable|string',
            'short_description2' => 'nullable|string',
            'short_description3' => 'nullable|string',
            'sponsorship_type' => 'required|string|max:100',
            'status' => 'required|in:0,1',
        ]);

        $sponsorship = Sponsorship::findOrFail($id);
        $sponsorship->update($request->only([
            'title1', 'title2', 'title3', 'title4',
            'short_description1', 'short_description2', 'short_description3',
            'sponsorship_type', 'status'
        ]));

        return redirect()->route('admin.sponsorship.index')
            ->with('success', 'Sponsorship Updated Successfully!');
    }

    public function destroy($id)
    {
        $sponsorship = Sponsorship::findOrFail($id);
        $sponsorship->delete();

        return redirect()->route('admin.sponsorship.index')
            ->with('success', 'Sponsorship Deleted Successfully!');
    }
}
