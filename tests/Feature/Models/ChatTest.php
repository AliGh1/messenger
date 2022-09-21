<?php

namespace Tests\Feature\Models;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatTest extends TestCase
{
    Use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_chat_belongs_to_users(): void
    {
        $chat = Chat::factory()->has(User::factory()->count(2))->create();
        $users = $chat->users();

        $this->assertDatabaseCount('chats', 1);
        $this->assertDatabaseCount('users', 2);

        $this->assertCount(2, $users->get());
        $this->assertInstanceOf(BelongsToMany::class, $users);
    }

    public function test_chat_has_many_messages()
    {
        $chat = Chat::factory()->has(Message::factory()->count(5))->create();
        $messages = $chat->messages();

        $this->assertDatabaseCount('chats', 1);
        $this->assertDatabaseCount('messages', 5);

        $this->assertCount(5, $messages->get());
        $this->assertInstanceOf(HasMany::class, $messages);
    }
}
