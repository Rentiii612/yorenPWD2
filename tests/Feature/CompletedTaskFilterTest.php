<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompletedTaskFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_completed_tasks_in_date_range(): void
    {
        Task::factory()->create([
            'title' => 'Task 1',
            'completed' => true,
            'completed_at' => '2026-06-10'
        ]);

        Task::factory()->create([
            'title' => 'Task 2',
            'completed' => true,
            'completed_at' => '2026-07-10'
        ]);

        $response = $this->get(
            '/completed-tasks?start_date=2026-06-01&end_date=2026-06-30'
        );

        $response->assertStatus(200);

        $response->assertSee('Task 1');

        $response->assertDontSee('Task 2');
    }
}