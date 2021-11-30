<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    protected $table = "surah";
    protected $primaryKey = "id_surah";
    protected $fillable =[
        'arti','asma','audio','ayat','keterangan','nama','nomor','rukuk','type','urut'
    ];

    public function ayat(){
        return $this->hasMany('App\Ayat','id_surah','id_surah');
    }
}
