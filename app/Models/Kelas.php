<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama_kelas', 'tingkat', 'wali_kelas_id'])]
class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

    public function santris()
    {
        return $this->hasMany(Santri::class, 'kelas_id');
    }
}
