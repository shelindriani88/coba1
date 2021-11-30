<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class santri extends Model
{
  public $timestamps = false;

  protected $table = "santri";
  protected $primarykey = 'id_santri';
  protected $fillable = ['id_santri','id_ortu','id_kelas','nama_santri','alamat','jenis_kelamin','foto'];
  protected $appends =['persentase_total'];


  public function getFotoAttribute($value){
      if($value){
          return asset('/uploadFoto/'.$value);
      }
      return "https://via.placeholder.com/150";
  }

    public function hafalan(){
        return $this->hasMany('App\Hafalan','id_santri','id_santri');
    }

    public function getPersentase($surahId){
      $persentase = 0;
      $hafalan = $this->hafalan()->where('id_surah',$surahId)->get();
//      dd($hafalan);
      if(sizeof($hafalan)>0){
          $jumlah_hafalan = $hafalan->count();
          $jumlah_ayat  = Ayat::where('id_surah',$surahId)->count();
          $persentase = ($jumlah_hafalan *100)/$jumlah_ayat;
          $persentase = floor($persentase*1000)/1000;
      }
      return $persentase;
    }
    public function getPersentaseTotalAttribute(){
      $persentase = 0;
      $jumlah_hafalan = $this->hafalan()->count();
      if($jumlah_hafalan>0){
            $total_ayat  = Ayat::count();
            $persentase = ($jumlah_hafalan *100)/$total_ayat;
//            pembulatan
            $persentase = floor($persentase*1000)/1000;
        }
        return $persentase;
    }
}
