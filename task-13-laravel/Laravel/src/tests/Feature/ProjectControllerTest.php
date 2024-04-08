<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testIndexAction()
    {

        $response = $this->get('projects');
        $response->assertStatus(200);
        $response->assertViewIs('project.index');
    }

    public function testCreateAction() {

        $response = $this->get('projects/create');
        $response->assertStatus(200);
        $response->assertViewIs('project.create');
    }


    public function testStoreAction() {

        $data = [
            'user_id' => 4,
            'title' => 'project title',
            'description' => 'project description',

        ];

        $response = $this->post('/projects', $data);
        $response->assertStatus(302);
        $response->assertRedirect('projects/4');
        $this->assertDatabaseHas('projects', $data);
    }

    public function testShowAction() {

        $response = $this->get('projects/4');
        $response->assertStatus(200);
        $response->assertViewIs('project.show');
    }

    public function testEditAction() {

        $response = $this->get('projects/4/edit');
        $response->assertStatus(200);
        $response->assertViewIs('project.edit');
    }

    public function testUpdateAction() {

        $data = [
            'user_id' => 4,
            'title' => 'updated title',
            'description' => 'updated description',

        ];

        $response = $this->put('projects/4', $data);
        $response->assertStatus(302);
        $response->assertRedirect('projects/4');

    }


    public function testStoreMethodWhenUserNotFound()
    {
      
        $response = $this->post('/projects', [
            'user_id' => 999,
            'title' => 'Test Project',
            'description' => 'Test project description',
        ]);
        $response->assertStatus(200);

        $response->assertSessionHas('error', 'user not found');
    }



    /*public function testShowMethodWithProjectsAndUser()
    {
        //when testing this function comment the links in the project.show   
        $host = Host::factory()->create();
        $projects = Project::factory()->count(3)->create(['user_id' => $host->id]);
        $view = $this->view('project.show', ['projects' => $projects, 'user' => $host]);
        
        foreach ($projects as $project) {
            $view->assertSee($project->name);
        }
    }*/

}
