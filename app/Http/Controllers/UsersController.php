<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersLoginRequest;
use App\Http\Requests\UsersStoreRequest;
use App\Http\Requests\UsersUpdateRequest;
use App\Interfaces\Services\IRolesService;
use App\Interfaces\Services\IUsersService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    protected IUsersService $userService;
    protected IRolesService $rolesService;
    public function __construct(IUsersService $userService, IRolesService $rolesService)
    {
        $this->userService = $userService;
        $this->rolesService = $rolesService;
    }

    /*
     * Valida las credenciales y obtiene token de sesión
     */
    public function login(UsersLoginRequest $request)
    {
        try {
            $token = $this->userService->login($request->validated());
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Unauthorized', "msg" => $e->getMessage()], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Se ha presentado un error, intente más tarde'], 500);
        }
        return response()->json(['token' => $token]);
    }

    /*
     * Valida las credenciales y elimina el token de sesión
     */
    public function logout(Request $request)
    {
        try {
            $token = $request["token"];
            // Lógica para cerrar sesion usuario
            $this->userService->logout($token);
            return response()->json(['msg' => 'Se cerró la sesión.'], 200);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Se ha presentado un error, intente más tarde',
            ], 500);
        }
    }

    /*
     * Precarga de formulario registro de nuevo usuario
     */
    public function create()
    {
        //Listado de roles
        $roles = $this->rolesService->list();
        return response()->json(['roles' => $roles], 200);
    }

    /*
     * Registro de nuevo usuario
     */
    public function store(UsersStoreRequest $request)
    {
        try {
            // Lógica para crear el nuevo registro usuario
            $this->userService->store($request->validated());
            return response()->json(['msg' => 'Se registró usuario.'], 201);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Se ha presentado un error, intente más tarde.'
            ], 500);
        }
    }

    /*
     * Precarga de formulario editar usuario
     */
    public function edit($id)
    {
        try {
            //Buscar usuario
            $user = $this->userService->getUserById($id);
            //Obtener lista de roles y mostrarlo en el formulario
            $roles = $this->rolesService->list();
            return response()->json(["user" => $user, "roles" => $roles]);
        } catch (\Exception $e) {
            return response()->json(["error" => "Usuario no encontrado"], 404);
        }
    }

    /*
     * Actualización de usuario
     */
    public function update(UsersUpdateRequest $request, $id)
    {
        try {
            //Buscar usuario
            $user = $this->userService->getUserById($id);
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            // Lógica para actualizar usuario
            $this->userService->update($user, $request->validated());
            return response()->json([
                'msg' => 'Se actualizó usuario.'
            ], 200);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Error al actualizar el usuario'
            ], 400);
        }
    }
}
