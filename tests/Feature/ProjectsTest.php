<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testAUserCanCreateProjects()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];
        $this->actingAs(User::factory()->create())->post('/projects', $attributes)->assertRedirect('/projects');
        $this->assertDatabaseHas('projects', $attributes);
        $this->get('/projects')->assertSee($attributes['title']);
    }

    public function testAProjectRequiresATitle()
    {
        $attributes = Project::factory()->raw(['title' => '']);
        $this->actingAs(User::factory()->create())->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function testAProjectRequiresADescription()
    {
        $attributes = Project::factory()->raw(['description' => '']);
        $this->actingAs(User::factory()->create())->post('/projects', $attributes)->assertSessionHasErrors(
            'description'
        );
    }

    public function testAProjectCanBeViewed()
    {
        $this->withoutExceptionHandling();
        $project = Project::factory()->create();
        $this->get($project->path())
             ->assertSee($project->title)
             ->assertSee($project->description);
    }

    public function testOnlyAuthenticatedUsersCanCreateProjects()
    {
        $attributes = Project::factory()->raw();
        $this->post('/projects', $attributes)->assertRedirect('login');
    }
}
