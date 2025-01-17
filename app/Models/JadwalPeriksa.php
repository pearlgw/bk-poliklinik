<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalPeriksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    /**
     * Get the dokter that owns the JadwalPeriksa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_dokter');
    }

    /**
     * Get all of the daftarPoli for the JadwalPeriksa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function daftarPoli(): HasMany
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal', 'id');
    }
}
