<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
  public $timestamps = false;

  protected $table = "mapel";
  protected $primarykey = 'id_mapel';
  protected $fillable = ['nama_mapel'];
}
