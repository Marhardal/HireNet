<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    /**
     * Get all of the Users for the Organisation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the Post that owns the Organisation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function Post()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    /**
     * Get all of the Post for the Organisation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Post()
    {
        return $this->hasMany(Post::class);
    }
}
