<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Program;

class ProgramController extends Controller
{
     public function index()
    {
        // Status active wale programs latest ke hisaab se laa rahe hain
        $programs = Program::all();

        return view('frontend.program.index', compact('programs'));
    }

    public function show($slug)
{
    $program = Program::where('slug', $slug)->where('status', 1)->firstOrFail();
    return view('frontend.programcontent.index', compact('program'));
}


}
