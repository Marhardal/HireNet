<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    /**
     * Get the user associated with the Apply
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all of the Post for the Apply
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Post()
    {
        return $this->hasMany(Post::class);
    }
}
