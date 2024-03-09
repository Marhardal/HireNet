<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referals extends Model
{
    use HasFactory;

    /**
     * Get the Resume that owns the Referals
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
