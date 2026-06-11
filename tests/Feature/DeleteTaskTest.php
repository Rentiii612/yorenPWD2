<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_delete_uncompleted_task(): void
    {
        $task = Task::factory()->create([
            'completed' => false
        ]);

        $response = $this->delete("/tasks/{$task->id}");

        $response->assertStatus(302);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
}