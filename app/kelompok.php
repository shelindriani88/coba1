<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelompok extends Model
{
  public $timestamps = false;

  protected $table = "kelompok";
  protected $primarykey = 'id_kelompok';
  protected $fillable = ['nama_kelompok', 'id_guru'];
}
