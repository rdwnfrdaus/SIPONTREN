<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama_kamar', 'gedung', 'kapasitas'])]
class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';

    public function santris()
    {
        return $this->hasMany(Santri::class, 'kamar_id');
    }
}
