<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
