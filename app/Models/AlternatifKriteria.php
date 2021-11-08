<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifKriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'kriteria_id',
        'alternatif_id',
        'nilai',
    ];

    public function kriteria() {
        return $this->belongsTo('App\Models\Kriteria');
    }

    public function alternatif() {
        return $this->belongsTo('App\Models\Alternatif');
    }
}
