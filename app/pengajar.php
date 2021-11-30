<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengajar extends Model
{
  public $timestamps = false;

  protected $table = "pengajar";
  protected $primarykey = 'id_pengajar';
  protected $fillable = ['id_pengajar','id_user','nama_pengajar','alamat'];
}
