<?php

namespace Tests\Feature\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUserLastSeenTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_last_seen_changer_after_one_minutes(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);


        $old_last_seen = Carbon::parse($user->last_seen)->toDateTimeString();

        // add current time one minutes
        $this->travel(1)->minutes();

        $response = $this->get('/');
        $response->assertSessionHas('last_seen');
        $response->assertStatus(200);


        $new_last_seen = Carbon::parse($user->fresh()->last_seen)->toDateTimeString();

        $this->assertNotEquals($old_last_seen, $new_last_seen);
    }

    public function test_user_last_seen_do_not_change_under_one_minutes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);


        $old_last_seen = Carbon::parse($user->last_seen)->toDateTimeString();

        // add current time one minutes
        $this->travel(40)->seconds();

        $response = $this->get('/');
        $response->assertSessionHas('last_seen');
        $response->assertStatus(200);


        $new_last_seen = Carbon::parse($user->fresh()->last_seen)->toDateTimeString();

        $this->assertEquals($old_last_seen, $new_last_seen);
    }
}
