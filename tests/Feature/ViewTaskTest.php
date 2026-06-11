<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_task_list(): void
    {
        Task::factory()->create([
            'title' => 'Belajar Laravel'
        ]);

        $response = $this->get('/tasks');

        $response->assertStatus(200);

        $response->assertSee('Belajar Laravel');
    }
}