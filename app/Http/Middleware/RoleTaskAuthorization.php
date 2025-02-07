<?php

namespace App\Http\Middleware;

use App\Models\Task;
use App\Models\Users;
use App\Models\UserToken;
use Closure;

class RoleTaskAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request["user"];
        $id = $request->route('id');
        if ($user->role_id != 1) {
            $task = Task::find($id);
            if (is_null($task)) {
                return response()->json(['error' => 'Tarea no encontrada'], 404);
            }
            if ($task->users_id != $user->id) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }
        return $next($request);
    }
}
