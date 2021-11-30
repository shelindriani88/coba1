<?php

namespace App\Http\Controllers;

use Session;
use View;
use redirect;
use Input;
use Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Login;
use App\guru;
use App\users;
use App\ortu;
use App\nilai;
use App\kelas;
use App\santri;
use App\logNilai;
use App\logGuru;

class api extends Controller
{
  public function kodeotomatis($tabel,$field,$lebar=0,$awalan='')
  {

  $query = DB::table($tabel)->select(DB::raw('right('.$tabel.'.'.$field.',2) as kode'))
                    ->orderBy($field,'DESC')
                    ->limit(1);
     if($query->count() <> 0){
         $data = $query->first();
         $kode = intval($data->kode) + 1;
        }
        else{
         $kode = 1;
        }
        $kodemax = str_pad($kode, $lebar, "0", STR_PAD_LEFT);
        $kodejadi = $awalan.$kodemax;
        return $kodejadi;
    }

  public function getPengguna(Request $request)
  {
    $username = $request->username;
    $password = $request->password;
    if (!empty($request->username)) {
    $getPengguna = users::where('username','=',$username)->get()[0]->toArray();
    if (!empty($getPengguna['id_user'])) {
      $data = users::where('username','=',$username)->get()[0];
      if(Hash::check($password,$data->password)){
      $result = array('status' => 'sukses');
      foreach ($getPengguna as $key => $value) {
        $result[$key] = $value;
      }
      header('Content-Type: application/json');
      echo json_encode($result, JSON_PRETTY_PRINT);
    }else{
      header('Content-Type: application/json');
      echo json_encode(array('status' => 'GAGAL'));
    }

    }
  }else{
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'GAGAL'));
  }
  }

  public function getGuru(Request $request)
  {
    $getGuru = guru::where('id_user','=',$request->id)->get()[0]->toArray();
    if (!empty($getGuru['id_user'])) {
      $result = array('status' => 'sukses');
      foreach ($getGuru as $key => $value) {
        $result[$key] = $value;
      }
      header('Content-Type: application/json');
      echo json_encode($result, JSON_PRETTY_PRINT);
    }else{
      header('Content-Type: application/json');
      echo json_encode(array('status' => 'GAGAL'));
    }
  }

  public function getOrtu(Request $request)
  {
    $getOrtu = ortu::where('id_user','=',$request->id)->get()[0]->toArray();
    if (!empty($getOrtu['id_user'])) {
      $result = array('status' => 'sukses');
      foreach ($getOrtu as $key => $value) {
        $result[$key] = $value;
      }
      header('Content-Type: application/json');
      echo json_encode($result, JSON_PRETTY_PRINT);
    }else{
      header('Content-Type: application/json');
      echo json_encode(array('status' => 'GAGAL'));
    }
  }

  public function inputNilai(Request $request)
  {
    $kode = $this->kodeotomatis('penilaian','id_nilai',3,'NILAI-');
    $id_santri = $request->id_santri;
    $id_guru = $request->id_guru;
    $persentase = $request->persentase;

    $getnilai = @nilai::where('id_santri','=',$id_santri)->first();
    if(empty(@$getnilai['id_santri'])){

          $nilai = nilai::insert(['id_nilai' => $kode, 'id_santri' => $id_santri, 'id_guru' => $id_guru, 'persentase' => $persentase]);
          if ($nilai) {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'sukses'));
        }else {
          header('Content-Type: application/json');
          echo json_encode(array('status' => 'GAGAL'));
        }

    }else{
      $nilai = nilai::where('id_santri','=',$getnilai['id_santri'])->update(['persentase' => $persentase]);
      if ($nilai) {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'sukses'));
    }else {
      header('Content-Type: application/json');
      echo json_encode(array('status' => 'GAGAL'));
    }
    }
  }

  public function logNilaiCreate(Request $request)
  {
    // $kode = $this->kodeotomatis('log_penilaian','id_logNilai',3,'GUR-');
    $data = array(
      'id_nilai' => $request->id_nilai,
      'id_ayat' => $request->id_ayat,
      'id_surah' => $request->id_surah,
      'jml_baris' => $request->jml_baris,
      'nilai' => $request->nilai,
      'log_activity' => $request->log_activity,
      'tanggal' => $request->tanggal
    );

    $logNilai = logNilai::insert($data);
    if ($logNilai) {
      header('Content-Type: application/json');
      echo json_encode(array('status' => 'sukses'));
  }else {
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'GAGAL'));
  }
}

  public function logNilaiUpdate(Request $request, $id_nilai)
    {
          $getlogNilai = logNilai::where('id_nilai','=',$id_nilai)->get()[0];

          $log_activity = $request->log_activity;
          $tanggal = $request->tanggal;

        $updateLognilai = logNilai::where('id_nilai','=',$id_nilai)->update(['log_activity' => $log_activity, 'tanggal' => $tanggal]);
        if ($logNilai) {
          header('Content-Type: application/json');
          echo json_encode(array('status' => 'sukses'));
      }else {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'GAGAL'));
      }

    }

    public function logNilaiDelete(Request $request, $id_nilai)
      {
        $hapusLogNilai = logNilai::where('id_nilai','=',$id_nilai)->delete()[0];
        if ($hapusLogNilai) {
          header('Content-Type: application/json');
          echo json_encode(array('status' => 'sukses'));
      }else {
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'GAGAL'));
      }
      }

      public function logNilaiget($id_nilai)
        {
          $getnilai = logNilai::where('id_nilai','=',$id_nilai)->get();
          header('Content-Type: application/json');
          echo json_encode(array('Status' => 'Berhasil','data' => $getnilai), JSON_PRETTY_PRINT);
        }

        public function logGuruCreate(Request $request)
        {
          // $kode = $this->kodeotomatis('log_penilaian','id_logNilai',3,'GUR-');
          $id_guru = $request->id_guru;
          $log_activity = $request->log_activity;
          $tanggal = $request->tanggal;

          $logGuru = log_penilaian::insert(['id_logGuru' => null, 'id_guru' => $id_guru, 'log_activity' => $log_activity, 'tanggal' => $tanggal]);
          if ($logGuru) {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'sukses'));
        }else {
          header('Content-Type: application/json');
          echo json_encode(array('status' => 'GAGAL'));
        }
      }

      public function logGuruUpdate(Request $request, $id_guru)
        {
              $getlogGuru = logGuru::where('id_guru','=',$id_guru)->get()[0];

              $log_activity = $request->log_activity;
              $tanggal = $request->tanggal;

            $updateLognilai = logGuru::where('id_guru','=',$id_guru)->update(['log_activity' => $log_activity, 'tanggal' => $tanggal]);
            if ($updateLognilai) {
              header('Content-Type: application/json');
              echo json_encode(array('status' => 'sukses'));
          }else {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'GAGAL'));
          }

        }

        public function logGuruDelete(Request $request, $id_guru)
          {
            $hapusLogGuru = logNilai::where('id_guru','=',$id_guru)->delete()[0];
            if ($hapusLogGuru) {
              header('Content-Type: application/json');
              echo json_encode(array('status' => 'sukses'));
          }else {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'GAGAL'));
          }
          }

          public function logGuruget($id_guru)
            {
              $getGuru = logGuru::where('id_guru','=',$id_guru)->get();
              header('Content-Type: application/json');
              echo json_encode(array('Status' => 'Berhasil','data' => $getGuru), JSON_PRETTY_PRINT);
            }

        public function changePass(Request $request, $id_user)
        {
          $passLama = $request->passLama;
          $passBaru = bcrypt($request->passBaru);
          $changePass = Login::where('id_user','=',$id_user)->first();
          if($changePass){
          if(Hash::check($passLama,$changePass->password)){
            $updatePass = users::where('id_user', '=', $id_user)->update(['password' => $passBaru]);
            if ($updatePass) {
              header('Content-Type: application/json');
              echo json_encode(array('status' => 'sukses'));
          }else {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'GAGAL'));
          }
        }else{
          header('Content-Type: application/json');
          echo json_encode(array('status' => 'GAGAL'));
        }
          }

        }

        public function forgotPass(Request $request, $id_user)
        {
          $passBaru = bcrypt($request->passBaru);
          $changePass = Login::where('id_user','=',$id_user)->first();
          if($changePass){
            $updatePass = users::where('id_user', '=', $id_user)->update(['password' => $passBaru]);
            if ($updatePass) {
              header('Content-Type: application/json');
              echo json_encode(array('status' => 'sukses'));
          }else {
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'GAGAL'));
          }
          }

        }
}
