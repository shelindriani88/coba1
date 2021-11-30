<?php

namespace App\Http\Controllers;

use App\Ayat;
use App\Hafalan;
use App\Surah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getDataSiswa(Request $request){
        $ortu = \App\ortu::where('id_user',$request->user()->id_user)->first();
        $surah =Surah::all();
        $result =[];
        foreach ($surah as $s) {
            $s['persentase'] = $ortu->anak->getPersentase($s->id_surah);
            $result[]=$s;
        }
        if(!$ortu->anak){
            return response("Anak anda belum terdaftar!",404);
        }
        return response($ortu->anak);
    }

    public function getKelas(){
        return response(\App\kelas::all());
    }

    public function getSantriByKelas(Request $request){
        $id_kelas = $request->id_kelas;
        return response(\App\santri::where('id_kelas',$id_kelas)->get());
    }

    public function getAllSurah(Request $request){
        $surah =Surah::all();
        $santri = \App\santri::where('id_santri',$request->id_santri)->first();
        $result =[];
        foreach ($surah as $s) {
            $s['persentase'] = $santri->getPersentase($s->id_surah);
            $result[]=$s;
        }
        return response($result);
    }

    public function getAyatBySurah(Request $request){
        $id_surah = $request->id_surah;
        return response(Ayat::where('id_surah',$id_surah)->get(),200,['Content-Type' =>'application/json UTF-8']);
    }

    public function saveHafalan(Request $request){
        $data = $request->only('id_ayat','id_santri','id_surah');
        $user['approved_by'] = $request->user('api')->id_user;

        $hafalan = Hafalan::firstOrCreate($data,$user);
        return response($hafalan);
    }

}
