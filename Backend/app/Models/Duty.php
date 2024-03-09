<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    /**
     * The Post that belong to the Duty
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Post()
    {
        return $this->belongsToMany(Post::class, 'post_duties', 'post_id', 'duty_id',);
    }

    /**
     * The Resume that belong to the Duty
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Resume()
    {
        return $this->belongsToMany(Resume::class, 'resume_duties');
    }
}
