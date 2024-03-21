<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    /**
     * Get the Post associated with the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Post()
    {
        return $this->hasOne(Post::class);
    }

    /**
     * The Resumes that belong to the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Resumes()
    {
        return $this->belongsToMany(Resume::class, 'experiences');
    }

    /**
     * The Duties that belong to the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Duties()
    {
        return $this->belongsToMany(Duty::class, 'experiences');
    }
}
