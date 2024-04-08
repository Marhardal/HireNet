<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    /**
     * The Post that belong to the Interview
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Post()
    {
        return $this->belongsToMany(Post::class, 'applicants');
    }

    /**
     * The User that belong to the Interview
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function User()
    {
        return $this->belongsToMany(User::class, 'applicants');
    }
}
