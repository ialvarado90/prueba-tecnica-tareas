<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskProcessUpdateRequest;
use App\Http\Requests\TaskSearchRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Interfaces\Services\ITaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected ITaskService $taskService;
    public function __construct(ITaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /*
     * Registro de nueva tarea
     */
    public function store(TaskStoreRequest $request)
    {
        try {
            // Lógica para crear la nueva tarea
            $this->taskService->store($request->all());
            return response()->json(['msg' => 'Se registró la tarea.'], 201);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Se ha presentado un error, intente más tarde.'
            ], 500);
        }
    }

    /*
     * Precarga de formulario editar tarea
     */
    public function edit($id)
    {
        try {
            //Buscar tarea
            $task = $this->taskService->getTaskById($id);
            return response()->json(["task" => $task]);
        } catch (\Exception $e) {
            return response()->json(["error" => "Tarea no encontrada"], 404);
        }
    }

    /*
     * Actualización de tarea
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        try {
            //Buscar tarea
            $task = $this->taskService->getTaskById($id);
            if (!$task) {
                return response()->json(['error' => 'Tarea no encontrada'], 404);
            }

            // Lógica para actualizar tarea
            $this->taskService->update($task, $request->validated());
            return response()->json([
                'msg' => 'Se actualizó tarea.'
            ], 200);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Error al actualizar tarea'
            ], 400);
        }
    }

    /*
     * Eliminar de tarea
     */
    public function destroy($id)
    {
        try {
            //Buscar tarea
            $task = $this->taskService->getTaskById($id);
            if (!$task) {
                return response()->json(['error' => 'Tarea no encontrada'], 404);
            }

            // Lógica para eliminar tarea
            $this->taskService->delete($id);
            return response()->json([
                'msg' => 'Se eliminó tarea.'
            ], 200);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Error al eliminar tarea'
            ], 400);
        }
    }

    /*
     * Cambiar estado de tarea
     */
    public function process(TaskProcessUpdateRequest $request, $id)
    {
        try {
            //Buscar tarea
            $task = $this->taskService->getTaskById($id);
            if (!$task) {
                return response()->json(['error' => 'Tarea no encontrada'], 404);
            }

            // Lógica para actualizar el estado de la tarea
            $this->taskService->process($task, $request->validated());
            return response()->json([
                'msg' => 'Se actualizó tarea.'
            ], 200);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Error al actualizar tarea'
            ], 400);
        }
    }

    /*
     * Listado de Tareas - filtro y paginación
     */
    public function list(Request $request)
    {
        //Listado de roles
        try {
            $tasks = $this->taskService->list($request->all());
            return response()->json($tasks, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al listar tareas'], 500);
        }
        return response()->json(['roles' => $roles], 200);
    }

    /*
     * Búsqueda de Tareas - título o descripción.
     */
    public function search(TaskSearchRequest $request)
    {
        //Listado de roles
        try {
            $tasks = $this->taskService->search($request->all());
            return response()->json($tasks, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar tareas'], 500);
        }
        return response()->json(['roles' => $roles], 200);
    }
}
