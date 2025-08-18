<?php

namespace App\Http\Controllers\admin\news;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\news\NewsModel;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    // List all news with pagination
    public function index()
    {
        $news = NewsModel::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    // Show form to create news
    public function create()
    {
        return view('admin.news.create');
    }

    // Store new news item
    public function store(Request $request)
    {
        $validated = $request->validate([
            'news_title' => 'required|string|max:255',
            'news_type' => 'nullable|in:detail,pdf,link,none',
            'detail_content' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5120', // max 5MB
            'link_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
        ]);

        // Slug auto from news_title
        $validated['slug'] = Str::slug($validated['news_title']);

        // Auto fill meta fields if empty
        $validated['meta_title'] = $validated['meta_title'] ?? $validated['news_title'];
        $validated['meta_keywords'] = $validated['meta_keywords'] ?? $validated['news_title'];
        $validated['meta_desc'] = $validated['meta_desc'] ?? $validated['news_title'];

        // Handle PDF upload if news_type is pdf
        if (isset($validated['news_type']) && $validated['news_type'] === 'pdf' && $request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news_pdfs'), $filename);
            $validated['pdf_file'] = $filename;
            // Clear detail_content and link_url if any
            $validated['detail_content'] = null;
            $validated['link_url'] = null;
        }

        // If news_type is link, clear other fields
        if (isset($validated['news_type']) && $validated['news_type'] === 'link') {
            $validated['pdf_file'] = null;
            $validated['detail_content'] = null;
        }

        // If news_type is detail, clear pdf_file and link_url
        if (isset($validated['news_type']) && $validated['news_type'] === 'detail') {
            $validated['pdf_file'] = null;
            $validated['link_url'] = null;
        }

        // If news_type is none or null, clear all extra fields
        if (!isset($validated['news_type']) || $validated['news_type'] === 'none') {
            $validated['pdf_file'] = null;
            $validated['link_url'] = null;
            $validated['detail_content'] = null;
        }

        NewsModel::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    // Show news detail (for admin)
    public function show($id)
    {
        $news = NewsModel::findOrFail($id);
        return view('admin.news.show', compact('news'));
    }

    // Show form to edit news
    public function edit($id)
    {
        $news = NewsModel::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    // Update news item
    public function update(Request $request, $id)
    {
        $news = NewsModel::findOrFail($id);

        $validated = $request->validate([
            'news_title' => 'required|string|max:255',
            'news_type' => 'nullable|in:detail,pdf,link,none',
            'detail_content' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5120',
            'link_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['news_title']);

        $validated['meta_title'] = $validated['meta_title'] ?? $validated['news_title'];
        $validated['meta_keywords'] = $validated['meta_keywords'] ?? $validated['news_title'];
        $validated['meta_desc'] = $validated['meta_desc'] ?? $validated['news_title'];

        // PDF upload handling
        if (isset($validated['news_type']) && $validated['news_type'] === 'pdf' && $request->hasFile('pdf_file')) {
            // Delete old pdf file if exists
            if ($news->pdf_file && file_exists(public_path('uploads/news_pdfs/' . $news->pdf_file))) {
                unlink(public_path('uploads/news_pdfs/' . $news->pdf_file));
            }
            $file = $request->file('pdf_file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news_pdfs'), $filename);
            $validated['pdf_file'] = $filename;

            // Clear other fields
            $validated['detail_content'] = null;
            $validated['link_url'] = null;
        }

        // Clear fields according to news_type
        if (isset($validated['news_type']) && $validated['news_type'] === 'link') {
            $validated['pdf_file'] = null;
            $validated['detail_content'] = null;
        }
        if (isset($validated['news_type']) && $validated['news_type'] === 'detail') {
            $validated['pdf_file'] = null;
            $validated['link_url'] = null;
        }
        if (!isset($validated['news_type']) || $validated['news_type'] === 'none') {
            $validated['pdf_file'] = null;
            $validated['link_url'] = null;
            $validated['detail_content'] = null;
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    // Delete news item
    public function destroy($id)
    {
        $news = NewsModel::findOrFail($id);

        // Delete PDF file if exists
        if ($news->pdf_file && file_exists(public_path('uploads/news_pdfs/' . $news->pdf_file))) {
            unlink(public_path('uploads/news_pdfs/' . $news->pdf_file));
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}
