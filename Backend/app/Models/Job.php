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
}
