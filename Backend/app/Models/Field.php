<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    /**
     * Get all of the Certificates for the Field
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
