<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Report;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'nama_pelaku' => 'required_without:unknown_perpetrator|string|max:255|nullable',
            'kelas_pelaku' => 'required_without:unknown_perpetrator|string|max:255|nullable',
            'jurusan_pelaku' => 'required_without:unknown_perpetrator|string|max:255|nullable',
            'unknown_perpetrator' => 'nullable|boolean',
            'peran' => 'required|in:saksi,korban',
            'is_anonymous' => 'nullable|boolean',
            'reporter_name' => 'required_unless:is_anonymous,1|string|max:255|nullable',
            'reporter_class' => 'required_unless:is_anonymous,1|string|max:255|nullable',
            'reporter_major' => 'required_unless:is_anonymous,1|string|max:255|nullable',
            'image' => Report::imageValidationRules()['image'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul laporan wajib diisi.',
            'isi_laporan.required' => 'Isi laporan wajib diisi.',
            'nama_pelaku.required_without' => 'Nama pelaku wajib diisi jika tidak mengetahui pelaku tidak dipilih.',
            'kelas_pelaku.required_without' => 'Kelas pelaku wajib diisi jika tidak mengetahui pelaku tidak dipilih.',
            'jurusan_pelaku.required_without' => 'Jurusan pelaku wajib diisi jika tidak mengetahui pelaku tidak dipilih.',
            'peran.required' => 'Peran wajib dipilih.',
            'peran.in' => 'Peran harus saksi atau korban.',
            'reporter_name.required_unless' => 'Nama pelapor wajib diisi jika tidak anonim.',
            'reporter_class.required_unless' => 'Kelas pelapor wajib diisi jika tidak anonim.',
            'reporter_major.required_unless' => 'Jurusan pelapor wajib diisi jika tidak anonim.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus: jpeg, png, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 5MB.',
            'image.dimensions' => 'Resolusi gambar minimal 100x100 piksel.',
        ];
    }
}
