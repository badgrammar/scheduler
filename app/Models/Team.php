<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    protected $guarded = [];

    public function members()
    {
        return $this->belongsToMany(Teknisi::class, 'team_member', 'team_id', 'teknisi_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
