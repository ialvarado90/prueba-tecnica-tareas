<?php

namespace App\Interfaces\Services;

use App\Models\Task;

interface ITaskService
{
    public function store($data);
    public function getTaskById($id);
    public function update(Task $task, $data);
    public function delete($id);
    public function process(Task $task, $data);
    public function list($data);
    public function search($data);
}
