<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    protected $guarded = ['id'];

    // Many-to-many: one skill is used in many projects
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_skill')->withTimestamps();
    }
}