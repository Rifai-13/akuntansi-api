<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perusahaan extends Model
{
    //
    use HasUuids;
    protected $table = 'perusahaan';
    protected $guarded = ['id'];

    /**
     * Get the kategori that owns the Perusahaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    /**
     * Get the krs that owns the Perusahaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function krs(): BelongsTo
    {
        return $this->belongsTo(Krs::class, 'krs_id', 'id');
    }
}
