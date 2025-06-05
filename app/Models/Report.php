<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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
        'status',
        'handled_by_guru_id',
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

    public function guru()
    {
        return $this->belongsTo(\App\Models\Guru::class, 'guru_id', 'id_guru');
    }

    public function handlingGuru()
    {
        return $this->belongsTo(\App\Models\Guru::class, 'handled_by_guru_id', 'id_guru');
    }

    public function getReporterType()
    {
        if ($this->guru_id) {
            return 'Guru';
        }
        return 'Siswa';
    }

    public function getReporterName()
    {
        if ($this->is_anonymous) {
            return 'Anonim';
        }

        if ($this->guru_id) {
            return $this->guru->username ?? 'Guru';
        }

        return $this->user->username ?? 'Siswa';
    }

    /**
     * Validation rules for the report image.
     *
     * @return array
     */
    public static function imageValidationRules()
    {
        return [
            'image' => [
                'nullable',                    // Field is optional
                'image',                      // Must be an image file
                'mimes:jpeg,png,gif',         // Allowed formats
                'max:5120',                   // Max 5MB (5120 KB)
                'dimensions:min_width=100,min_height=100'  // Minimum dimensions
            ]
        ];
    }

    /**
     * Validate an image file for this report.
     *
     * @param mixed $image The uploaded image file
     * @throws ValidationException
     * @return bool
     */
    public static function validateImage($image)
    {
        $validator = Validator::make(
            ['image' => $image],
            self::imageValidationRules()
        );

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        return true;
    }
}
