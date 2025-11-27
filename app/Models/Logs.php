<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
