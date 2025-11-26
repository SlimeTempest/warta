<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instansi extends Model
{
    protected $table = 'instansi';

    protected $fillable = [
        'nama',
        'alamat',
        'status',
    ];

    /**
     * Get the admins that manage this instansi.
     */
    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'admin_instansi');
    }

    /**
     * Get the laporan for this instansi.
     */
    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class);
    }
}
