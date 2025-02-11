<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TasksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return auth()->user()->tasks()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Task',
            'Deadline',
        ];
    }

    public function map($task_line): array
    {
        return [
            $task_line->id,
            $task_line->task,
            $task_line->deadline,
        ];
    }
}
