<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['midlleware' => 'web'], function () {

Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/dashboard/data', 'HomeController@dataTender')->name('dashboard.data');
Route::post('/dashboard/banner', 'HomeController@dataBanner')->name('banner.data');
Route::post('/tender/insert', 'HomeController@store')->name('tender.store');
Route::post('/dashboard/banner1', 'HomeController@dataBanner')->name('notifikasi.data');

Route::get('/evaluasi/daftar', 'EvaluasiController@viewEntri')->name('evaluasi.list');
Route::get('/evaluasi/create_eval/{id}', 'EvaluasiController@viewEvaluasi')->name('evaluasi.buat');
Route::get('/evaluasi/detail_tender/{id}', 'EvaluasiController@viewDetalEvaluasi')->name('evaluasi.detailjsea');

Route::post('/evaluasi/data', 'EvaluasiController@index')->name('evaluasi.data'); 
Route::post('/evaluasi/detail_jsea', 'EvaluasiController@getDataTender')->name('evaluasi.detail_jsea'); 
Route::post('/evaluasi/detail_evaluasi', 'EvaluasiController@showEvaluasi')->name('evaluasi.detail'); 
Route::post('/evaluasi/update_evaluasi', 'EvaluasiController@updateEvaluasi')->name('evaluasi.update'); 
Route::post('/evaluasi/diterima_evaluasi', 'EvaluasiController@updateDiterima')->name('evaluasi.diterima'); 

Route::post('/evaluasi/posting_evaluasi', 'EvaluasiController@updatePosting')->name('evaluasi.update_posting');  
Route::post('/evaluasi/save_data', 'EvaluasiController@store')->name('evaluasi.save'); 


Route::get('formulir/cetak/{id}', 'FormLimbahController@cetakFormulir')->name('formulir.cetak'); 
Route::resource('formulir', 'FormLimbahController');

Route::post('/tender/evaluasi', 'LimbahController@viewProses')->name('limbah.proses');
Route::post('notifikasi/get', 'HomeController@getNotifikasi')->name('home.notifikasi');

Route::post('/kirimemail','JseaMailController@index')->name('mail.send');

Route::get('/manage/user_email', 'MDUserController@viewEntri')->name('manage.user_email');
Route::post('/manage/emaildata', 'MDUserController@index')->name('user_email.data');
Route::post('/manage/simpan', 'MDUserController@store')->name('user_email.simpan'); 
Route::post('/manage/update', 'MDUserController@update')->name('user_email.update'); 
Route::get('/manage/destroy/{id}', 'MDUserController@destroy');
});