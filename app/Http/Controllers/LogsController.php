<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

class LogsController extends Controller
{
    public function store(Request $request)
    {
        $log = $request->validate([
            'comment' => 'required'
        ]);

        $log['task_id'] = $request->taskId;
        $log['user_id'] = Auth::id();

        Log::create($log);

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
