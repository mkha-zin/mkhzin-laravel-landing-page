<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin(): bool
    {
        return auth()->user()->role === 'admin';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'app') {

            if ($this->isSuperAdmin()) {
                return str_ends_with($this->email, '@mkhzin.com') && $this->hasVerifiedEmail();
            }
            $unauthorized = __('dashboard.unotherized');
            return abort('403', str($unauthorized));
        }
        return str_ends_with($this->email, '@mkhzin.com') && $this->hasVerifiedEmail();
    }

    public function isSuperAdmin(): bool
    {
        return auth()->user()->role === 'super';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

}
