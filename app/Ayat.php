<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ayat extends Model
{
    protected $table= "ayat";
    protected $primaryKey = "id_ayat";
    protected $fillable = [
      'ar','id','nomor','tr','ayat_id'
    ];

}
