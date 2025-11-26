<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'lokasi',
        'user_id',
        'instansi_id',
        'admin_id',
        'status',
        'catatan_admin',
        'bukti_files',
    ];

    protected $casts = [
        'bukti_files' => 'array',
    ];

    /**
     * Get the user that created this laporan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the instansi for this laporan.
     */
    public function instansi(): BelongsTo
    {
        return $this->belongsTo(Instansi::class);
    }

    /**
     * Get the admin managing this laporan.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get the status history for this laporan.
     */
    public function statusHistory(): HasMany
    {
        return $this->hasMany(StatusHistory::class);
    }
}
