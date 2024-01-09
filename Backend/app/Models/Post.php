<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $with = ['organisation', 'job', 'duty', 'skills', 'certificate', 'arrangement'];

    function scopeFilters($query, array $filters)
    {
        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     $query->where('id', 'LIKE', '%' . $search . '%');
        // });
        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     $query->whereHas(
        //         'job',
        //         fn ($query) =>
        //         $query->where('name', 'LIKE', '%' . $search . '%')
        //     );
        // });

        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     $query->whereHas(
        //         'organisation',
        //         fn ($query) =>
        //         $query->where('name', 'LIKE', '%' . $search . '%')
        //     );
        // });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->whereHas(
                'arrangement',
                fn ($query) =>
                $query->where('name', 'LIKE', '%' . $search . '%')
            );
        });
    }

    /**
     * Get the Organisation that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    /**
     * Get the arrangement that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arrangement()
    {
        return $this->belongsTo(Arrangement::class);
    }

    public function Organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * Get the Job that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * The Duty that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Duty()
    {
        return $this->belongsToMany(Duty::class, 'post_duties', 'post_id', 'duty_id');
    }

    /**
     * The Skills that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Skills()
    {
        return $this->belongsToMany(Skill::class, 'post_skills');
    }

    /**
     * The Certificate that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Certificate()
    {
        return $this->belongsToMany(Certificate::class, 'requirements');
    }
}
