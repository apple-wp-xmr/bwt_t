<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $guarded = false;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
