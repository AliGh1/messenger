<?php

namespace Tests\Feature\Models;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_belongs_to_chats()
    {
        $user = User::factory()->has(Chat::factory()->count(3))->create();
        $chats = $user->chats();

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseCount('chats', 3);

        $this->assertCount(3, $chats->get());
        $this->assertInstanceOf(BelongsToMany::class, $chats);
    }

}
