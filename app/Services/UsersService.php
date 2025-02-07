<?php

namespace App\Services;

use App\Interfaces\Repositories\IUsersRepository;
use App\Interfaces\Repositories\IUsersTokenRepository;
use App\Interfaces\Services\IUsersService;
use App\Interfaces\Services\IUsersTokenService;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsersService implements IUsersService
{
    protected IUsersRepository $usersRepository;
    protected IUsersTokenRepository $usersTokenRepository;
    protected IUsersTokenService $usersTokenService;

    public function __construct(
        IUsersRepository $usersRepository,
        IUsersTokenRepository $usersTokenRepository,
        IUsersTokenService $usersTokenService
    ) {
        $this->usersRepository = $usersRepository;
        $this->usersTokenRepository = $usersTokenRepository;
        $this->usersTokenService = $usersTokenService;
    }

    public function login($data)
    {
        try {
            //Buscar existencia de email
            $user = $this->usersRepository->findByEmail($data['email']);
            if (is_null($user)) {
                throw ValidationException::withMessages([
                    'email' => 'Las credenciales son incorrectas.'
                ]);
            }

            if (!Hash::check($data['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'email' => 'Las credenciales son incorrectas.'
                ]);
            }

            //Borrar token existente por usuario
            $this->usersTokenRepository->deleteByUser($user->id);

            //Generar token
            $token = $this->usersTokenService->setToken($user);

            //Registrar sesion usuario / token
            $data_token = array("users_id" => $user->id, "token" => $token);
            $this->usersTokenRepository->create($data_token);

            return $token;
        } catch (ValidationException $e) {
            throw $e; // 401 para credenciales incorrectas
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function logout($token)
    {
        //Borrar token cerrar sesion
        return $this->usersTokenRepository->deleteByToken($token);
    }

    public function store($data)
    {

        extract($data);
        try {
            $arr_data = [
                "fullname" => $fullname,
                "email" => $email,
                "role_id" => $role_id,
                "password" => Hash::make($password),
            ];
            return $this->usersRepository->store($arr_data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(Users $user, $data)
    {
        extract($data);
        try {
            $arr_data = [
                "fullname" => $fullname,
                "role_id" => $role_id,
            ];
            return $this->usersRepository->update($user, $arr_data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getUserById($id)
    {
        return $this->usersRepository->findById($id);
    }
}
