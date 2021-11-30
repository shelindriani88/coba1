<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
  public $timestamps = false;

  protected $table = "kelas";
  protected $primarykey = 'id_kelas';
  protected $fillable = ['id_guru','nama_kelas'];
}
