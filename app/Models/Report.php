<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'judul',
        'isi_laporan',
        'nama_pelaku',
        'kelas_pelaku',
        'jurusan_pelaku',
        'reporter_name',
        'reporter_class',
        'reporter_major',
        'peran',
        'is_anonymous',
        'status',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
