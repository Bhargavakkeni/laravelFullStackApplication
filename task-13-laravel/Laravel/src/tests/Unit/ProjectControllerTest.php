<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\User;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request; // Import Request class

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testIndexAction()
    {
        $controller = new ProjectController();
        $response = $controller->index();

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('project.index', $response->getName());
    }

    public function testCreateAction()
    {
        $controller = new ProjectController();
        $response = $controller->create(new Request()); // Pass an instance of Request

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('project.create', $response->getName());
    }

    public function testStoreAction()
    {
        $controller = new ProjectController();

        $data = [
            'user_id' => 4,
            'title' => 'project title',
            'description' => 'project description',
        ];

        $response = $controller->store(new Request($data)); // Pass an instance of Request
        
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertDatabaseHas('projects', $data);
    }

    public function testShowAction()
    {
        $controller = new ProjectController();
        $response = $controller->show(4);

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('project.show', $response->getName());
    }

    public function testEditAction()
    {
        $controller = new ProjectController();
        $response = $controller->edit(4);

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('project.edit', $response->getName());
    }

    public function testUpdateAction()
    {
        $controller = new ProjectController();

        $data = [
            'user_id' => 4,
            'title' => 'updated title',
            'description' => 'updated description',
        ];

        $response = $controller->update(new Request($data), 4);
        
        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertDatabaseHas('projects', $data);
    }

    public function testStoreMethodWhenUserNotFound()
    {
        $controller = new ProjectController();

        $response = $controller->store(new Request([
            'user_id' => 999,
            'title' => 'Test Project',
            'description' => 'Test project description',
        ]));

        $this->assertTrue(session()->has('error'));
    }
}
