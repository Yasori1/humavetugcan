<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // Hata takibi için eklendi
use App\Models\RSVP;
use App\Models\Asset;

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
    
    // 1. Dosya hiç gelmiş mi kontrolü (PNG boyutu PHP limitini aşarsa burası false döner)
    if (!$request->hasFile('weddingFile')) {
        return back()->with('error', '❌ Dosya sunucuya ulaşmadı. Boyut çok büyük olabilir (Max: 2MB).');
    }

    $file = $request->file('weddingFile');

    // 2. Güvenlik ve Uzantı Doğrulaması (PNG, JPG, JPEG, MP4, MOV desteği)
    $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'video/mp4', 'video/quicktime'];
    if (!in_array($file->getClientMimeType(), $allowedMimes)) {
        return back()->with('error', '❌ Sadece JPG, PNG veya Video dosyaları yüklenebilir.');
    }

    try {
        // Dosyayı isimlendir ve storage/app/public/galeri içine at
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('galeri', $fileName, 'public');

        // Veritabanına kayıt
        Asset::create([
            'type' => $file->getClientMimeType(),
            'path' => $path,
            'name' => $fileName,
            'description' => 'Hüma & Tuğcan Albümü',
        ]);

        return back()->with('success', '✅ Harika! Dosyanız Hüma & Tuğcan albümüne eklendi.');

    } catch (\Exception $e) {
        // Bir hata oluşursa log kaydı tut
        Log::error("Yükleme Hatası: " . $e->getMessage());
        return back()->with('error', '❌ Sistemsel bir hata oluştu.');
    }

})->name('photo.upload');

// [3] KATILIM TAKİP SİSTEMİ - RSVP Veri Kayıt Motoru
Route::post('/rsvp-kaydet', function (Request $request) {
    
    $request->validate([
        'ad' => 'required|string|max:255',
        'soyad' => 'required|string|max:255',
        'katilim_durumu' => 'required',
        'kisi_sayisi' => 'required|integer|min:0',
    ]);

    RSVP::create([
        'name' => $request->ad,
        'surname' => $request->soyad,
        'status' => $request->katilim_durumu === 'var' ? true : false,
        'guest_count' => $request->kisi_sayisi,
    ]);

    return back()->with('success', '✅ Bildiriminiz başarıyla kaydedildi. Teşekkürler!');
})->name('rsvp.save');

require __DIR__.'/settings.php';