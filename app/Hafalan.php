<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hafalan extends Model
{
    protected $table = "hafalan";
    protected $fillable = [
        "id_santri","id_ayat","id_surah","approved_by"
    ];

    public function surah(){
        return $this->hasMany('App\Surah','id_surah','id_surah');
    }
}
