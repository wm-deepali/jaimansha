<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\contentmanagment\Team;

class AdvisorController extends Controller
{
       // 📌 Show all team members
public function index()
{
    $volunteers =Team::where('team_type', 'volunteers')->get();
    $advisors = Team::where('team_type', 'advisor')->get();
    $team = Team::where('team_type', 'our_team')->get();

    return view('frontend.advisors.index', compact('volunteers', 'advisors','team'));
}

}
