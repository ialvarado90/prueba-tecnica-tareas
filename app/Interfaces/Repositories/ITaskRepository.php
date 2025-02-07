<?php

namespace App\Interfaces\Repositories;

use App\Models\Task;

interface ITaskRepository
{
    public function store($data);
    public function findById($id);
    public function update(Task $task, $data);
    public function delete($id);
    public function getAllFilters($data);
    public function getAllSearch($data);
}
