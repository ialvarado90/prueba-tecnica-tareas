<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ITaskRepository;
use App\Models\Task;

class TaskRepository implements ITaskRepository
{
    public function store($data)
    {
        return Task::create($data);
    }

    public function update(Task $task, $data)
    {
        return $task->update($data);
    }

    public function findById($id)
    {
        return Task::findOrFail($id);
    }

    public function delete($id)
    {
        return Task::where("id", $id)->update(["status" => 2]);
    }

    public function getAllFilters($data)
    {
        extract($data);
        $perPage = isset($perPage) ? $perPage : 10;
        $page = $page ?? 1;
        $query = Task::where("status", 1);
        if (isset($process) && $process != '') {
            $query = $query->where("process", $process);
        }
        $query = $query->select(["id", "titulo", "process", "fecha_vencimiento"]);
        $tasks = $query->paginate($perPage)->toArray();
        return [
            'data' => $tasks['data'],
            'total' => $tasks['total'],
            'current_page' => $tasks['current_page'],
            'last_page' => $tasks['last_page'],
            'per_page' => $tasks['per_page'],
        ];
    }

    public function getAllSearch($data)
    {
        extract($data);

        $tasks = Task::where("status", 1);
        if (isset($search) && $search != '') {
            $tasks = $tasks->where(function ($query) use ($search) {
                $query->where('titulo', 'LIKE', '%' . $search . '%')
                    ->orWhere('descripcion', 'LIKE', '%' . $search . '%');
            });
        }
        $tasks = $tasks->get(["id", "titulo", "process", "fecha_vencimiento"]);
        return $tasks;
    }
}
