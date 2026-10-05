<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_and_manage_todos(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        // 1. Login
        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);
        $response->assertRedirect('/todos');
        $this->assertAuthenticatedAs($user);

        // 2. View Todos
        $response = $this->get('/todos');
        $response->assertStatus(200);

        // 3. Create Todo
        $response = $this->post('/todos', [
            'name' => 'Belajar Debugging Laravel',
            'description' => 'Menyelesaikan 15 bug',
        ]);
        $response->assertRedirect('/todos');
        $this->assertDatabaseHas('todos', [
            'name' => 'Belajar Debugging Laravel',
            'status' => 'Todo',
            'user_id' => $user->id,
        ]);

        $todo = Todo::first();

        // 4. Update Status
        $response = $this->patch("/todos/{$todo->id}/status", [
            'status' => 'done',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
            'status' => 'done',
        ]);

        // 5. Delete Todo
        $response = $this->delete("/todos/{$todo->id}");
        $response->assertStatus(302);
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);

        // 6. Logout
        $response = $this->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
