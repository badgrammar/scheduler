<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        'status',
    ];

    protected static function booted()
    {
        static::created(function ($task) {
            Log::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'comment' => 'Dibuat oleh '.Auth::user()->name,
            ]);
        });

        static::updated(function ($task) {
            $watch = ['tanggal', 'jam'];

            $changed = $task->getChanges();

            if (empty(array_intersect(array_keys($changed), $watch))) {
                return;
            }

            Log::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'comment' => 'Dijadwalkan pada '.Carbon::parse($changed['tanggal'])->locale('id_ID')->isoFormat('dddd, D MMMM YYYY'). ' jam '.$changed['jam']
            ]);

            $task->updateQuietly(['status' => 'assigned']);
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
