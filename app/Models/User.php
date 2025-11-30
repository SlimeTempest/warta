<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'role',
        'is_active',
        'reset_token',
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
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the instansi that this admin manages.
     */
    public function instansi()
    {
        return $this->belongsToMany(Instansi::class, 'admin_instansi');
    }

    /**
     * Get the laporan created by this user.
     */
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'user_id');
    }

    /**
     * Get the laporan managed by this admin.
     */
    public function laporanDikelola()
    {
        return $this->hasMany(Laporan::class, 'admin_id');
    }

    /**
     * Get the status history changes made by this user.
     */
    public function statusHistory()
    {
        return $this->hasMany(StatusHistory::class, 'changed_by');
    }
}
