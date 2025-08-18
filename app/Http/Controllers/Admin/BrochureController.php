<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Brochure;
use Illuminate\Support\Facades\File;

class BrochureController extends Controller
{
    /**
     * Show all brochures
     */
    public function index()
    {
        $brochures = Brochure::latest()->get();
        return view('admin.brochures.index', compact('brochures'));
    }

    /**
     * Store new brochure
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);

        $fileName = time() . '.' . $request->file('pdf_file')->getClientOriginalExtension();
        $request->file('pdf_file')->move(public_path('uploads/brochures'), $fileName);

        Brochure::create([
            'title' => $request->title,
            'pdf_file' => 'uploads/brochures/' . $fileName,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->back()->with('success', 'Brochure uploaded successfully!');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $brochure = Brochure::findOrFail($id);
        return view('admin.brochures.edit', compact('brochure'));
    }

    /**
     * Update brochure
     */
    public function update(Request $request, $id)
    {
        $brochure = Brochure::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'pdf_file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'status' => $request->status ?? 1,
        ];

        // Agar naya PDF upload hua hai
        if ($request->hasFile('pdf_file')) {
            // Purana file delete karo
            if (File::exists(public_path($brochure->pdf_file))) {
                File::delete(public_path($brochure->pdf_file));
            }

            $fileName = time() . '.' . $request->file('pdf_file')->getClientOriginalExtension();
            $request->file('pdf_file')->move(public_path('uploads/brochures'), $fileName);
            $data['pdf_file'] = 'uploads/brochures/' . $fileName;
        }

        $brochure->update($data);

        return redirect()->route('admin.brochures.index')->with('success', 'Brochure updated successfully!');
    }

    /**
     * Delete brochure
     */
    public function destroy($id)
    {
        $brochure = Brochure::findOrFail($id);

        // PDF delete karo
        if (File::exists(public_path($brochure->pdf_file))) {
            File::delete(public_path($brochure->pdf_file));
        }

        $brochure->delete();

        return redirect()->back()->with('success', 'Brochure deleted successfully!');
    }
}
