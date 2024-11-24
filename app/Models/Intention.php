<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intention extends Model
{
    protected $fillable = [
        'id',
        'contents',
        'user_id',
        'mass_date'
    ];

    protected $primaryKey = "id";

    protected $casts = [
        'contents' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
