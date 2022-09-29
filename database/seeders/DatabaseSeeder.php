<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $user1 = \App\Models\User::factory()->has(Chat::factory(8)->has(User::factory()))->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

        $user2 = User::factory()->create();

        $chat = Chat::factory()->hasAttached([$user1, $user2])->create();

        Message::factory(5)->create([
            'user_id' => $user1,
            'chat_id' => $chat
        ]);

        Message::factory(5)->create([
            'user_id' => $user2,
            'chat_id' => $chat
        ]);
    }
}
