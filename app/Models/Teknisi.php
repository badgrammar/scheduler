<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    protected $table = 'teknisis';

    protected $fillable = [
        'name',
        'divisi'
    ];
}
