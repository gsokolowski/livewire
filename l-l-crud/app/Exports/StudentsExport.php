<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $studentIds;

    public function __construct(array $studentIds)
    {
        $this->studentIds = $studentIds;
    }

    public function collection()
    {
        return Student::with(['directory', 'section'])
            ->whereIn('id', $this->studentIds)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Directory',
            'Section',
            'Created At'
        ];
    }

    public function map($student): array
    {
        return [
            $student->id,
            $student->name,
            $student->email,
            $student->directory->name ?? 'N/A',
            $student->section->name ?? 'N/A',
            $student->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
