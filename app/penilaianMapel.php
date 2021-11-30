<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penilaianMapel extends Model
{
  public $timestamps = false;

  protected $table = "penilaian_mapel";
  protected $primarykey = 'id_nilaiMapel';
  protected $fillable = ['id_santri','id_mapel','keterangan','nilai', 'tanggal','semester'];
}
