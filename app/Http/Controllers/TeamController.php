<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;

class TeamController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'teknisi' => 'required',
            'team_id' => 'required'
        ]);

        TeamMember::create([
            'team_id' => $data['team_id'],
            'teknisi_id' => $data['teknisi']
        ]);

        return redirect()->back();
    }
}
