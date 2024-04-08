<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $with = ['organisation', 'job', 'skills', 'certificate', 'arrangement', 'users', 'responsibilities'];

    function scopeFilters($query, array $filters)
    {
        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     $query->where('id', 'LIKE', '%' . $search . '%');
        // });
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->whereHas(
                'job',
                fn ($query) =>
                $query->where('name', 'LIKE', '%' . $search . '%')
            );
        });

        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     $query->whereHas(
        //         'organisation',
        //         fn ($query) =>
        //         $query->where('name', 'LIKE', '%' . $search . '%')
        //     );
        // });

        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     $query->whereHas(
        //         'arrangement',
        //         fn ($query) =>
        //         $query->where('name', 'LIKE', '%' . $search . '%')
        //     );
        // });
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
    // public function Duty()
    // {
    //     return $this->belongsToMany(Duty::class, 'post_duties', 'post_id', 'duty_id')->withTimestamps();
    // }

    /**
     * The Skills that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Skills()
    {
        return $this->belongsToMany(Skill::class, 'post_skills')->withTimestamps();
    }

    /**
     * The Certificate that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Certificate()
    {
        return $this->belongsToMany(Certificate::class, 'requirements')->withTimestamps();
    }

    /**
     * The User that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Users()
    {
        return $this->belongsToMany(User::class, 'applicants', 'post_id', 'user_id')->withPivot(['document', 'message', 'post_id', 'user_id', 'shortlisted'])->withTimestamps();
    }

    /**
     * The Interview that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Interview()
    {
        return $this->belongsToMany(Interview::class, 'applicants');
    }

    /**
     * Get the Responsibilities associated with the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Responsibilities()
    {
        return $this->hasOne(Responsibilities::class);
    }
}
