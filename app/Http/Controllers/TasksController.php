<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Log;

class TasksController extends Controller
{
    public function store(Request $request)
    {
        $task = $request->validate([
            'tujuan' => ['required'],
            'pekerjaan' => ['required'],
            'keterangan' => ['required'],
            'prioritas' => ['required']
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
}
