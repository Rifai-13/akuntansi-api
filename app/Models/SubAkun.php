<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubAkun extends Model
{
    use HasUuids;
    protected $table = 'sub_akun';
    protected $guarded = ['id'];

    /**
     * Get the akun that owns the SubAkun
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function akun(): BelongsTo
    {
        return $this->belongsTo(Akun::class, 'akun_id', 'id');
    }

    /**
     * Get the perusahaan that owns the SubAkun
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'id');
    }
}
