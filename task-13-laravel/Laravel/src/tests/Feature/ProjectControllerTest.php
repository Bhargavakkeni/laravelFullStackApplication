<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testIndexAction()
    {

        $response = $this->get('host/projects');
        $response->assertStatus(200);
        $response->assertViewIs('project.index');
    }

    public function testCreateAction() {

        $response = $this->get('host/projects/create');
        $response->assertStatus(200);
        $response->assertViewIs('project.create');
    }


    public function testStoreAction() {

        $data = [
            'user_id' => 4,
            'title' => 'project title',
            'description' => 'project description',

        ];

        $response = $this->post('/host/projects', $data);
        $response->assertStatus(302);
        $response->assertRedirect('host/projects/4');
        $this->assertDatabaseHas('projects', $data);
    }

    public function testShowAction() {

        $response = $this->get('host/projects/4');
        $response->assertStatus(200);
        $response->assertViewIs('project.show');
    }

    public function testEditAction() {

        $response = $this->get('host/projects/4/edit');
        $response->assertStatus(200);
        $response->assertViewIs('project.edit');
    }

    public function testUpdateAction() {

        $data = [
            'user_id' => 4,
            'title' => 'updated title',
            'description' => 'updated description',

        ];

        $response = $this->put('host/projects/4', $data);
        $response->assertStatus(302);
        $response->assertRedirect('host/projects/4');

    }
}
