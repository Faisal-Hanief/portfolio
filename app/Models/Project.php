<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['is_featured' => 'boolean'];
    }

    // Many-to-many: one project uses many skills
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'project_skill')->withTimestamps();
    }
}