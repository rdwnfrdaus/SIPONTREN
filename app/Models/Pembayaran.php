<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'santri_id',
    'bulan',
    'tahun',
    'jumlah_tagihan',
    'jumlah_bayar',
    'tanggal_bayar',
    'status',
    'keterangan'
])]
class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected function casts(): array
    {
        return [
            'tanggal_bayar' => 'datetime',
            'jumlah_tagihan' => 'decimal:2',
            'jumlah_bayar' => 'decimal:2',
        ];
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }
}
