<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Akun extends Model
{
    // Menentukan nama tabel (opsional)
    protected $table = 'akun';

    // Kolom yang dapat diisi
    protected $fillable = ['kode', 'nama', 'status', 'kategori_id'];

    // Mengatur agar UUID digunakan sebagai primary key dan tidak auto-increment
    protected $keyType = 'string';
    public $incrementing = false;

    // Boot untuk UUID
    protected static function booted()
    {
        static::creating(function ($akun) {
            if (empty($akun->id)) {
                $akun->id = (string) Str::uuid();
            }
        });
    }

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
