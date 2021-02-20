<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model {
    use HasFactory;

    protected $fillable = [
        'text', 'finished'
    ];

    protected $casts = [
        'finished' => 'boolean'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

}
