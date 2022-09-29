<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['users'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['chatProfile'];

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class)->select(['id','name', 'username']);
    }

    public function messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function getChatProfileAttribute(): array
    {
        $user = $this->users->firstWhere('id', '!=', \Auth::id());

        return [
            'name' => $user->name,
            'username' => $user->username,
            'profile_photo_url' => $user->profile_photo_url
        ];
    }
}
