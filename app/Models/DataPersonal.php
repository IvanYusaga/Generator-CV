<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataPersonal extends Model
{
    use HasFactory;

    protected $table = 'data_personal';

    protected $fillable = [
        'user_id',
        'nama',
        'nomor_telepon',
        'email',
        'linkedin',
        'kota',
        'provinsi',
        'negara',
        'foto',
    ];

    /**
     * Relasi ke model User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
