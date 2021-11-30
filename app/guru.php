<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
  public $timestamps = false;

  protected $table = "guru";
  protected $primarykey = 'id_guru';
  protected $fillable = ['id_user','nama_guru','alamat'];
}
