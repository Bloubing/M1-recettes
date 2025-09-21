<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{

    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    /**
     * Get the user recipes'
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function reportcomments()
    {
        return $this->hasMany(ReportComment::class);
    }

    public function favorite()
    {
        return $this->hasMany(Report::class);
    }

    public function isAdmin()
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->name == "admin") {
                return true;
            }

        }
        return false;
    }

    public function isModerator()
    {
        if ($this->isAdmin()) {
            return true;
        }

        foreach ($this->roles()->get() as $role) {
            if ($role->name == 'moderator') {
                return true;
            }
        }
        return false;
    }

    // Renvoie vrai si l'user s'est connecté avec Socialite (GitHub)
    public function isSocialite()
    {
        return !is_null($this->provider);
    }

    public function wants_news()
    {
        return Newsletter::where('email', $this->email)->exists();
    }
}
