<?php

use Illuminate\Database\Seeder;

class AyatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = \Illuminate\Support\Facades\Http::get("https://al-quran-8d642.firebaseio.com/data.json");
        if($response->successful()){
            $arrays = json_decode($response->body(),true);
            \Illuminate\Support\Facades\DB::beginTransaction();
            foreach ($arrays as $arr){
                $ayat = \App\Surah::create($arr);
                $detail_response = \Illuminate\Support\Facades\Http::get('https://al-quran-8d642.firebaseio.com/surat/'.$arr['nomor'].'.json');
                if($detail_response->successful()){
                    $detail = json_decode($detail_response->body(),true);
                    foreach ($detail as $d){
                        $d['id_surah'] = $ayat->id_surah;
                        \App\Ayat::create($d);
                    }

                    sleep(2);
                }
                else {
                    \Illuminate\Support\Facades\DB::rollBack();
                    dd("error connect");
                }
            }
            \Illuminate\Support\Facades\DB::commit();
        }
        else {
            \Illuminate\Support\Facades\DB::rollBack();
            dd("error connect");
        }
    }
}
