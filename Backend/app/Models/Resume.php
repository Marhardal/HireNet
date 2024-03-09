<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $with = ['user', 'skills', 'duties', 'certificate', 'referrals'];
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
     * The Duties that belong to the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Duties()
    {
        return $this->belongsToMany(Duty::class, 'resume_duties');
    }

    /**
     * The Certificate that belong to the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Certificate()
    {
        return $this->belongsToMany(Certificate::class, 'resume_qualifications');
    }

    /**
     * Get all of the Referrals for the Resume
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Referrals()
    {
        return $this->hasMany(Referals::class,);
    }


}
