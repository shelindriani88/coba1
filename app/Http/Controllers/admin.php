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
use App\nilaiSikap;
use App\kelompok;
use App\penilaianMapel;
use App\mapel;

class admin extends Controller
{
    public function __construct()
    {
        // $this->user = Auth::user();
      $this->middleware('login', ['only'=>['user']]);
    }

    public function admin()
    {
      session_start();
    if(!Session::get('username')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }
        else{
          if(Session::get('level') == 1){
            return view('admin/dashboard', ['username'=>Session::get('username')]);
          }elseif(Session::get('level') == 4){
            return redirect('pagePengajar');
          }
        }
    }

    public function getDashboard()
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
       @$dataKelas = kelas::orderBy('id_kelas','DESC')->get()[0];
       @$dataSantri = santri::orderBy('id_santri','DESC')->get()[0];
       return view('admin/dashboard', compact('dataKelas', 'dataSantri'));
     }

    public function login()
    {
      session_start();
      if(Session::get('username')){
          if(Session::get('level') == 1){
            return redirect('pageAdmin');
          }elseif(Session::get('level') == 4){
            return redirect('pagePengajar');
          }

          }
          else{
              return view('admin/login');
          }
    }

    public function signin(Request $request)
    {
      session_start();
      $username = $request->username;
      $password = $request->password;
      // dd($request);
      // dd($data);
      $data = Login::where('username','=',$username)->first();
          if($data){
          if(Hash::check($password,$data->password)){
              if ($data->level===1) {
                Session::put('username',$data->username);
                Session::put('level',$data->level);
                Session::put('id_user',$data->id_user);
                Session::put('login',TRUE);
                return redirect('pageAdmin');
              }elseif ($data->level===4) {
                Session::put('username',$data->username);
                Session::put('level',$data->level);
                Session::put('id_user',$data->id_user);
                Session::put('login',TRUE);
                return redirect('pagePengajar');
              }else{
                  return redirect('/login')->with('alert','Password atau Email, Salah !');
              }
      }
        }else{
            return redirect('/login')->with('alert','Password atau Email, Salah !');
        }
          }

        //   public function csvToArray($file) {
        //   if (($handle = fopen($file, 'r')) !== FALSE) {
        //     $i = 0;
        //     while (($lineArray = fgetcsv($handle, 1000, ",")) !== FALSE) {
        //       for ($j = 0; $j < count($lineArray); $j++) {
        //         $arr[$i][$j] = $lineArray[$j];
        //       }
        //       $i++;
        //     }
        //     fclose($handle);
        //   }
        //   return $arr;
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

      public function logout()
      {
       Session::flush();
       return redirect('login')->with('alert','Kamu sudah logout');
      }

   // public function pilihPengguna()
   //  {
   //    session_start();
   //    if(!Session::get('username')){
   //            return redirect('login')->with('alert','Kamu harus login dulu');
   //        }
   //    return view('admin/inputPengguna');
   //  }

    public function guru()
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
       return view('admin/inputGuru');
     }

    public function inputGuru(Request $request)
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
      $kode = $this->kodeotomatis('guru','id_guru',3,'GUR-');
      $username = $request->username;
      $nama_guru = $request->nama_guru;
      $password = bcrypt($request->password);
      $jenis_kelamin = $request->jenis_kelamin;
      $tempat_lahir = $request->tempat_lahir;
      $tanggal_lahir = $request->tanggal_lahir;
      $alamat = $request->alamat;
      $noHp = $request->noHp;

      $user = users::insert(['id_user' => null, 'username' => $username, 'password' => $password, 'level' => '2']);
      if ($user) {
        $select = users::where('username', '=', $username)->get()[0];
        $Guruser = guru::insert(['id_guru' => $kode, 'id_user' => $select['id_user'], 'nama_guru' => $nama_guru, 'jenis_kelamin' => $jenis_kelamin, 'tempat_lahir' => $tempat_lahir, 'tanggal_lahir' => $tanggal_lahir, 'alamat' => $alamat, 'noHp' => $noHp]);
      return redirect('/inputGuru')->with('alert-success','Input Pengguna Berhasil');
    }else {
      return redirect('/inputGuru')->with('alert', 'Input Pengguna Gagal');
    }
  }

    public function dataGuru()
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
          $dataGuru = guru::orderBy('id_guru','DESC')->get();

          return view('admin/dataGuru', compact('dataGuru'));
      }

    public function editGuru($id_guru)
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
          $editGuru = guru::where('id_guru','=',$id_guru)->get()[0];
          return view('admin/editGuru', compact('editGuru'));
    }

    public function editnyaGuru(Request $request, $id_guru)
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
          $nama_guru = $request->nama_guru;
          $jenis_kelamin = $request->jenis_kelamin;
          $tempat_lahir = $request->tempat_lahir;
          $tanggal_lahir = $request->tanggal_lahir;
          $alamat = $request->alamat;

          $gantiGuru = guru::where('id_guru','=',$id_guru)->update(['nama_guru' => $nama_guru, 'jenis_kelamin' => $jenis_kelamin, 'tempat_lahir' => $tempat_lahir, 'tanggal_lahir' => $tanggal_lahir, 'alamat' => $alamat]);
          if ($gantiGuru) {
          return redirect("/editDataGuru/".$id_guru)->with('alert-success','Data Berhasil Diupdate');
        }else{
          return redirect("/editDataGuru/".$id_guru)->with('alert','Data Gagal Diupdate');
        }
    }

    public function hapusGuru($id_guru)
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
       $hapusGuru = guru::where('id_guru','=',$id_guru)->delete()[0];
       return redirect('/dataGuru');
    }

    public function ortu()
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
       return view('admin/inputOrtu');
     }

    public function inputOrtu(Request $request)
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
          $kode = $this->kodeotomatis('orangtua','id_ortu',3,'ORTU-');
          $username = $request->username;
          $nama_ortu = $request->nama_orangtua;
          $password = bcrypt($request->password);
          $alamat = $request->alamat;
          $noHp = $request->noHp;
          $status = $request->status;
          $jk = $request->jenis_kelamin;

          $user = users::insert(['id_user' => null, 'username' => $username, 'password' => $password, 'level' => '2']);
          if ($user) {
            $select1 = users::where('username', '=', $username)->get()[0];
            $ortu = ortu::insert(['id_ortu' => $kode, 'id_user' => $select1['id_user'], 'nama_orangtua' => $nama_ortu, 'alamat' => $alamat, 'noHp' => $noHp, 'status' => $status, 'jenis_kelamin' => $jk]);
          return redirect('/inputOrtu')->with('alert-success','Input Pengguna Berhasil');
        }else {
          return redirect('/inputOrtu')->with('alert', 'Input Pengguna Gagal');
        }
    }

    public function dataOrtu()
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
          $dataOrtu = ortu::orderBy('id_ortu','DESC')->get();

          return view('admin/dataOrtu', compact('dataOrtu'));
      }

      public function editOrtu($id_ortu)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
            $editOrtu = ortu::where('id_ortu','=',$id_ortu)->get()[0];
            return view('admin/editOrtu', compact('editOrtu'));
      }

      public function editnyaOrtu(Request $request, $id_ortu)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
            $nama_orangtua = $request->nama_orangtua;
            $alamat = $request->alamat;
            $noHp = $request->noHp;
            $status = $request->status;
            $jk = $request->jenis_kelamin;

            $gantiOrtu = ortu::where('id_ortu','=',$id_ortu)->update(['nama_orangtua' => $nama_orangtua, 'alamat' => $alamat, 'noHp' => $noHp, 'status' => $status, 'jenis_kelamin' => $jk]);
            if ($gantiOrtu) {
            return redirect("/editDataOrtu/".$id_ortu)->with('alert-success','Data Berhasil Diupdate');
          }else{
            return redirect("/editDataOrtu/".$id_ortu)->with('alert','Data Gagal Diupdate');
          }
      }

      public function hapusOrtu($id_ortu)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
         $hapusOrtu = ortu::where('id_ortu','=',$id_ortu)->delete()[0];
         return redirect('/dataOrtu');
      }

      public function mapel()
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
          $dataMapel = mapel::orderBy('id_mapel','DESC')->get();

          return view('admin/mapel', compact('dataMapel'));
      }

      public function inputMapel()
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }

          return view('admin/inputMapel');
      }

      public function postMapel(Request $request)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
            $kode = $this->kodeotomatis('mapel','id_mapel',3,'MPL-');
            $namaMapel = $request->nama_mapel;

            $inputMapel = mapel::insert(['id_mapel' => $kode, 'nama_mapel' => $namaMapel]);
            if ($inputMapel) {
              return redirect('/inputMapel')->with('alert-success','Input Santri Berhasil');
          }else {
            return redirect('/inputMapel')->with('alert', 'Input Santri Gagal');
          }
      }

      public function hapusMapel($id_mapel)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
         $hapusMapel = mapel::where('id_mapel','=',$id_mapel)->delete()[0];
         return redirect('/dataMapel');
      }

      public function editMapel($id_mapel)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
            $editMapel = mapel::where('id_mapel','=',$id_mapel)->get()[0];

            return view('admin/editMapel', compact('editMapel'));
      }

      public function editnyaMapel(Request $request, $id_mapel)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
            $nama_mapel = $request->nama_mapel;


            $gantiMapel = mapel::where('id_mapel','=',$id_mapel)->update(['nama_mapel' => $nama_mapel]);
            if ($gantiMapel) {
            return redirect("/editDataMapel/".$id_mapel)->with('alert-success','Data Berhasil Diupdate');
          }else{
            return redirect("/editDataMapel/".$id_mapel)->with('alert','Data Gagal Diupdate');
          }
      }

      public function kelas()
       {
         session_start();
         if(!Session::get('username')){
                 return redirect('login')->with('alert','Kamu harus login dulu');
             }
             $dataPengajar = pengajar::orderBy('id_pengajar','DESC')->get();
         return view('admin/inputKelas', compact('dataPengajar'));
       }

      public function inputKelas(Request $request)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
            $kode = $this->kodeotomatis('kelas','id_kelas',3,'KLS-');
            $naKel = $request->nama_kelas;
            $pengajar = $request->id_pengajar;

            $kelas = kelas::insert(['id_kelas' => $kode, 'id_pengajar' => $pengajar, 'nama_kelas' => $naKel]);
            if ($kelas) {
              return redirect('/inputKelas')->with('alert-success','Input Kelas Berhasil');
          }else {
            return redirect('/inputKelas')->with('alert', 'Input Kelas Gagal');
          }
      }

      public function dataKelas()
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }

          $dataKelas = kelas::orderBy('id_kelas','DESC')->get();

          return view('admin/dataKelas',compact('dataKelas'));
      }

      public function hapusKelas($id_kelas)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
         $hapusKelas = kelas::where('id_kelas','=',$id_kelas)->delete()[0];
         return redirect('/dataKelas');
      }

      public function santri()
       {
         session_start();
         if(!Session::get('username')){
                 return redirect('login')->with('alert','Kamu harus login dulu');
             }

             $dataOrtu = ortu::orderBy('id_ortu','DESC')->get();
             $dataKelas = kelas::orderBy('id_kelas','DESC')->get();
             $dataKelompok = kelompok::orderBy('id_kelompok','DESC')->get();
         return view('admin/inputSantri', compact('dataOrtu','dataKelas','dataKelompok'));
       }


      public function inputSantri(Request $request)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
            $kode = $this->kodeotomatis('santri','id_santri',3,'SNTR-');
            $namaSantri = $request->nama_santri;
            $id_kelas = $request->id_kelas;
            $id_ortu = $request->id_ortu;
            $id_kelompok = $request->id_kelompok;
            $nama_santri = $request->nama_santri;
            $dataOrtu = ortu::where('id_ortu','=',$id_ortu)->get()[0];
            $alamat = $dataOrtu->alamat;
            $jenis_kelamin = $request->jenis_kelamin;
            $tempat_lahir = $request->tempat_lahir;
            $tanggal_lahir = $request->tanggal_lahir;

            $ortu = santri::insert(['id_santri' => $kode, 'id_ortu' => $id_ortu, 'id_kelas' => $id_kelas, 'id_kelompok' => $id_kelompok, 'nama_santri' => $nama_santri, 'alamat' => $alamat, 'jenis_kelamin' => $jenis_kelamin, 'tempat_lahir' => $tempat_lahir, 'tanggal_lahir' => $tanggal_lahir, 'foto' => '']);
            if ($ortu) {
              return redirect('/inputSantri')->with('alert-success','Input Santri Berhasil');
          }else {
            return redirect('/inputSantri')->with('alert', 'Input Santri Gagal');
          }
      }

   public function dataSantri()
   {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
      $dataSantri = santri::where('status','=',1)->orderBy('id_santri','DESC')->get();
      return view('admin/dataSantri',compact('dataSantri'));
   }

   public function editSantri($id_santri)
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
          $editSantri = santri::where('id_santri','=',$id_santri)->get()[0];
          $ambilOrtu = ortu::where('id_ortu','=',$editSantri->id_ortu)->get()[0];
          return view('admin/editSantri', compact('editSantri','ambilOrtu'));
    }

    public function lulusSantri($id_santri)
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
           $gantiSantri = santri::where('id_santri','=',$id_santri)->update(['status' => '2', 'keluar' => date('Y-m-d H:i:s')]);
           return redirect('dataSantri');
     }

    public function editnyaSantri(Request $request, $id_santri)
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
          $namaSantri = $request->nama_santri;
          $id_kelas = $request->id_kelas;
          $id_ortu = $request->id_ortu;
          $nama_santri = $request->nama_santri;
          $alamat = $request->alamat;
          $noHp = $request->noHp;

          $gantiSantri = santri::where('id_santri','=',$id_santri)->update(['nama_santri' => $nama_santri, 'id_kelas' => $id_kelas, 'id_ortu' => $id_ortu, 'nama_santri' => $nama_santri, 'alamat' => $alamat, 'noHp' => $noHp]);
          if ($gantiSantri) {
          return redirect("/editDataSantri/".$id_santri)->with('alert-success','Data Berhasil Diupdate');
        }else{
          return redirect("/editDataSantri/".$id_santri)->with('alert','Data Gagal Diupdate');
        }
    }

   public function hapusSantri($id_santri)
   {
     session_start();
     if(!Session::get('username')){
             return redirect('login')->with('alert','Kamu harus login dulu');
         }
      $hapusSantri = santri::where('id_santri','=',$id_santri)->delete()[0];
      return redirect('/dataSantri');
   }

   public function sistemKelas()
   {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
          $dataSantri = santri::orderBy('id_santri','DESC')->get();
          $dataKelas = kelas::orderBy('id_kelas','DESC')->get();
      return view('admin/sistemKelas',compact('dataSantri','dataKelas'));
   }

   public function inputSistemKelas(Request $request)
   {
     session_start();
     if(!Session::get('username')){
             return redirect('login')->with('alert','Kamu harus login dulu');
         }
         $id_kelas = $request->id_kelas;
         $arrsantri = $request->id_santri;
         foreach ($arrsantri as $value) {
           $santri = santri::where('id_santri','=',$value)->update(['id_kelas' => $id_kelas]);
         }
         if ($santri) {
           return redirect('/sistemKelas')->with('alert-success','Input Santri Berhasil');
       }else {
         return redirect('/sistemKelas')->with('alert', 'Input Santri Gagal');
       }
   }


   public function awda($id_kelas)
   {
     session_start();
     if(!Session::get('username')){
             return redirect('login')->with('alert','Kamu harus login dulu');
         }
         else{
            $nilaiSantri = santri::where('id_kelas', '=', $id_kelas)->get();
            $kelas = kelas::where('id_kelas', '=', $id_kelas)->get()[0];
             return view('admin/nilaiSantri', compact(['nilaiSantri','kelas']));
           }
   }

   public function detailNilaiSantri($id_santri, $semester = '')
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
            return view('admin/detailNilaiSantri', compact(['detailSantri','dataOrtu','nilaiSantri','logNilaiSantri', 'mapel']));
         }
   }

   public function tambahFoto(Request $request, $id_santri)
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
           return redirect("/detailNilaiSantri/".$id_santri)->with('alert-success','Data Berhasil Diupdate');
         }else{
           return redirect("/detailNilaiSantri/".$id_santri)->with('alert','Data Gagal Diupdate');
         }
        }
   }

   public function pengajar()
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
      return view('admin/inputPengajar');
    }

   public function inputPengajar(Request $request)
   {
     session_start();
     if(!Session::get('username')){
             return redirect('login')->with('alert','Kamu harus login dulu');
         }
     $kode = $this->kodeotomatis('pengajar','id_pengajar',3,'PJR-');
     $username = $request->username;
     $nama_pengajar = $request->nama_pengajar;
     $password = bcrypt($request->password);
     $jenis_kelamin = $request->jenis_kelamin;
     $tempat_lahir = $request->tempat_lahir;
     $tanggal_lahir = $request->tanggal_lahir;
     $alamat = $request->alamat;
     $noHp = $request->noHp;

     $user = users::insert(['id_user' => null, 'username' => $username, 'password' => $password, 'level' => '4']);
     if ($user) {
       $select = users::where('username', '=', $username)->get()[0];
       $pengajarUser = pengajar::insert(['id_pengajar' => $kode, 'id_user' => $select['id_user'], 'nama_pengajar' => $nama_pengajar, 'jenis_kelamin' => $jenis_kelamin, 'tempat_lahir' => $tempat_lahir, 'tanggal_lahir' => $tanggal_lahir, 'alamat' => $alamat, 'noHp' => $noHp]);
     return redirect('/inputPengajar')->with('alert-success','Input Pengguna Berhasil');
   }else {
     return redirect('/inputPengajar')->with('alert', 'Input Pengguna Gagal');
   }
 }

   public function dataPengajar()
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
         $dataPengajar = pengajar::orderBy('id_pengajar','DESC')->get();

         return view('admin/dataPengajar', compact('dataPengajar'));
     }

   public function editPengajar($id_pengajar)
   {
     session_start();
     if(!Session::get('username')){
             return redirect('login')->with('alert','Kamu harus login dulu');
         }
         $editPengajar = pengajar::where('id_pengajar','=',$id_pengajar)->get()[0];
         return view('admin/editPengajar', compact('editPengajar'));
   }

   public function editnyaPengajar(Request $request, $id_pengajar)
   {
     session_start();
     if(!Session::get('username')){
             return redirect('login')->with('alert','Kamu harus login dulu');
         }
         $nama_pengajar = $request->nama_pengajar;
         $jenis_kelamin = $request->jenis_kelamin;
         $tempat_lahir = $request->tempat_lahir;
         $tanggal_lahir = $request->tanggal_lahir;
         $alamat = $request->alamat;
         $noHp = $request->noHp;

         $gantiPengajar = pengajar::where('id_pengajar','=',$id_pengajar)->update(['nama_pengajar' => $nama_pengajar, 'jenis_kelamin' => $jenis_kelamin, 'tempat_lahir' => $tempat_lahir, 'tanggal_lahir' => $tanggal_lahir, 'alamat' => $alamat, 'noHp' => $noHp]);
         if ($gantiPengajar) {
         return redirect("/editDataPengajar/".$id_pengajar)->with('alert-success','Data Berhasil Diupdate');
       }else{
         return redirect("/editDataPengajar/".$id_pengajar)->with('alert','Data Gagal Diupdate');
       }
   }

   public function hapusPengajar($id_pengajar)
   {
     session_start();
     if(!Session::get('username')){
             return redirect('login')->with('alert','Kamu harus login dulu');
         }
      $hapusPengajar = pengajar::where('id_pengajar','=',$id_pengajar)->delete()[0];
      return redirect('/dataPengajar');
   }

   public function santriMassal()
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }

  return view('admin/inputSantriMassal');
    }


   public function inputSantriMassal(Request $request)
   {
     session_start();
     if(!Session::get('username')){
             return redirect('login')->with('alert','Kamu harus login dulu');
         }
         $fileMassal = $request->file('file');
         $namefile = $fileMassal->getClientOriginalName();
         $fileMassal->move('../public/rekapSantri/',$namefile);

         $data = $this->csvToArray('../public/rekapSantri/'.$namefile);
         $san = array();
         for ($i=0; $i < count($data); $i++) {
           // $san[$i]['id_santri'] = $this->kodeotomatis('santri','id_santri',3,'SNTR-');
           // $san[$i]['nama_santri'] = $data[$i][0];
           // $san[$i]['alamat'] = $data[$i][1];
           // $san[$i]['noHp'] = $data[$i][2];

             $santrimassal = santri::insert(['id_santri' => $this->kodeotomatis('santri','id_santri',3,'SNTR-'), 'id_ortu' => '', 'id_kelas' => '', 'nama_santri' => $data[$i][0], 'alamat' => $data[$i][1], 'noHp' => '1', 'foto' =>'']);

         }


       //   $ortu = santri::insert(['id_santri' => $kode, 'id_ortu' => $id_ortu, 'id_kelas' => $id_kelas, 'nama_santri' => $nama_santri, 'alamat' => $alamat, 'noHp' => $noHp, 'foto' => $namefile]);
       //   if ($ortu) {
       //     return redirect('/inputSantri')->with('alert-success','Input Santri Berhasil');
       // }else {
       //   return redirect('/inputSantri')->with('alert', 'Input Santri Gagal');
       // }
   }

    public function kelompok()
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
           $dataKelompok = kelompok::orderBy('id_kelompok','DESC')->get();
       return view('admin/dataKelompok', compact('dataKelompok'));
     }

     public function inputKelompok()
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
            $dataGuru = guru::orderBy('id_guru','DESC')->get();
        return view('admin/inputKelompok', compact('dataGuru'));
      }

    public function postKelompok(Request $request)
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
          $kode = $this->kodeotomatis('kelompok','id_kelompok',3,'KLP-');
          $naKelp = $request->nama_kelompok;
          $guru = $request->id_guru;

          $kelompok = kelompok::insert(['id_kelompok' => $kode, 'nama_kelompok' => $naKelp, 'id_guru' => $guru]);
          if ($kelompok) {
            return redirect('/inputKelompok')->with('alert-success','Input Kelompok Berhasil');
        }else {
          return redirect('/inputKelompok')->with('alert', 'Input Kelas Gagal');
        }
    }

    public function dataSantriKelompok($id_kelompok)
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
          else{
             $dataSantri = santri::where('id_kelompok', '=', $id_kelompok)->get();
             $kelompok = kelompok::where('id_kelompok', '=', $id_kelompok)->get()[0];
              return view('admin/dataSantriKelompok', compact(['dataSantri','id_kelompok','kelompok']));
            }
    }

    public function inputSantriKelp($id_kelompok)
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
           $dataSantri = santri::orderBy('id_santri','DESC')->get();
           $kelompok = kelompok::where('id_kelompok', '=', $id_kelompok)->get()[0];
       return view('admin/inputSantriKelompok', compact(['dataSantri','id_kelompok','kelompok']));
     }

   public function postSantriKelp(Request $request, $id_kelompok)
   {
     session_start();
     if(!Session::get('username')){
             return redirect('login')->with('alert','Kamu harus login dulu');
         }
         foreach ($request->id_santri as $key => $santri) {
           $kelompok = santri::where('id_santri','=',$santri)->update(['id_kelompok' => $id_kelompok]);
         }

         if ($kelompok) {
           return redirect('/inputSantriKelompok/'.$id_kelompok)->with('alert-success','Input Kelas Berhasil');
       }else {
         return redirect('/inputSantriKelompok/'.$id_kelompok)->with('alert', 'Input Kelas Gagal');
       }
   }

    public function hapusKelompok($id_kelompok)
    {
      session_start();
      if(!Session::get('username')){
              return redirect('login')->with('alert','Kamu harus login dulu');
          }
       $hapusKelompok = kelompok::where('id_kelompok','=',$id_kelompok)->delete()[0];
       return redirect('/dataKelompok');
    }

    public function getNilaiSantri()
     {
       session_start();
       if(!Session::get('username')){
               return redirect('login')->with('alert','Kamu harus login dulu');
           }
           $dataSantri = santri::orderBy('id_santri','DESC')->get();
           $mapel = mapel::get();
       return view('admin/dataPenilaianSantri', compact(['dataSantri','mapel']));
     }

     public function alumniGet($angkatan = null)
      {
        session_start();
        if(!Session::get('username')){
                return redirect('login')->with('alert','Kamu harus login dulu');
            }
        return view('admin/dataAlumni', compact('angkatan'));
      }
}
