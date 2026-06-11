<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_update_uncompleted_task(): void
    {
        $task = Task::factory()->create([
            'completed' => false
        ]);

        $response = $this->put("/tasks/{$task->id}", [
            'title' => 'Judul Baru',
            'description' => 'Deskripsi Baru',
            'due_date' => '2026-07-01'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Judul Baru'
        ]);
    }
}