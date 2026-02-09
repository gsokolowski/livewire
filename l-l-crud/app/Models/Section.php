<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;

    // ✅ ADDED: Relationship - Section belongs to Directory
    public function directory(): BelongsTo
    {
        return $this->belongsTo(Directory::class);
    }

    // ✅ ADDED: Relationship - Section has many Students
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}