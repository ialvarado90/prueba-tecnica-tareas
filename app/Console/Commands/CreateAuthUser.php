<?php

namespace App\Console\Commands;

use App\Models\Users;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAuthUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->createUser();
    }

    protected function createUser()
    {
        $this->info('Crear usuario rol encargado');
        $email = $this->ask("Email:");
        $password = $this->secret('Password:');
        $validator = Validator::make([
            'password' => $password,
            'email' => $email
        ], [
            'email' => ['required', 'email',],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            $this->info('Usuario no se pudo crear:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            $this->handle();
        } else {
            $auth_user = new Users();
            $auth_user->password = Hash::make($password);
            $auth_user->email = $email;
            $auth_user->role_id = 1;
            $auth_user->save();
            $this->info('Usuario creado');
        }
    }
}
