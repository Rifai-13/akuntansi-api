<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Krs;



class Kelas extends Model
{

    // protected $table = 'kelas'; // Nama tabel
    // protected $fillable = ['nama', 'angkatan']; // Kolom yang bisa diisi
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
    //     public function getRouteKeyName()
    // {
    //     return 'id';
    // }
    protected $table = 'kelas'; // Nama tabel
    protected $fillable = ['nama', 'angkatan']; // Kolom yang bisa diisi
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
        public function getRouteKeyName()
    {
        return 'id';
    }

    public function profileInstruktur()
    {
        return $this->hasMany(ProfileInstruktur::class, 'kelas_id', 'id');
    }
    

    // Relasi ke KRS (tabel yang berisi anggota kelas)
    public function krs()
    {
        return $this->hasMany(Krs::class, 'kelas_id');
    }
}

