<?php

namespace App\Http\Controllers\Admin\Publications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\publications\Author;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PublicationAuthorController extends Controller
{
    public function index()
    {
        $authors = Author::latest()->get();
        return view('admin.publications.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.publications.authors.create');
    }

    public function store(Request $request)
    {
        // Debug: Log all incoming data
        Log::info('Store Request Data:', $request->all());
        Log::info('Store Files:', $request->allFiles());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'publication_image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480', // Changed from 'image'
            'pdf' => 'nullable|mimes:pdf|max:20480',
            'mobile_number' => 'nullable|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'pin_code' => 'nullable|string|max:10',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
            'author_type' => 'nullable|string|max:50',
            'registered_by' => 'nullable|string|max:50',
            'status' => 'nullable|in:0,1',
        ]);

        $author = new Author();
        $author->name = $validated['name'];
        $author->father_name = $validated['father_name'];
        $author->email = $validated['email'];
        $author->mobile_number = $validated['mobile_number'];
        $author->whatsapp_number = $validated['whatsapp_number'];
        $author->address = $validated['address'];
        $author->country = $validated['country'];
        $author->state = $validated['state'];
        $author->city = $validated['city'];
        $author->pin_code = $validated['pin_code'];
        $author->facebook = $validated['facebook'];
        $author->twitter = $validated['twitter'];
        $author->linkedin = $validated['linkedin'];
        $author->youtube = $validated['youtube'];
        $author->author_type = $validated['author_type'];
        $author->registered_by = $request->registered_by ?? 'admin';
        $author->status = $request->status ?? 1;

        // Image Upload
        if ($request->hasFile('publication_image')) {
            Log::info('Processing image upload...');
            try {
                $file = $request->file('publication_image');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $path = public_path('uploads/authors');
                
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                    Log::info('Created directory: ' . $path);
                }
                
                $file->move($path, $filename);
                $author->image = $filename;
                Log::info('Image saved: ' . $filename);
            } catch (\Exception $e) {
                Log::error('Image upload error: ' . $e->getMessage());
            }
        }

        // PDF Upload
        if ($request->hasFile('pdf')) {
            Log::info('Processing PDF upload...');
            try {
                $file = $request->file('pdf');
                $filename = time() . '_pdf_' . str_replace(' ', '_', $file->getClientOriginalName());
                $path = public_path('uploads/publication/pdfs');
                
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                    Log::info('Created PDF directory: ' . $path);
                }
                
                $file->move($path, $filename);
                $author->pdf = 'uploads/publication/pdfs/' . $filename;
                Log::info('PDF saved: ' . $filename);
            } catch (\Exception $e) {
                Log::error('PDF upload error: ' . $e->getMessage());
            }
        }

        $author->save();
        Log::info('Author saved with ID: ' . $author->id);

        return redirect()->route('admin.publications.authors.index')->with('success', 'Author added successfully.');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin.publications.authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        Log::info('Update Request for ID: ' . $id);
        Log::info('Update Request Data:', $request->all());
        Log::info('Update Files:', $request->allFiles());

        $author = Author::findOrFail($id);
        Log::info('Found author: ' . $author->name);
        Log::info('Current PDF: ' . $author->pdf);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'publication_image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480', // Changed from 'image'
            'pdf' => 'nullable|mimes:pdf|max:20480',
            'mobile_number' => 'nullable|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'pin_code' => 'nullable|string|max:10',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
            'author_type' => 'nullable|string|max:50',
            'registered_by' => 'nullable|string|max:50',
            'status' => 'nullable|in:0,1',
        ]);

        // Update basic fields first
        $author->name = $validated['name'];
        $author->father_name = $validated['father_name'];
        $author->email = $validated['email'];
        $author->mobile_number = $validated['mobile_number'];
        $author->whatsapp_number = $validated['whatsapp_number'];
        $author->address = $validated['address'];
        $author->country = $validated['country'];
        $author->state = $validated['state'];
        $author->city = $validated['city'];
        $author->pin_code = $validated['pin_code'];
        $author->facebook = $validated['facebook'];
        $author->twitter = $validated['twitter'];
        $author->linkedin = $validated['linkedin'];
        $author->youtube = $validated['youtube'];
        $author->author_type = $validated['author_type'];
        $author->status = $validated['status'];

        // Handle Image Update
        if ($request->hasFile('publication_image')) {
            Log::info('Processing image update...');
            try {
                // Delete old image
                if ($author->image && File::exists(public_path('uploads/authors/'.$author->image))) {
                    File::delete(public_path('uploads/authors/'.$author->image));
                    Log::info('Deleted old image: ' . $author->image);
                }
                
                $file = $request->file('publication_image');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $path = public_path('uploads/authors');
                
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                $file->move($path, $filename);
                $author->image = $filename;
                Log::info('New image saved: ' . $filename);
            } catch (\Exception $e) {
                Log::error('Image update error: ' . $e->getMessage());
            }
        }

        // Handle PDF Update - DETAILED DEBUG
        if ($request->hasFile('pdf')) {
            Log::info('PDF file detected in request');
            Log::info('PDF file name: ' . $request->file('pdf')->getClientOriginalName());
            Log::info('PDF file size: ' . $request->file('pdf')->getSize());
            Log::info('PDF file mime: ' . $request->file('pdf')->getMimeType());
            
            try {
                // Delete old PDF
                if ($author->pdf) {
                    $oldPdfPath = public_path($author->pdf);
                    Log::info('Checking old PDF at: ' . $oldPdfPath);
                    
                    if (File::exists($oldPdfPath)) {
                        File::delete($oldPdfPath);
                        Log::info('Deleted old PDF: ' . $author->pdf);
                    } else {
                        Log::info('Old PDF file does not exist');
                    }
                }
                
                $file = $request->file('pdf');
                $filename = time() . '_pdf_' . str_replace(' ', '_', $file->getClientOriginalName());
                $path = public_path('uploads/publication/pdfs');
                
                Log::info('PDF upload path: ' . $path);
                Log::info('PDF filename: ' . $filename);
                
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                    Log::info('Created PDF directory');
                }
                
                // Move file
                $moved = $file->move($path, $filename);
                Log::info('File move result: ' . ($moved ? 'success' : 'failed'));
                
                $author->pdf = 'uploads/publication/pdfs/' . $filename;
                Log::info('PDF path set in database: ' . $author->pdf);
                
            } catch (\Exception $e) {
                Log::error('PDF update error: ' . $e->getMessage());
                Log::error('PDF update stack trace: ' . $e->getTraceAsString());
            }
        } else {
            Log::info('No PDF file in request');
        }

        // Save the author
        try {
            $saved = $author->save();
            Log::info('Author save result: ' . ($saved ? 'success' : 'failed'));
            Log::info('Author PDF after save: ' . $author->pdf);
        } catch (\Exception $e) {
            Log::error('Author save error: ' . $e->getMessage());
        }
        
        return redirect()->route('admin.publications.authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);

        // Delete image file if exists
        if ($author->image && File::exists(public_path('uploads/authors/'.$author->image))) {
            File::delete(public_path('uploads/authors/'.$author->image));
        }
        
        // Delete PDF file if exists
        if ($author->pdf && File::exists(public_path($author->pdf))) {
            File::delete(public_path($author->pdf));
        }

        $author->delete();

        return redirect()->route('admin.publications.authors.index')->with('success', 'Author deleted successfully.');
    }
}

// namespace App\Http\Controllers\Admin\Publications;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\admin\publications\Author;
// use Illuminate\Support\Facades\File;

// class PublicationAuthorController extends Controller
// {
//     public function index()
//     {
//         $authors = Author::latest()->get();
//         return view('admin.publications.authors.index', compact('authors'));
//     }

//     public function create()
//     {
//         return view('admin.publications.authors.create');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'father_name' => 'nullable|string|max:255',
//             'email' => 'nullable|email|max:255',
//             'image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480',
//             'pdf' => 'nullable|mimes:pdf|max:20480', // PDF validation
//             'mobile_number' => 'nullable|string|max:20',
//             'whatsapp_number' => 'nullable|string|max:20',
//             'address' => 'nullable|string',
//             'country' => 'nullable|string',
//             'state' => 'nullable|string',
//             'city' => 'nullable|string',
//             'pin_code' => 'nullable|string|max:10',
//             'facebook' => 'nullable|url',
//             'twitter' => 'nullable|url',
//             'linkedin' => 'nullable|url',
//             'youtube' => 'nullable|url',
//             'author_type' => 'nullable|string|max:50',
//             'registered_by' => 'nullable|string|max:50',
//             'status' => 'nullable|in:0,1',
//         ]);

//         $author = new Author($validated);
//         $author->registered_by = $request->registered_by ?? 'admin';
//         $author->status = $request->status ?? 1;

//         // Image Upload
//         if ($request->hasFile('publication_image')) {
//             $file = $request->file('publication_image');
//             $filename = time() . '_' . $file->getClientOriginalName();
//             $path = public_path('uploads/authors');
//             if (!file_exists($path)) mkdir($path, 0777, true);
//             $file->move($path, $filename);
//             $author->image = $filename;
//         }

//         // PDF Upload
//         if ($request->hasFile('pdf')) {
//             $file = $request->file('pdf');
//             $filename = time() . '_' . $file->getClientOriginalName();
//             $path = public_path('uploads/publication/pdfs');
//             if (!file_exists($path)) mkdir($path, 0777, true);
//             $file->move($path, $filename);
//             $author->pdf = 'uploads/publication/pdfs/' . $filename;
//         }

//         $author->save();

//         return redirect()->route('admin.publications.authors.index')->with('success', 'Author added successfully.');
//     }

//     public function edit($id)
//     {
//         $author = Author::findOrFail($id);
//         return view('admin.publications.authors.edit', compact('author'));
//     }

//   public function update(Request $request, $id)
// {
//     $author = Author::findOrFail($id);

//     $validated = $request->validate([
//         'name' => 'required|string|max:255',
//         'father_name' => 'nullable|string|max:255',
//         'email' => 'nullable|email|max:255',
//         'image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480',
//         'pdf' => 'nullable|mimes:pdf|max:20480',
//         'mobile_number' => 'nullable|string|max:20',
//         'whatsapp_number' => 'nullable|string|max:20',
//         'address' => 'nullable|string',
//         'country' => 'nullable|string',
//         'state' => 'nullable|string',
//         'city' => 'nullable|string',
//         'pin_code' => 'nullable|string|max:10',
//         'facebook' => 'nullable|url',
//         'twitter' => 'nullable|url',
//         'linkedin' => 'nullable|url',
//         'youtube' => 'nullable|url',
//         'author_type' => 'nullable|string|max:50',
//         'registered_by' => 'nullable|string|max:50',
//         'status' => 'nullable|in:0,1',
//     ]);

//     // Image replacement
//     if ($request->hasFile('publication_image')) {
//         if ($author->image && File::exists(public_path('uploads/authors/'.$author->image))) {
//             File::delete(public_path('uploads/authors/'.$author->image));
//         }
//         $file = $request->file('publication_image');
//         $filename = time() . '_' . $file->getClientOriginalName();
//         $path = public_path('uploads/authors');
//         if (!file_exists($path)) mkdir($path, 0777, true);
//         $file->move($path, $filename);
//         $author->image = $filename;
//     }

//     // PDF replacement
//   if ($request->hasFile('pdf')) {
//     $file = $request->file('pdf');
//     $filename = time() . '_' . $file->getClientOriginalName();
//     $file->move(public_path('uploads/publication/pdfs'), $filename);
//     $author->pdf = 'uploads/publication/pdfs/' . $filename;
// }
         
//     $author->fill($validated);
//     $author->save(); 
    
//     return redirect()->route('admin.publications.authors.index')->with('success', 'Author updated successfully.');
// }


//     public function destroy($id)
//     {
//         $author = Author::findOrFail($id);

//         if ($author->image && File::exists(public_path($author->image))) {
//             File::delete(public_path($author->image));
//         }
//         if ($author->pdf && File::exists(public_path($author->pdf))) {
//             File::delete(public_path($author->pdf));
//         }

//         $author->delete();

//         return redirect()->route('admin.publications.authors.index')->with('success', 'Author deleted successfully.');
//     }
// }


// namespace App\Http\Controllers\Admin\Publications;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\admin\publications\Author;
// use Illuminate\Support\Facades\File;

// class PublicationAuthorController extends Controller
// {
//     public function index()
//     {
//         $authors = Author::latest()->get();
//         return view('admin.publications.authors.index', compact('authors'));
//     }

//     public function create()
//     {
//         return view('admin.publications.authors.create');
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'father_name' => 'nullable|string|max:255',
//             'email' => 'nullable|email|max:255',
//             'image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480',
//             'mobile_number' => 'nullable|string|max:20',
//             'whatsapp_number' => 'nullable|string|max:20',
//             'address' => 'nullable|string',
//             'country' => 'nullable|string',
//             'state' => 'nullable|string',
//             'city' => 'nullable|string',
//             'pin_code' => 'nullable|string|max:10',
//             'facebook' => 'nullable|url',
//             'twitter' => 'nullable|url',
//             'linkedin' => 'nullable|url',
//             'youtube' => 'nullable|url',
//             'author_type' => 'nullable|string|max:50',
//             'registered_by' => 'nullable|string|max:50',
//             'status' => 'nullable|in:0,1',
//         ]);

//         $author = new Author($validated);
//         $author->registered_by = $request->registered_by ?? 'admin';
//         $author->status = $request->status ?? 1;

//         // Image Upload
//       if ($request->hasFile('publication_image')) {
//     $file = $request->file('publication_image');
//     $filename = time() . '_' . $file->getClientOriginalName();
//     $path = public_path('uploads/publication');

//     // Folder bana lo agar exist nahi karta
//     if (!file_exists($path)) {
//         mkdir($path, 0777, true);
//     }

//     // Move the file
//     $file->move($path, $filename);

//     // Save in DB
//     $author->publication_image = 'uploads/publication/' . $filename;
// }


//         $author->save();

//         return redirect()->route('admin.publications.authors.index')->with('success', 'Author added successfully.');
//     }

//     public function edit($id)
//     {
//         $author = Author::findOrFail($id);
//         return view('admin.publications.authors.edit', compact('author'));
//     }

//     public function update(Request $request, $id)
//     {
//         $author = Author::findOrFail($id);

//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'father_name' => 'nullable|string|max:255',
//             'email' => 'nullable|email|max:255',
//             'image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480',
//             'mobile_number' => 'nullable|string|max:20',
//             'whatsapp_number' => 'nullable|string|max:20',
//             'address' => 'nullable|string',
//             'country' => 'nullable|string',
//             'state' => 'nullable|string',
//             'city' => 'nullable|string',
//             'pin_code' => 'nullable|string|max:10',
//             'facebook' => 'nullable|url',
//             'twitter' => 'nullable|url',
//             'linkedin' => 'nullable|url',
//             'youtube' => 'nullable|url',
//             'author_type' => 'nullable|string|max:50',
//             'registered_by' => 'nullable|string|max:50',
//             'status' => 'nullable|in:0,1',
//         ]);

//         // Image replacement
//      if ($request->hasFile('publication_image')) {
//     $file = $request->file('publication_image');
//     $filename = time() . '_' . $file->getClientOriginalName();
//     $path = public_path('uploads/publication');

//     // Folder bana lo agar exist nahi karta
//     if (!file_exists($path)) {
//         mkdir($path, 0777, true);
//     }

//     // Move the file
//     $file->move($path, $filename);

//     // Save in DB
//     $author->publication_image = 'uploads/publication/' . $filename;
// }


//         $author->update($validated);
//       return redirect()->back()->with('success', 'Author updated successfully.');
    
//         // return redirect()->route('admin.publications.authors.index')->with('success', 'Author updated successfully.');
//     }

//     public function destroy($id)
//     {
//         $author = Author::findOrFail($id);

//         if ($author->image && File::exists(public_path($author->image))) {
//             File::delete(public_path($author->image));
//         }

//         $author->delete();
        
    
//         return redirect()->route('admin.publications.authors.index')->with('success', 'Author deleted successfully.');
//     }
// }
