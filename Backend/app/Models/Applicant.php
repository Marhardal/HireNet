<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $with = ['post'];
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
     * Get the Post that owns the Applicant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Post()
    {
        return $this->belongsTo(Post::class);
    }
}
