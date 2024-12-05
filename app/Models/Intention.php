<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intention extends Model
{
    protected $fillable = [
        'id',
        'contents',
        'user_id',
        'mass_date',
        'church_id'
    ];

    protected $primaryKey = "id";

    protected $casts = [
        'mass_date' => 'datetime',
        'contents' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function church() {
        return $this->belongsTo(Church::class);
    }
}
