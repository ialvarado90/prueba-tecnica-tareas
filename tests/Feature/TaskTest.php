<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_it_cannot_create_a_task_without_login()
    {
        $taskData = [
            'titulo' => 'Nueva Tarea',
            'descripcion' => 'Descripción de tarea',
            'fecha_vencimiento' => date("Y-m-d")
        ];

        $response = $this->postJson('/api/tasks/store', $taskData);

        //Validar que no puede registrar tarea sin estar logueado
        $response->assertStatus(401)
            ->assertJson(['error' => 'Unauthorized']);
    }
}
