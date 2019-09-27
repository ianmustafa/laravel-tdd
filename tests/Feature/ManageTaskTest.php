<?php

namespace Tests\Feature;

use App\Task;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_users_can_create_a_task()
    {
        $task = factory(Task::class)->make();

        $this->visit('/tasks');

        $this->submitForm('Create Task', $task->toArray());

        $task->setAttribute('is_done', false);
        $this->seeInDatabase('tasks', $task->toArray());

        $this->seePageIs('/tasks');

        $this->see($task->name);
        $this->see($task->description);
    }

    /** @test */
    public function test_users_cannot_create_an_empty_task()
    {
        $task = factory(Task::class)->state('empty')->make();

        $this->visit('/tasks');

        $this->submitForm('Create Task', $task->toArray());

        $this->seePageIs('/tasks');

        $this->see(__('validation.required', ['attribute' => 'name']));
        $this->see(__('validation.required', ['attribute' => 'description']));
    }

    /** @test */
    public function test_users_cannot_create_a_short_task()
    {
        $task = factory(Task::class)->state('short')->make();

        $this->visit('/tasks');

        $this->submitForm('Create Task', $task->toArray());

        $this->seePageIs('/tasks');

        $this->see(__('validation.min.string', [
            'attribute' => 'name',
            'min' => 6,
        ]));
        $this->see(__('validation.min.string', [
            'attribute' => 'description',
            'min' => 12,
        ]));

        $this->seeInField('name', $task->name);
        $this->seeInField('description', $task->description);
    }

    /** @test */
    public function test_users_cannot_create_a_long_task()
    {
        $task = factory(Task::class)->state('long')->make();

        $this->visit('/tasks');

        $this->submitForm('Create Task', $task->toArray());

        $this->seePageIs('/tasks');

        $this->see(__('validation.max.string', [
            'attribute' => 'name',
            'max' => 255,
        ]));
        $this->see(__('validation.max.string', [
            'attribute' => 'description',
            'max' => 255,
        ]));

        $this->seeInField('name', $task->name);
        $this->seeInField('description', $task->description);
    }

    /** @test */
    public function test_users_can_read_all_tasks()
    {
        $tasks = factory(Task::class, 3)->create();

        $this->visit('/tasks');

        $this->see($tasks[0]->name);
        $this->see($tasks[0]->description);
        $this->see($tasks[1]->name);
        $this->see($tasks[1]->description);
        $this->see($tasks[2]->name);
        $this->see($tasks[2]->description);

        $this->seeElement('a', [
            'id'   => "edit-task-{$tasks[0]->id}",
            'href' => url("tasks?action=edit&id={$tasks[0]->id}"),
        ]);
        $this->seeElement('a', [
            'id'   => "edit-task-{$tasks[1]->id}",
            'href' => url("tasks?action=edit&id={$tasks[1]->id}"),
        ]);
        $this->seeElement('a', [
            'id'   => "edit-task-{$tasks[2]->id}",
            'href' => url("tasks?action=edit&id={$tasks[2]->id}"),
        ]);
    }

    /** @test */
    public function test_users_can_edit_an_existing_task()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function test_users_can_delete_an_existing_task()
    {
        $this->assertTrue(true);
    }
}
