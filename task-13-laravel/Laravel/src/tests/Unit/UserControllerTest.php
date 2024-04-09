<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use App\Models\User;
use App\Http\Controllers\UserController;
use \Illuminate\View\View;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    public function testIndexAction()
    {
        $userController = new UserController();
        $view = $userController->index();
        
        $this->assertEquals('user.index', $view->getName());
    }

    public function testCreateAction()
    {
        $userController = new UserController();
        $view = $userController->create();
        
        $this->assertEquals('user.create', $view->getName());
    }

    public function testStoreAction()
    {
        $request = new Request([
            'name' => 'Test User',
            'email' => 'test@example2.com',
            'gender' => 'male',
        ]);

        $userController = new UserController();
        $response = $userController->store($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertDatabaseHas('users', ['name' => 'Test User']);
    }

    public function testStoreValidation()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example2.com',
        ];

        $request = new Request($data);

        $userController = new UserController();
        $validator = Validator::make($data, [
            'gender' => 'required',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->messages()->has('gender'));
        $this->assertEquals('The gender field is required.', $validator->messages()->first('gender'));
    }


    public function testEditAction()
    {
        $user = User::factory()->create();
        $userController = new UserController();
        $view = $userController->edit($user->id);

        $this->assertEquals('user.edit', $view->getName());
    }

    public function testUpdateAction()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example2.com',
            'gender' => 'female',
        ];

        $request = new Request($data);

        $userController = new UserController();
        $response = $userController->update($request, $user->id);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertDatabaseHas('users', $data);
    }

    public function testDeleteAction()
    {
        $user = User::factory()->create();
        $userController = new UserController();
        $response = $userController->destroy($user->id);

        $this->assertEquals('http://localhost/users', $response->getTargetUrl());
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
