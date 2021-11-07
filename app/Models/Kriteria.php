<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriteria';

    protected $fillable = [
        'nama',
        'bobot',
        'benefit',
        'ternormalisasi',
    ];

    public function subKriterias() {
        return $this->hasMany('App\Models\SubKriteria');
    }

    public function getNamaAttribute($value)
    {
        return strtoupper($value);
    }

    public function setNamaAttribute($value) {
        $this->attributes['nama'] = strtolower($value);
    }
}
