<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksTest extends TestCase
{

    use RefreshDatabase;

    private User $user;

    public function setUp(): void{
        parent::setUp();
        $this->user = User::factory()
        ->has(Category::factory()->count(3), 'categories')
        ->create();

    }

    public function test_user_can_create_tasks(): void
    {
        $category = $this->user->categories()->first();
        $task = [
            'name' => "какая-то задача",
            'description' => "какая-то description",
            'due_date' => "12.02.2026",
            'user_id' => $this->user->id,
            'category_id' => $category->id,
        ];
        $response = $this->actingAs($this->user)->post('/tasks', $task);
        $response->assertStatus(201);
    }

    public function test_create_page_can_be_rendered(){
        $response = $this->actingAs($this->user)->get('/tasks/create');
        $response->assertStatus(200);
    }

    public function test_index_page_can_be_rendered(){
        $response = $this->actingAs($this->user)->get('/tasks');
        $response->assertStatus(200);
    }
}
