<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Host;

class HostControllerTest extends TestCase
{

    use RefreshDatabase;

    protected $seed = true;


    public function testIndexAction()
    {
        $response = $this->get('host/users');
        $response->assertStatus(200);
        $response->assertViewIs('user.index');
    }

    public function testCreateAction()
    {
        $response = $this->get('host/users/create');
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

        $response = $this->post('host/users', $data);
        $response->assertRedirect('host/users');
        $this->assertDatabaseHas('hosts', $data);
    }

    public function testStore()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example2.com',
        ];

        $response = $this->post('host/users', $data);
        $response->dumpHeaders();
        $response->dumpSession();
        $response->dump();
        $response->assertStatus(302);
        $response->assertSessionHasErrors('gender');
        $this->assertDatabaseMissing('hosts', $data);
    }

    public function testShowAction()
    {
        $user = Host::factory()->create();
        $response = $this->get('host/users/' . $user->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->gender,
        ]);
    }
    public function testEditAction()
    {
        $user = Host::factory()->create();
        $response = $this->get('host/users/' . $user->id . '/edit');
        $response->assertStatus(200);
        $response->assertViewIs('user.edit');
    }
    public function testUpdateAction()
    {
        $user = Host::factory()->create();
        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example2.com',
            'gender' => 'female',
        ];

        $response = $this->put('host/users/' . $user->id, $data);
        $response->assertRedirect('host/users');
        $this->assertDatabaseHas('hosts', $data);
    }


    public function testDeleteAction() {

        $user = Host::find(12);
        $response = $this->delete('host/users/12');
        $response->assertStatus(302);
        $response->assertRedirect('host/users');
        $this->assertDatabaseMissing('hosts', $user->toArray());
    }

    public function testIndexPageContainsUser()
    {
        $user = Host::find(1);
        $response = $this->get('host/users');
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function testIndexPageContainsNoUser()
    {
       
        $response = $this->get('host/users');
        $response->assertStatus(200);
        $response->assertDontSee('John Doe');
        $response->assertDontSee('john@example.com');
    } 

    public function testSixthRecordNotInFirstPage()
    {
        $response = $this->get('host/users');
        $response->assertStatus(200);
        for ($i = 1; $i <= 5; $i++) {
            $user = Host::find($i);
            $response->assertSee($user->name);
        }
        $sixthUser = Host::find(6);
        $response->assertDontSee($sixthUser->name);
    }

    public function testIndexView() {


        $users = Host::paginate(5);

        $view = $this->view('user.index', ['users' => $users]);
        $user = Host::find(1);
        $view->assertSee($user->name);
    }


}
