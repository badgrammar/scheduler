<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Log;
use Carbon\Carbon;

class TasksController extends Controller
{
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
        $data = $request->validate([
            'jam' => 'required'
        ]);

        $sanitized = str_replace('.', ':', $data['jam']);

        $jam = Carbon::parse($sanitized)->isoFormat('HH:mm:ss');
        $tanggal = Carbon::parse($request->tanggal)->format('Y-m-d');

        Task::find($request->taskId)->update([
            'team_id' => $request->teamId,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'status' => 'assigned'
        ]);

        Log::create([
            'task_id' => $request->taskId,
            'user_id' => Auth::id(),
            'comment' => 'Dijadwalkan pada '.Carbon::parse($request->date)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY'). ' jam '.$jam
        ]);

        return redirect()->route('schedule.view', ['selectedDate' => $tanggal]);
    }

    public function reschedule(Request $request)
    {
        $validation = $request->validate([
            'tanggal' => 'required',
            'keterangan' => 'required'
        ]);

        Task::findOrfail($request->id)->update([
            'status' => 'rescheduled',
            'tanggal' => null,
            'team_id' => null
        ]);

        Log::create([
            'task_id' => $request->id,
            'user_id' => Auth::id(),
            'comment' => 'Rescheduled to '.Carbon::parse($validation['tanggal'])->locale('id_ID')->isoFormat('dddd, D MMMM YYYY').' '.$validation['keterangan']
        ]);

        return redirect()->back();
    }
}
