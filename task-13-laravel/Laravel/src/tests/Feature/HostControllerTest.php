<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HostControllerTest extends TestCase
{

    use RefreshDatabase;

    protected $seed = true;


    public function testIndexAction()
    {
        $response = $this->get('users');
        $response->assertStatus(200);
        $response->assertViewIs('user.index');
    }

    public function testCreateAction()
    {
        $response = $this->get('users/create');
        $response->assertStatus(200);
        $response->assertViewIs('user.create');
    }
    public function testStoreAction()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example2.com',
            'gender' => 'male',
        ];

        $response = $this->post('users', $data);
        $response->assertRedirect('users');
        $this->assertDatabaseHas('users', $data);
    }

    public function testStore()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example2.com',
        ];

        $response = $this->post('/users', $data);
        $response->dumpHeaders();
        $response->dumpSession();
        $response->dump();
        $response->assertStatus(302);
        $response->assertSessionHasErrors('gender');
        $this->assertDatabaseMissing('users', $data);
    }

    public function testShowAction()
    {
        $user = User::factory()->create();
        $response = $this->get('users/' . $user->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->gender,
        ]);
    }
    public function testEditAction()
    {
        $user = User::factory()->create();
        $response = $this->get('users/' . $user->id . '/edit');
        $response->assertStatus(200);
        $response->assertViewIs('user.edit');
    }
    public function testUpdateAction()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example2.com',
            'gender' => 'female',
        ];

        $response = $this->put('users/' . $user->id, $data);
        $response->assertRedirect('users');
        $this->assertDatabaseHas('users', $data);
    }


    public function testDeleteAction() {

        $user = User::find(12);
        $response = $this->delete('users/12');
        $response->assertStatus(302);
        $response->assertRedirect('users');
        $this->assertDatabaseMissing('users', $user->toArray());
    }

    public function testIndexPageContainsUser()
    {
        $user = User::find(1);
        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function testIndexPageContainsNoUser()
    {
       
        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertDontSee('John Doe');
        $response->assertDontSee('john@example.com');
    } 

    public function testSixthRecordNotInFirstPage()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
        for ($i = 1; $i <= 5; $i++) {
            $user = User::find($i);
            $response->assertSee($user->name);
        }
        $sixthUser = User::find(6);
        $response->assertDontSee($sixthUser->name);
    }

    public function testIndexView() {


        $users = User::paginate(5);

        $view = $this->view('user.index', ['users' => $users]);
        $user = User::find(1);
        $view->assertSee($user->name);
    }


}
