<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    protected $fillable = [
        'id',
        'name'
    ];

    public function intentions() {
        return $this->hasMany(Intention::class);
    }
}
