<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_index(): void
    {
        $task_1 = Task::factory()->create();
        $task_2 = Task::factory()->create();
        $task_3 = Task::factory()->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)->assertJson(function (AssertableJson $json) use ($task_1, $task_2, $task_3) {
            $json->has('tasks', 3)
                ->where('tasks.0.id', $task_1->id)
                ->where('tasks.0.content', $task_1->content)

                ->where('tasks.1.id', $task_2->id)
                ->where('tasks.1.content', $task_2->content)

                ->where('tasks.2.id', $task_3->id)
                ->where('tasks.2.content', $task_3->content);
        } );
    }

    public function test_create(): void
    {
        $content = 'THIS IS TEST CONTENT';

        $response = $this->post('/api/tasks', [
            'content' => $content
        ]);

        $response->assertStatus(200)->assertJson(function (AssertableJson $json) use ($content) {
            $json->where('task.content', $content);
        });
    }

    public function test_show(): void
    {
        $task = Task::factory()->create();

        $response = $this->get('/api/tasks/'.$task->id);

        $response->assertJsonFragment([
            'task' => [
                'id' => $task->id,
                'content' => $task->content,
                'created_at' => $task->created_at,
                'updated_at' => $task->updated_at
            ]
        ]);
        $response->assertStatus(200);
    }

    public function test_delete(): void
    {
        $task = Task::factory()->create();

        $this->assertNotNull(Task::find($task->id));

        $this->delete('/api/tasks/'.$task->id);

        $this->assertNull(Task::find($task->id));
    }

    public function test_update()
    {
        $updatedContent = 'UPDATED';
        $task = Task::factory()->create();

        $response = $this->put('/api/tasks/'.$task->id, [
            'content' => $updatedContent
        ]);

        $response->assertStatus(200)->assertJson(function (AssertableJson $json) use ($updatedContent) {
            $json->where('task.content', $updatedContent);
        });
    }
}
