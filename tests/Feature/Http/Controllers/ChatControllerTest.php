<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_chats_can_load()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('chats.index'));

        $response->assertStatus(200);
    }
}
