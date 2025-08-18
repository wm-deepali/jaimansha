<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\membership\MembershipPage as content;

class MembershipDetailController extends Controller
{
        public function index()
    {
        $content=Content::first();
        return view('frontend.membership_detail.index',compact('content'));
    }
}
