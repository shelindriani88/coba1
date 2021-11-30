<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
  public $timestamps = false;
  protected $table = "users";
  protected $primarykey = 'id_user';
  protected $hidden = ['password'];
  protected $fillable = ['username','password','level'];
}
