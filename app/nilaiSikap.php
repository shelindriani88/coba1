<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nilaiSikap extends Model
{
  public $timestamps = false;

  protected $table = "nilai_sikap";
  protected $primarykey = 'id_sikap';
  protected $fillable = ['id_santri','sikap'];
}
