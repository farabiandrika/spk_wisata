<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'keterangan',
        'nilai',
        'kriteria_id',
    ];

    public function kriteria() {
        return $this->belongsTo('App\Models\Kriteria');
    }
}
