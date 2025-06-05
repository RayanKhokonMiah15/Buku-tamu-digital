<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_guru';
    protected $table = 'gurus'; // Pastikan nama tabel sesuai
    protected $fillable = ['username', 'password'];

    // Jika ingin menggunakan hashing password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'guru_id', 'id_guru');
    }
}
