<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Directory extends Model
{
    /** @use HasFactory<\Database\Factories\DirectoryFactory> */
    use HasFactory;

    // ✅ ADDED: Relationship - Directory has many Sections
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    // ✅ ADDED: Relationship - Directory has many Students
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}