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
            'task_id' => 'required',
            'jam' => 'required'
        ]);

        $sanitized = str_replace('.', ':', $data['jam']);

        $jam = Carbon::parse($sanitized)->isoFormat('HH:mm:ss');

        Task::find($data['task_id'])->update([
            'task_id' => $data['task_id'],
            'team_id' => $request->team_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'status' => 'assigned'
        ]);

        Log::create([
            'task_id' => $data['task_id'],
            'user_id' => Auth::id(),
            'comment' => 'Dijadwalkan pada '.Carbon::parse($request['date'])->locale('id_ID')->isoFormat('dddd, D MMMM YYYY'). ' jam '.$jam
        ]);

        return redirect()->back();
    }

    public function reschedule(Request $request)
    {
        $validation = $request->validate([
            'tanggal' => 'required',
            'keterangan' => 'required'
        ]);

        Task::find($request->id)
            ->update([
                'tanggal' => $validation['tanggal']
            ]);

        Log::create([
            'task_id' => $request->id,
            'user_id' => Auth::id(),
            'comment' => 'Rescheduled to '.Carbon::parse($validation['tanggal'])->locale('id_ID')->isoFormat('dddd, D MMMM YYYY').' dikarenakan '.$validation['keterangan']
        ]);

        return redirect()->back();
    }
}
