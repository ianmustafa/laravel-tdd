<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_can_create_a_task()
    {
        $this->visit('/tasks');

        $this->submitForm('Create Task', [
            'name' => 'My First Task',
            'description' => 'This is my first task in my new job.',
        ]);

        $this->seeInDatabase('tasks', [
            'name' => 'My First Task',
            'description' => 'This is my first task in my new job.',
            'is_done' => 0,
        ]);

        $this->seePageIs('/tasks');

        $this->see('My First Task');
        $this->see('This is my first task in my new job.');
    }

    /** @test */
    public function test_new_task_entry_must_not_be_empty()
    {
        $this->visit('/tasks');

        $this->submitForm('Create Task', [
            'name' => '',
            'description' => '',
        ]);

        $this->seePageIs('/tasks');

        $this->see(__('validation.required', ['attribute' => 'name']));
        $this->see(__('validation.required', ['attribute' => 'description']));
    }

    /** @test */
    public function test_new_task_entry_must_not_be_too_short()
    {
        $this->visit('/tasks');

        $this->submitForm('Create Task', [
            'name' => 'Task',
            'description' => 'Desc',
        ]);

        $this->seePageIs('/tasks');

        $this->see(__('validation.min.string', [
            'attribute' => 'name',
            'min' => 6,
        ]));
        $this->see(__('validation.min.string', [
            'attribute' => 'description',
            'min' => 12,
        ]));

        $this->seeInField('name', 'Task');
        $this->seeInField('description', 'Desc');
    }

    /** @test */
    public function test_new_task_entry_must_not_be_too_long()
    {
        $this->visit('/tasks');

        $this->submitForm('Create Task', [
            'name' => str_repeat('Task', 75),
            'description' => str_repeat('Desc', 75),
        ]);

        $this->seePageIs('/tasks');

        $this->see(__('validation.max.string', [
            'attribute' => 'name',
            'max' => 255,
        ]));
        $this->see(__('validation.max.string', [
            'attribute' => 'description',
            'max' => 255,
        ]));

        $this->seeInField('name', str_repeat('Task', 75));
        $this->seeInField('description', str_repeat('Desc', 75));
    }

    /** @test */
    public function test_user_can_read_all_tasks()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function test_user_can_edit_an_existing_task()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function test_user_can_delete_an_existing_task()
    {
        $this->assertTrue(true);
    }
}
