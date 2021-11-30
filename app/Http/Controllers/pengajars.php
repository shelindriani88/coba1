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
use App\pengajar;
use App\users;
use App\ortu;
use App\kelas;
use App\santri;
use App\nilai;
use App\logNilai;
use App\mapel;
use App\nilaiSikap;
use App\penilaianMapel;

class pengajars extends Controller
{
  public function index()
  {
    session_start();
    if(!Session::get('username')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }else{
          if(Session::get('level') == 1){
            return redirect('pageAdmin');
          }elseif(Session::get('level') == 4){
            $pengajar = pengajar::where('id_user', '=', Session::get('id_user'))->get()[0];
            return view('pengajar/dashboardPengajar',compact('pengajar'));
          }
        }

  }

  // public function mapel()
  // {
  //   session_start();
  //   if(!Session::get('username')){
  //           return redirect('login')->with('alert','Kamu harus login dulu');
  //       }else{
  //         if(Session::get('level') == 1){
  //           return redirect('pageAdmin');
  //         }
  //       }
  //     $dataMapel = mapel::orderBy('id_mapel','DESC')->get();
  //
  //     return view('pengajar/mapel', compact('dataMapel'));
  // }
  //
  // public function inputMapel()
  // {
  //   session_start();
  //   if(!Session::get('username')){
  //           return redirect('login')->with('alert','Kamu harus login dulu');
  //       }else{
  //         if(Session::get('level') == 1){
  //           return redirect('pageAdmin');
  //         }
  //       }
  //
  //     return view('pengajar/inputMapel');
  // }
  //
  // public function postMapel(Request $request)
  // {
  //   session_start();
  //   if(!Session::get('username')){
  //           return redirect('login')->with('alert','Kamu harus login dulu');
  //       }else{
  //         if(Session::get('level') == 1){
  //           return redirect('pageAdmin');
  //         }
  //       }
  //       $kode = $this->kodeotomatis('mapel','id_mapel',3,'MPL-');
  //       $namaMapel = $request->nama_mapel;
  //
  //       $inputMapel = mapel::insert(['id_mapel' => $kode, 'nama_mapel' => $namaMapel]);
  //       if ($inputMapel) {
  //         return redirect('/inputMapel')->with('alert-success','Input Santri Berhasil');
  //     }else {
  //       return redirect('/inputMapel')->with('alert', 'Input Santri Gagal');
  //     }
  // }
  //
  // public function hapusMapel($id_mapel)
  // {
  //   session_start();
  //   if(!Session::get('username')){
  //           return redirect('login')->with('alert','Kamu harus login dulu');
  //       }else{
  //         if(Session::get('level') == 1){
  //           return redirect('pageAdmin');
  //         }
  //       }
  //    $hapusMapel = mapel::where('id_mapel','=',$id_mapel)->delete()[0];
  //    return redirect('/dataMapel');
  // }
  //
  // public function editMapel($id_mapel)
  // {
  //   session_start();
  //   if(!Session::get('username')){
  //           return redirect('login')->with('alert','Kamu harus login dulu');
  //       }else{
  //         if(Session::get('level') == 1){
  //           return redirect('pageAdmin');
  //         }
  //       }
  //       $editMapel = mapel::where('id_mapel','=',$id_mapel)->get()[0];
  //
  //       return view('pengajar/editMapel', compact('editMapel'));
  // }
  //
  // public function editnyaMapel(Request $request, $id_mapel)
  // {
  //   session_start();
  //   if(!Session::get('username')){
  //           return redirect('login')->with('alert','Kamu harus login dulu');
  //       }else{
  //         if(Session::get('level') == 1){
  //           return redirect('pageAdmin');
  //         }
  //       }
  //       $nama_mapel = $request->nama_mapel;
  //
  //
  //       $gantiMapel = mapel::where('id_mapel','=',$id_mapel)->update(['nama_mapel' => $nama_mapel]);
  //       if ($gantiMapel) {
  //       return redirect("/editDataMapel/".$id_mapel)->with('alert-success','Data Berhasil Diupdate');
  //     }else{
  //       return redirect("/editDataMapel/".$id_mapel)->with('alert','Data Gagal Diupdate');
  //     }
  // }

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

  public function santriKelas()
  {
    session_start();
    if(!Session::get('username')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }else{
          if(Session::get('level') == 1){
            return redirect('pageAdmin');
          }
        }
           $pengajar = pengajar::where('id_user', '=', Session::get('id_user'))->get()[0]['id_pengajar'];
           $kelas = kelas::where('id_pengajar', '=', $pengajar)->get()[0];
           $santriKelas = santri::where('id_kelas', '=', $kelas['id_kelas'])->get();
            return view('pengajar/santriKelas', compact(['santriKelas','kelas']));

  }

  public function beriNilai($id_santri)
  {
    session_start();
    if(!Session::get('username')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }else{
          if(Session::get('level') == 1){
            return redirect('pageAdmin');
          }
        }
           $mapel = mapel::get();
            return view('pengajar/penilaian', compact(['mapel','id_santri']));

  }

  public function postNilai(Request $request, $id_santri)
  {
    foreach ($request->id_mapel as $key => $idmapel) {
      $ceknilai = @penilaianMapel::where('id_mapel','=',$idmapel)->where('id_santri','=',$id_santri)->get()[0];
      $kode = $this->kodeotomatis('penilaian_mapel','id_nilaiMapel',3,'NMP-');
      $keterangan = $request->keterangan[$key];
      $nilai = $request->nilai[$key];
      $tanggal = date('Y-m-d');
      $semester = $request->semester;
      if ($ceknilai['id_mapel'] == $idmapel && $ceknilai['id_santri'] == $id_santri && $ceknilai['semester'] == $semester) {
        penilaianMapel::where('id_mapel','=',$idmapel)->where('id_santri','=',$id_santri)->update(['keterangan' => $keterangan, 'nilai' => $nilai, 'tanggal' => $tanggal, 'semester' => $semester]);
      }else{
        penilaianMapel::insert(['id_nilaiMapel' => $kode, 'id_santri' => $id_santri, 'id_mapel' => $idmapel, 'keterangan' => $keterangan, 'nilai' => $nilai, 'tanggal' => $tanggal, 'semester' => $semester]);
      }
    }
    return redirect("/beriNilai/".$id_santri)->with('alert-success','Data Berhasil Tambahkan');

  }

  public function reportNilai($id_santri, $semester = '')
  {
    session_start();
    if(!Session::get('username')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }else{
          if(Session::get('level') == 1){
            return redirect('pageAdmin');
          }
        }
            $mapel = mapel::get();
            $santri = santri::where('id_santri', '=', $id_santri)->get()[0];
            return view('pengajar/report', compact(['santri','mapel']));

  }

  public function getnilaiS($id_santri, $semester)
  {
    session_start();
    if(!Session::get('username')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }else{
          if(Session::get('level') == 1){
            return redirect('pageAdmin');
          }
        }
            $nilaiMapel = penilaianMapel::where('semester','=',$semester)->where('id_santri','=',$id_santri)->get();
            return $nilaiMapel;

  }


      public function inputSikap()
       {
         session_start();
         if(!Session::get('username')){
                 return redirect('login')->with('alert','Kamu harus login dulu');
             }
             $dataSantri = santri::orderBy('id_santri','DESC')->get();
             $dataSikap = nilaiSikap::orderBy('id_sikap','DESC')->get();
         return view('pengajar/inputSikapSantri', compact('dataSantri', 'dataSikap'));
       }

     public function postSikap(Request $request)
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
           $kode = $this->kodeotomatis('nilai_sikap','id_sikap',3,'SKP-');
           $santri = $request->id_santri;
           $sikap = $request->sikap;

           $sikap = nilaiSikap::insert(['id_sikap' => $kode, 'id_santri' => $santri, 'sikap' => $sikap]);
           // dd($sikap);
           if ($sikap) {
             return redirect('/inputSikap')->with('alert-success','Input Sikap Berhasil');
         }else {
           return redirect('/inputSikap')->with('alert', 'Input Sikap Gagal');
         }
     }

     public function detailNilaiSantris($id_santri, $semester = '')
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
           else{
             @$detailSantri = santri::where('id_santri', '=', $id_santri)->get()[0];
             @$dataOrtu = ortu::where('id_ortu', '=', $detailSantri->id_ortu)->get()[0];
             @$nilaiSantri = nilai::where('id_santri', '=', $id_santri)->get()[0];
             @$mapel = mapel::get();
             @$logNilaiSantri = logNilai::where('id_nilai', '=', @$nilaiSantri->id_nilai)->get();
             return view('pengajar/detailNilaiSantris', compact(['detailSantri','dataOrtu','nilaiSantri','logNilaiSantri', 'mapel']));
           }
     }

     public function tambahFotos(Request $request, $id_santri)
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
           else{

             $foto = $request->file('foto');
             $namefile = $foto->getClientOriginalName();
             $foto->move('../public/uploadFoto/',$namefile);

             $gantiFoto = santri::where('id_santri','=',$id_santri)->update(['foto' => $namefile]);
             if ($gantiFoto) {
             return redirect("/detailNilaiSantris/".$id_santri)->with('alert-success','Data Berhasil Diupdate');
           }else{
             return redirect("/detailNilaiSantris/".$id_santri)->with('alert','Data Gagal Diupdate');
           }
          }
     }

}
