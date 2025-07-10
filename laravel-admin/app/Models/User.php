<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authentication;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Passport\Client;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;

/**
 *
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder<static>|User newModelQuery()
 * @method static Builder<static>|User newQuery()
 * @method static Builder<static>|User query()
 * @method static Builder<static>|User whereCreatedAt($value)
 * @method static Builder<static>|User whereEmail($value)
 * @method static Builder<static>|User whereFirstName($value)
 * @method static Builder<static>|User whereId($value)
 * @method static Builder<static>|User whereLastName($value)
 * @method static Builder<static>|User wherePassword($value)
 * @method static Builder<static>|User whereUpdatedAt($value)
 * @property-read Collection<int, Client> $clients
 * @property-read int|null $clients_count
 * @property-read Collection<int, Token> $tokens
 * @property-read int|null $tokens_count
 * @property int $role_id
 * @property-read Role $role
 * @method static Builder<static>|User whereRoleId($value)
 * @property-read Collection<int, Client> $oauthApps
 * @property-read int|null $oauth_apps_count
 * @mixin Eloquent
 */
class User extends Authentication
{
    /** @use HasFactory<UserFactory> */
    use  HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ["id"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);

    }

    public function permissions(): \Illuminate\Support\Collection
    {
        return $this->role->permissions->pluck('name');
    }

    public function hasAccess($access): bool
    {
        return $this->permissions()->contains($access);
    }
}
