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


    public function testIndexRoute()
    {
        $response = $this->get('host/users');
        $response->assertStatus(200);
        $response->assertViewIs('user.index');
    }

    public function testCreateRoute()
    {
        $response = $this->get('host/users/create');
        $response->assertStatus(200);
        $response->assertViewIs('user.create');
    }
    public function testStoreRoute()
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
    public function testShowRoute()
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
    public function testEditRoute()
    {
        $user = Host::factory()->create();
        $response = $this->get('host/users/' . $user->id . '/edit');
        $response->assertStatus(200);
        $response->assertViewIs('user.edit');
    }
    public function testUpdateRoute()
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


}
