<?php

namespace App\Services;

use App\Interfaces\Repositories\ITaskRepository;
use App\Interfaces\Services\ITaskService;
use App\Models\Task;

class TaskService implements ITaskService
{
    protected ITaskRepository $taskRepository;
    public function __construct(ITaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function store($data)
    {
        extract($data);
        $arr_fecha_vencimiento = explode("/", $fecha_vencimiento);
        $fecha_vencimiento = $arr_fecha_vencimiento[2] . "-" . $arr_fecha_vencimiento[1] . "-" . $arr_fecha_vencimiento[0];
        try {
            $arr_data = [
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "fecha_vencimiento" => $fecha_vencimiento,
                "users_id" => $user->id
            ];
            return $this->taskRepository->store($arr_data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(Task $task, $data)
    {
        extract($data);
        $arr_fecha_vencimiento = explode("/", $fecha_vencimiento);
        $fecha_vencimiento = $arr_fecha_vencimiento[2] . "-" . $arr_fecha_vencimiento[1] . "-" . $arr_fecha_vencimiento[0];
        try {
            $arr_data = [
                "titulo" => $titulo,
                "descripcion" => $descripcion,
                "fecha_vencimiento" => $fecha_vencimiento,
            ];
            return $this->taskRepository->update($task, $arr_data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getTaskById($id)
    {
        return $this->taskRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->taskRepository->delete($id);
    }

    public function process(Task $task, $data)
    {
        extract($data);
        try {
            $arr_data = [
                "process" => $process,
            ];
            return $this->taskRepository->update($task, $arr_data);
        } catch (\Exception $e) {
            throw $e;
        }
    }    

    public function list($data)
    {
        return $this->taskRepository->getAllFilters($data);
    }    

    public function search($data)
    {
        return $this->taskRepository->getAllSearch($data);
    }
}
