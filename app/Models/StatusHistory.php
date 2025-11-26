<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatusHistory extends Model
{
    protected $table = 'status_history';

    protected $fillable = [
        'laporan_id',
        'status_lama',
        'status_baru',
        'catatan',
        'changed_by',
    ];

    /**
     * Get the laporan for this status history.
     */
    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class);
    }

    /**
     * Get the user that changed the status.
     */
    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
