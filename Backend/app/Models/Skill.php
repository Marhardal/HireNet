<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    /**
     * The Post that belong to the Skill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Post()
    {
        return $this->belongsToMany(Post::class, 'post_skills');
    }
}
