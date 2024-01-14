<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    /**
     * Get the Post that owns the Bookmark
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
