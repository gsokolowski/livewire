<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    // ✅ ADDED: Mass assignable fields
    protected $fillable = [
        'name',
        'email',
        'directory_id',
        'section_id',
    ];

    // ✅ ADDED: Relationship - Student belongs to Directory
    public function directory(): BelongsTo
    {
        return $this->belongsTo(Directory::class);
    }

    // ✅ ADDED: Relationship - Student belongs to Section
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}