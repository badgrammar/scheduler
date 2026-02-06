<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Teknisi;
use App\Models\TeamMember;
use App\Models\Team;

class MemberManage extends Component
{
    public Team $team;

    public $taskId = null;

    public $listeners = [
        'open-team' => 'openTeam'
    ];

    public function openTask($id)
    {
        $this->taskId = $id;
    }

    public function closeTask()
    {
        $this->taskId = null;
    }

    public function add($team, $teknisi)
    {
        TeamMember::create([
            'team_id' => $team,
            'teknisi_id' => $teknisi
        ]);
    }

    public function render()
    {
        $teknisis = Teknisi::all();

        return view('livewire.member-manage', [
            'teknisis' => $teknisis
        ]);
    }
}
