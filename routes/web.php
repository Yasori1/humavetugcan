<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| PROJE: Hüma & Tuğcan Dijital Davetiye Sistemi
| GELİŞTİRİCİ: Yaşar Eren Güre
| TARİH: 11.04.2026
| AÇIKLAMA: Bu sistem Laravel 11 altyapısı kullanılarak Yaşar Eren Güre
| tarafından düğün anı defteri ve katılım takibi için özel olarak kodlanmıştır.
|--------------------------------------------------------------------------
*/

// [1] ANA SAYFA - Davetiye Görünümü
Route::inertia('/', 'Home')->name('home');

// [2] DİJİTAL ANI DEFTERİ - Fotoğraf ve Video Yükleme Motoru
Route::post('/upload-photo', function (Request $request) {
    // Yaşar Eren Güre: Güvenlik ve dosya kontrolü
    if ($request->hasFile('weddingFile')) {
        $file = $request->file('weddingFile');
        
        // Dosyayı zaman damgasıyla isimlendirip storage/app/public/galeri içine atar
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('galeri', $fileName, 'public');

        return "✅ Harika! Dosyanız Hüma & Tuğcan albümüne eklendi.";
    }
    
    return "❌ Lütfen bir dosya seçin.";
})->name('photo.upload');

// [3] KATILIM TAKİP SİSTEMİ - RSVP Veri Kayıt Motoru
Route::post('/rsvp-kaydet', function (Request $request) {
    // Yaşar Eren Güre: Form verilerini parse etme
    $ad = $request->input('ad');
    $soyad = $request->input('soyad');
    $durum = $request->input('katilim_durumu');
    $kisi_sayisi = $request->input('kisi_sayisi');
    $tarih = date('d.m.Y H:i:s');

    // Kayıt Formatı: [Tarih] İsim Soyisim - Durum - Kişi Sayısı
    $logEntry = "[{$tarih}] - {$ad} {$soyad} - Durum: {$durum} - Kişi Sayısı: {$kisi_sayisi}" . PHP_EOL;

    // storage/app/katilimcilar.txt dosyasına güvenli bir şekilde ekler
    Storage::disk('local')->append('katilimcilar.txt', $logEntry);

    return "✅ Bildiriminiz başarıyla kaydedildi. Teşekkürler!";
})->name('rsvp.save');

/*
|--------------------------------------------------------------------------
| DEVELOPER NOTE: Bu projenin backend mantığı Yaşar Eren Güre tarafından 
| Laravel best-practice kurallarına uygun olarak optimize edilmiştir.
|--------------------------------------------------------------------------
*/

require __DIR__.'/settings.php';
