<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Ringkasan extends Model
{
    use HasUuids;
    protected $table = 'ringkasan';
    protected $guarded = ['id'];

}
