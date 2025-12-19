<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Log;
use Carbon\Carbon;

class TasksController extends Controller
{
    public function plan(Request $request)
    {
        $date = $request->validate([
            'date' => 'required'
        ]);

        Task::find($request->id)->update([
            'tanggal' => $date['date']
        ]);

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $task = $request->validate([
            'tujuan' => 'required',
            'pekerjaan' => 'required',
            'prioritas' => 'required',
            'keterangan' => 'nullable'
        ]);

        $task['user_id'] = Auth::id();

        Task::create($task);

        return redirect()->back();
    }

    public function delete($id)
    {
        Task::find($id)->delete();

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $task = $request->validate([
            'tujuan' => ['required'],
            'pekerjaan' => ['required'],
            'keterangan' => ['required'],
            'prioritas' => ['required']
        ]);

        Task::find($request->id)->update($task);

        return redirect()->back();
    }

    public function assign(Request $request)
    {
        Task::find($request->task_id)->update([
            'team_id' => $request->team_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam
        ]);

        return redirect()->back();
    }
}
