<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The table associated with the model.
     */
    protected $table = 'tb_pengguna';

    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'id_pengguna';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'divisi',
        'nomor_telp',
        'nip',
        'jenis_kelamin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get messages received by this user.
     */
    public function pesanDiterima()
    {
        return $this->hasMany(Pesan::class, 'id_penerima', 'id_pengguna');
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is teacher.
     */
    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }
}
