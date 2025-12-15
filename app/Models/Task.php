<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'user_id',
        'team_id',
        'tujuan',
        'pekerjaan',
        'keterangan',
        'tanggal',
        'jam',
        'prioritas',
        'status'
    ];

    protected static function booted()
    {
        static::created(function ($task){
            Log::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'comment' => 'Task telah dibuat oleh ' . Auth::user()->name
            ]);
        });

        static::updated(function ($task){
            $watch = ['tanggal', 'jam'];

            $changed = $task->getChanges();

            if(empty(array_intersect(array_keys($changed), $watch))) {
                return;
            }

            foreach($changed as $column => $changes){
                switch($column){
                    case 'tanggal':
                        $date = Carbon::parse($changes)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY');

                        Log::create([
                            'task_id' => $task->id,
                            'user_id' => Auth::id(),
                            'comment' => 'Task '.$task->tujuan.' plan updated to '.$date
                        ]);

                        $task->updateQuietly(['status' => 'unassigned']);

                        break;
                    case 'jam':
                        Log::create([
                            'task_id' => $task->id,
                            'user_id' => Auth::id(),
                            'comment' => 'Task '.$task->tujuan.' estimasi jam updated to '.$changes
                        ]);

                        $task->updateQuietly(['status' => 'assigned']);
                        break;
                }
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function log()
    {
        return $this->hasMany(Log::class);
    }
}
