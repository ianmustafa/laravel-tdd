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
