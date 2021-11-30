<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
  public $timestamps = false;

  protected $table = "penilaian";
  protected $primarykey = 'id_nilai';
  protected $fillable = ['id_santri','id_guru','persentase'];
}
