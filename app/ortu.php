<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ortu extends Model
{
  public $timestamps = false;

  protected $table = "orangtua";
  protected $primarykey = 'id_ortu';
  protected $fillable = ['id_ortu','id_user','nama_orangtua','alamat','noHp','status','jenis_kelamin'];

  public function anak(){
      return $this->hasOne('App\santri','id_ortu','id_ortu');
  }
}
