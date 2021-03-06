<?php

use Illuminate\Support\Facades\Route;

//admin
Route::get('/', 'admin@login');
Route::get('/pageAdmin', 'admin@admin');
Route::get('/pageAdmin', 'admin@getDashboard');
Route::get('/login', 'admin@login');
Route::post('/loginAdminPost', 'admin@signin');
Route::get('/logout', 'admin@logout');
// Route::get('/pengguna', 'admin@pilihPengguna');
Route::get('/inputGuru', 'admin@guru');
Route::post('/inputGuru', 'admin@inputGuru');
Route::get('/dataGuru', 'admin@dataGuru');
Route::get('/hapusDataGuru/{id_guru}', 'admin@hapusGuru');
Route::get('/editDataGuru/{id_guru}', 'admin@editGuru');
Route::post('/editDataGuru/{id_guru}', 'admin@editnyaGuru');
Route::get('/dataOrtu', 'admin@dataOrtu');
Route::get('/inputOrtu', 'admin@ortu');
Route::post('/inputOrtu', 'admin@inputOrtu');
Route::get('/hapusDataOrtu/{id_ortu}', 'admin@hapusOrtu');
Route::get('/editDataOrtu/{id_ortu}', 'admin@editOrtu');
Route::post('/editDataOrtu/{id_ortu}', 'admin@editnyaOrtu');
Route::get('/inputKelas', 'admin@kelas');
Route::post('/inputKelas', 'admin@inputKelas');
Route::get('/dataKelas', 'admin@dataKelas');
Route::get('/hapusDataKelas/{id_kelas}', 'admin@hapusKelas');
Route::get('/inputSantri', 'admin@santri');
Route::post('/inputSantri', 'admin@inputSantri');
Route::get('/inputSantriMassal', 'admin@santriMassal');
Route::post('/inputSantriMassal', 'admin@inputSantriMassal');
Route::get('/dataSantri', 'admin@dataSantri');
Route::get('/lulusDataSantri/{id_santri}', 'admin@lulusSantri');
Route::get('/hapusDataSantri/{id_santri}', 'admin@hapusSantri');
Route::get('/editDataSantri/{id_santri}', 'admin@editSantri');
Route::post('/editDataSantri/{id_santri}', 'admin@editnyaSantri');
Route::get('/sistemKelas', 'admin@sistemKelas');
Route::post('/sistemKelas', 'admin@inputSistemKelas');
Route::get('/nilaiSantri/{id_kelas}', 'admin@nilaiSantri');
Route::get('/detailNilaiSantri/{id_santri}/{semester?}', 'admin@detailNilaiSantri');
Route::post('/detailNilaiSantri/{id_santri}', 'admin@tambahFoto');
Route::get('/inputPengajar', 'admin@pengajar');
Route::post('/inputPengajar', 'admin@inputPengajar');
Route::get('/dataPengajar', 'admin@dataPengajar');
Route::get('/hapusDataPengajar/{id_pengajar}', 'admin@hapusPengajar');
Route::get('/editDataPengajar/{id_pengajar}', 'admin@editPengajar');
Route::post('/editDataPengajar/{id_pengajar}', 'admin@editnyaPengajar');
Route::get('/dataMapel', 'admin@mapel');
Route::get('/inputMapel', 'admin@inputMapel');
Route::post('/inputMapel', 'admin@postMapel');
Route::get('/hapusDataMapel/{id_mapel}', 'admin@hapusMapel');
Route::get('/editDataMapel/{id_mapel}', 'admin@editMapel');
Route::post('/editDataMapel/{id_mapel}', 'admin@editnyaMapel');
Route::get('/dataKelompok', 'admin@kelompok');
Route::get('/inputKelompok', 'admin@inputKelompok');
Route::post('/inputKelompok', 'admin@postKelompok');
Route::get('/dataSantriKelompok/{id_kelompok}', 'admin@dataSantriKelompok');
Route::get('/hapusDataKelompok/{id_kelompok}', 'admin@hapusKelompok');
Route::get('/inputSantriKelompok/{id_kelompok}', 'admin@inputSantriKelp');
Route::post('/inputSantriKelompok/{id_kelompok}', 'admin@postSantriKelp');
Route::get('/dataPenilaianSantri/{semester?}', 'admin@getNilaiSantri');
Route::get('/alumni/{angkatan?}', 'admin@alumniGet');

//pengajar
Route::get('/pagePengajar', 'pengajars@index');
Route::get('/dataMapels', 'pengajars@mapel');
Route::get('/inputMapels', 'pengajars@inputMapel');
Route::post('/inputMapels', 'pengajars@postMapel');
Route::get('/hapusDataMapels/{id_mapel}', 'pengajars@hapusMapel');
Route::get('/editDataMapels/{id_mapel}', 'pengajars@editMapel');
Route::post('/editDataMapels/{id_mapel}', 'pengajars@editnyaMapel');
Route::get('/santriKelas', 'pengajars@santriKelas');
Route::get('/beriNilai/{id_santri}', 'pengajars@beriNilai');
Route::post('/beriNilai/{id_santri}', 'pengajars@postNilai');
Route::get('/reportNilai/{id_santri}/{semester?}', 'pengajars@reportNilai');
Route::get('/inputSikap', 'pengajars@inputSikap');
Route::post('/inputSikap', 'pengajars@postSikap');
Route::get('/detailNilaiSantris/{id_santri}/{semester?}', 'pengajars@detailNilaiSantris');
Route::post('/detailNilaiSantris/{id_santri}', 'pengajars@tambahFotos');
Route::get('/getNilaiS/{id_santri}/{semester}', 'pengajars@getNilaiS');

//API
Route::post('/apiGetPengguna', 'api@getPengguna');
Route::get('/apiGetGuru/{id}', 'api@getGuru');
Route::get('/apiGetOrtu/{id}', 'api@getOrtu');
Route::post('/apiInputNilai', 'api@inputNilai');
Route::post('/apiLogNilaiCreate', 'api@logNilaiCreate');
Route::post('/apiLogNilaiUpdate/{id_nilai}', 'api@logNilaiUpdate');
Route::post('/apiLogNilaiDelete/{id_nilai}', 'api@logNilaiDelete');
Route::get('/apiLogNilaiget/{id_nilai}', 'api@logNilaiget');
Route::post('/apiLogGuruCreate', 'api@logGuruCreate');
Route::post('/apiLogGuruUpdate/{id_guru}', 'api@logGuruUpdate');
Route::post('/apiLogGuruDelete/{id_guru}', 'api@logGuruDelete');
Route::get('/apiLogGuruget/{id_guru}', 'api@logGuruget');
Route::post('/apiChangePass/{id_user}', 'api@changePass');
Route::post('/apiForgotPass/{id_user}', 'api@forgotPass');
