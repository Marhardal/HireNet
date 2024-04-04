<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Js;

class Resume extends Model
{
    use HasFactory;

    protected $with = ['user', 'skills', 'certificates', 'referrals', 'jobs'];
    /**
     * Get the user that owns the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The Skills that belong to the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Skills()
    {
        return $this->belongsToMany(Skill::class, 'resume_skills',);
    }

    /**
     * The Certificate that belong to the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Certificates()
    {
        return $this->belongsToMany(Certificate::class, 'qualifications')->withPivot(['school', 'started', 'finished']);
    }

    /**
     * Get all of the Referrals for the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Referrals()
    {
        return $this->hasMany(Referrals::class);
    }

    /**
     * The Duties that belong to the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Duties()
    {
        return $this->belongsToMany(Duty::class, 'experiences')->withPivot(['job_id']);;
    }

    /**
     * The Jobs that belong to the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Jobs()
    {
        return $this->belongsToMany(Job::class, 'experiences')->withPivot(['duty_id', 'organisation', 'start', 'end']);
    }

    /**
     * Get all of the Field for the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    // public function Fields()
    // {
    //     return $this->hasManyThrough(Field::class, Certificate::class);
    // }

}
