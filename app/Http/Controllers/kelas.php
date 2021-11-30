<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kelas extends Controller
{
  public $timestamps = false;

  protected $table = "kelas";
  protected $primarykey = 'id_kelas';
  protected $fillable = ['id_guru','nama_kelas'];
}
