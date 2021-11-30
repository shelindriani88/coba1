<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logGuru extends Model
{
  public $timestamps = false;

  protected $table = "log_guru";
  protected $primarykey = 'id_logGuru';
  protected $fillable = ['id_guru','log_activity','tanggal'];
}
