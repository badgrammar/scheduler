<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TeamMember;
use App\Models\Team;
use App\Models\Teknisi;
use App\Models\Log;

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

    public function test()
    {
        return 'test success';
    }

    public function deleteTeam(Request $request)
    {
        $team = Team::with('tasks')->findOrFail($request->team_id);

        foreach($team->tasks as $task){
            $task->update([
                'status' => 'pending',
                'tanggal' => null,
                'jam' => null,
                'team_id' => null
            ]);

            Log::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'comment' => 'Team dihapus, menunggu penjadwalan ulang'
            ]);
        }

        $team->delete();

        return redirect()->back();
    }

    public function delete(Team $team, Teknisi $teknisi)
    {
        $team->members()->detach($teknisi->id);

        return redirect()->route('schedule.view');
    }
}
