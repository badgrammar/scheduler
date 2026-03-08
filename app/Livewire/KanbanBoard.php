<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\Task;
use App\Models\Log;
use Carbon\Carbon;

class KanbanBoard extends Component
{
    public $selectedDate;

    protected $listeners = [
        'date-selected' => 'updateKanban'
    ];

    public function mount()
    {
        $this->selectedDate = Carbon::now();
    }

    public function updateKanban(string $date)
    {
        $this->selectedDate = Carbon::parse($date);
    }

    public function createTeam()
    {
        $date = Carbon::parse($this->selectedDate);

        Team::create([
            'created_at' => $date
        ]);

    }

   public function assign($taskId, $teamId, $tanggal, $jam)
   {
        $sanitized = str_replace('.', ':', $jam);

        $jam = Carbon::parse($sanitized)->isoFormat('HH:mm:ss');
        $tanggal = Carbon::parse($tanggal)->format('Y-m-d');

        Task::find($taskId)->update([
            'team_id' => $teamId,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'status' => 'assigned'
        ]);

        Log::create([
            'task_id' => $taskId,
            'user_id' => Auth::id(),
            'comment' => '[Assigned] '.Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY'). ' jam '.$jam
        ]);
   }

   public function reschedule($taskId, $tanggal,?string $keterangan)
   {
        Task::findOrfail($taskId)->update([
            'status' => 'rescheduled',
            'tanggal' => null,
            'team_id' => null
        ]);

        Log::create([
            'task_id' => $taskId,
            'user_id' => Auth::id(),
            'comment' => '[Rescheduled] '.Carbon::parse($tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY').' '.$keterangan
        ]);
   }

   public function render()
   {
        $pending = Task::whereNull('team_id')->orderBy('updated_at', 'desc')->get();

        $teams = Team::with(['tasks' => function ($query){
            $query->orderBy('jam');
        }, 'members' ])
            ->whereDate('created_at', $this->selectedDate)->get();


        return view('livewire.kanban-board', [
            'pending' => $pending,
            'teams' => $teams
        ]);
   }
}
