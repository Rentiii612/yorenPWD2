<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTestTask extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task(): void
    {
        $response = $this->post('/tasks', [
            'title' => 'Belajar Laravel',
            'description' => 'Mempelajari TDD',
            'due_date' => '2026-06-20'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Belajar Laravel'
        ]);
    }
}