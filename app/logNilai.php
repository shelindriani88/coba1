<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logNilai extends Model
{
  public $timestamps = false;

  protected $table = "log_penilaian";
  protected $primarykey = 'id_logNilai';
  protected $fillable = ['id_nilai','log_activity','tanggal'];
}
