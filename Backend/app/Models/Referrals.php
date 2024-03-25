<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referrals extends Model
{
    use HasFactory;

    /**
     * Get the Resume that owns the Referrals
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
