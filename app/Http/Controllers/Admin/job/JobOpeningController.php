<?php

namespace App\Http\Controllers\Admin\job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobOpeningController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('admin.job_opening.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.job_opening.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'job_location' => 'required|string|max:255',
            'num_candidates' => 'required|integer|min:1',
        ]);

        Job::create($request->only([
            'job_title', 'qualification', 'job_location', 'num_candidates'
        ]));

        return redirect()->route('admin.jobs.index')->with('success', 'Job added successfully.');
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('admin.job_opening.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'job_location' => 'required|string|max:255',
            'num_candidates' => 'required|integer|min:1',
        ]);

        $job = Job::findOrFail($id);
        $job->update($request->only([
            'job_title', 'qualification', 'job_location', 'num_candidates'
        ]));

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully.');
    }
}
