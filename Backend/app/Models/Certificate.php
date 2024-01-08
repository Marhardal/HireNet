<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    /**
     * The Post that belong to the Certificate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Post()
    {
        return $this->belongsToMany(Role::class, 'requirements');
    }
}
