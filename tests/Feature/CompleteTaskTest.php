<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_complete_task(): void
    {
        $task = Task::factory()->create([
            'completed' => false
        ]);

        $response = $this->patch("/tasks/{$task->id}/complete");

        $response->assertStatus(302);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'completed' => true
        ]);
    }
}