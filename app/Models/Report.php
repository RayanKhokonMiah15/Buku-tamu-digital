<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model buat tabel "reports" di database
class Report extends Model
{
    // Daftar field yang bisa diisi langsung (mass assignment)
    protected $fillable = [
        'judul',              // judul laporan
        'isi_laporan',        // isi/detail laporan
        'nama_pelaku',        // nama pelaku yang dilaporkan
        'kelas_pelaku',       // kelas pelaku
        'jurusan_pelaku',     // jurusan pelaku
        'reporter_name',      // nama pelapor (bisa null kalau anonim)
        'reporter_class',     // kelas pelapor
        'reporter_major',     // jurusan pelapor
        'peran',              // peran pelapor (saksi/korban)
        'image_path', // <- tambahkan ini
        'is_anonymous',       // true kalau pelapor pilih anonim
        'status',             // status laporan (misalnya: pending, ditinjau, selesai)
    ];

    // Auto-cast 'is_anonymous' ke tipe boolean pas ambil dari DB
    protected $casts = [
        'is_anonymous' => 'boolean',
    ];

    // Relasi: laporan ini dimiliki oleh satu user (yang bikin laporan)
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
