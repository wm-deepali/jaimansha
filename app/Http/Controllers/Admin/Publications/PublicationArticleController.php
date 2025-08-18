<?php

namespace App\Http\Controllers\Admin\Publications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\publications\Article as Publication;
use App\Models\admin\publications\Author;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class PublicationArticleController extends Controller
{

    //  public function index()
    // {
    //     // $publications = Publication::with('author')->latest()->get(); // Assuming 'author' is the relationship
    //     $publications=Publication::all();
    //     $authors = Author::where('status', 1)->get(); // Active authors only
    //     return view('admin.publications.publication.index', compact('publications', 'authors'));
    // }
    
public function index()
{
    // Publications with only 'publication' type authors
    $publications = Publication::with('author')
        ->whereHas('author', function ($query) {
            $query->where('author_type', 'publication');
        })
        ->latest()
        ->paginate(3); // Paginate instead of all()

    // Active authors of 'publication' type
    $authors = Author::where('status', 1)
        ->where('author_type', 'publication')
        ->get();

    return view('admin.publications.publication.index', compact('publications', 'authors'));
}


    // Store a new publication
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_id' => 'required',
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'registered_by' => 'required|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:20480'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/authors'), $imageName);
        }

        Publication::create([
            'author_id' => $request->author_id,
            'title' => $request->title,
            'short_description' => $request->short_description,
            'registered_by' => $request->registered_by,
            'status' => $request->status,
            'image' => $imageName,
        ]);

        return back()->with('success', 'Publication added successfully!');
    }

    // Update existing publication
    public function update(Request $request, $id)
    {
        $publication = Publication::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'author_id' => 'required',
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'registered_by' => 'required|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:20480'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($publication->image && File::exists(public_path('uploads/authors/' . $publication->image))) {
                File::delete(public_path('uploads/authors/' . $publication->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/authors'), $imageName);
            $publication->image = $imageName;
        }

        $publication->update([
            'author_id' => $request->author_id,
            'title' => $request->title,
            'short_description' => $request->short_description,
            'registered_by' => $request->registered_by,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Publication updated successfully!');
    }

    // Delete publication
    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);

        if ($publication->image && File::exists(public_path('uploads/authors/' . $publication->image))) {
            File::delete(public_path('uploads/authors/' . $publication->image));
        }

        $publication->delete();

        return back()->with('success', 'Publication deleted successfully!');
    }

    // Get single publication data for edit modal (AJAX)
    public function getPublication($id)
    {
        $publication = Publication::findOrFail($id);
        return response()->json($publication);
    }
}
