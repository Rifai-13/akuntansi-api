<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProfileInstruktur extends Model
{
    // protected $table = 'profile_instruktur';
    // // Menambahkan properti $fillable untuk kolom yang dapat diisi
    // protected $fillable = [
    //     'id', 'user_id', 'kelas_id'
    // ];

    // protected $keyType = 'string'; // UUID sebagai primary key
    // public $incrementing = false; // Primary key tidak auto-increment

    // protected static function booted()
    // {
    //     static::creating(function ($kelas) {
    //         if (empty($kelas->id)) {
    //             $kelas->id = (string) Str::uuid();
    //         }
    //     });
    // }

    // // Anda bisa menambahkan relasi jika diperlukan, misalnya relasi ke model User atau Kelas
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function kelas()
    // {
    //     return $this->belongsTo(Kelas::class);
    // }

    // public function kelas()
    // {
    //     return $this->belongsTo(Kelas::class, 'kelas_id');
    // }
    protected $table = 'profile_instruktur';
    // Menambahkan properti $fillable untuk kolom yang dapat diisi
    protected $fillable = [
        'id', 'user_id', 'kelas_id'
    ];

    protected $keyType = 'string'; // UUID sebagai primary key
    public $incrementing = false; // Primary key tidak auto-increment

    protected static function booted()
    {
        static::creating(function ($kelas) {
            if (empty($kelas->id)) {
                $kelas->id = (string) Str::uuid();
            }
        });
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
    

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

