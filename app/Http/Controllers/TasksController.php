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

        switch(Auth::user()->role){
            case 'backroom':
                $path = 'backroom.dashboard';
                break;
            case 'helpdesk':
                $path = 'helpdesk.dashboard';
                break;
            default:
                $path = 'backroom.dashboard';
                break;
        }

        return redirect()->route($path);
    }
}
