<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatif';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar'
    ];

    public function getNamaAttribute($value)
    {
        return ucfirst($value);
    }

    public function setNamaAttribute($value) {
        $this->attributes['nama'] = strtolower($value);
    }

    public function alternatifKriterias()
    {
        return $this->hasMany('App\Models\AlternatifKriteria');
    }
}
