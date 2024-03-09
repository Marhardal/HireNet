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

    function scopeFilters($query, array $filters){
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('id', 'LIKE', '%' . $search . '%');
        });
    }

    public function Post()
    {
        return $this->belongsToMany(Post::class, 'post_skills');
    }

    /**
     * The Resume that belong to the Skill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Resume()
    {
        return $this->belongsToMany(Resume::class, 'resume_skills', 'resume_id', 'skill_id');
    }
}
