<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\ManagementCommittee;
use App\Models\admin\contentmanagment\GovernmentCategory;

class ManagementCommitteeController extends Controller
{
    public function index()
    {
        // Latest members first
        $member = ManagementCommittee::orderBy('id', 'desc')->get();

        // Categories agar future use ke liye
        $categories = GovernmentCategory::all();

        return view('frontend.managementcommittee.index', compact('member', 'categories'));
    }
}
