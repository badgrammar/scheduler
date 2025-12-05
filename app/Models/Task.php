<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'user_id',
        'tujuan',
        'pekerjaan',
        'keterangan',
        'prioritas',
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
                        Log::create([
                            'task_id' => $task->id,
                            'user_id' => Auth::id(),
                            'comment' => 'Task '.$task->tujuan.' plan updated to'.$changes
                        ]);
                        break;
                    case 'jam':
                        Log::create([
                            'task_id' => $task->id,
                            'user_id' => Auth::id(),
                            'comment' => 'Task '.$task->tujuan.' estimasi jam updated to'.$changes
                        ]);
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
