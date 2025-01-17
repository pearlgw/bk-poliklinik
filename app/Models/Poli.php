<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poli extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];

    /**
     * Get all of the dokter for the Poli
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dokter(): HasMany
    {
        return $this->hasMany(Dokter::class, 'id_poli');
    }
    
    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'id_poli');
    }
}
