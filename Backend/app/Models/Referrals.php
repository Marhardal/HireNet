<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referrals extends Model
{
    use HasFactory;

    /**
     * Get all of the Resume for the Referals
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Resume()
    {
        return $this->hasMany(Resume::class);
    }
}
