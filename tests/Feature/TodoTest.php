<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_todo_can_be_created()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post('/todos', [
            'title' => 'テストTodo',
            'body' => 'テスト本文',
            'category_id' => $category->id,
            'attachment_path' => 'testpath'
        ]);

        $response->assertRedirect('/todos');

        $this->assertDatabaseHas('todos', [
            'title' => 'テストTodo',
        ]);
    }

    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_api_can_return_todos()
    {
        $user = User::factory()->create([
            'api_token' => 'test-token',
        ]);

        $response = $this->withHeaders([
            'X-API-TOKEN' => $user->api_token,
        ])->getJson('/api/todos');

        $response->assertStatus(200);
    }
}
