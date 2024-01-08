<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrangement extends Model
{
    use HasFactory;

    /**
     * Get the Post associated with the Arrangement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Post()
    {
        return $this->hasOne(Post::class);
    }
}
