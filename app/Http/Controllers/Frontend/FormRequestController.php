<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\FormRequest; // Model import

class FormRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'text'  => 'required|string',
        ]);

        FormRequest::create([
            'name'  => $request->name,
            'email' => $request->email,
            'text'  => $request->text,
        ]);

        return back()->with('success', 'We will contact you soon!');
    }
}
