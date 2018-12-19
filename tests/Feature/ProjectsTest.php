<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_test()
    {
        $attributes = [
            'title'       => $this->faker->sentence(),
            'description' => $this->faker()->paragraph()
        ];

        $this->followingRedirects()
            ->withoutExceptionHandling()
            ->post("/projects", $attributes)
            ->assertSuccessful()
            ->assertSee($attributes['title']);

        $this->assertDatabaseHas("projects", $attributes);
    }
}
