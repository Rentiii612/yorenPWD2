<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_task_report(): void
    {
        Task::factory()->create([
            'due_date' => '2026-06-20'
        ]);

        Task::factory()->create([
            'due_date' => '2026-06-20'
        ]);

        Task::factory()->create([
            'due_date' => '2026-06-21'
        ]);

        $response = $this->get('/task-report');

        $response->assertStatus(200);

        $response->assertSee('2026-06-20');

        $response->assertSee('2');

        $response->assertSee('2026-06-21');

        $response->assertSee('1');
    }
}