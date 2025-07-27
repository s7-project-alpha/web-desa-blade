<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\KontakMessageController;
use Illuminate\Support\Facades\Route;

// Public Routes (Website Masyarakat)
Route::get('/', [PublicController::class, 'index'])->name('public.home');
Route::get('/visi-misi', [PublicController::class, 'visiMisi'])->name('public.visi-misi');
Route::get('/demografi', [PublicController::class, 'demografi'])->name('public.demografi');
Route::get('/perangkat-desa', [PublicController::class, 'perangkatDesa'])->name('public.perangkat-desa');
Route::get('/sejarah', [PublicController::class, 'sejarah'])->name('public.sejarah');
Route::get('/bumdes', [PublicController::class, 'bumdes'])->name('public.bumdes');
Route::get('/pkk', [PublicController::class, 'pkk'])->name('public.pkk');
Route::get('/posyandu', [PublicController::class, 'posyandu'])->name('public.posyandu');

// Berita Routes
Route::get('/berita', [PublicController::class, 'berita'])->name('public.berita');
Route::get('/berita/{slug}', [PublicController::class, 'beritaDetail'])->name('public.berita.detail');
Route::get('/kategori/{kategoriSlug}', [PublicController::class, 'beritaByKategori'])->name('public.berita.kategori');
Route::get('/search', [PublicController::class, 'searchBerita'])->name('public.berita.search');

// Galeri Routes
Route::get('/galeri', [PublicController::class, 'galeri'])->name('public.galeri.index');
Route::get('/galeri/{slug}', [PublicController::class, 'galeriDetail'])->name('public.galeri.detail');
Route::get('/galeri-kategori/{kategoriSlug}', [PublicController::class, 'galeriByKategori'])->name('public.galeri.kategori');

// Kontak Routes
Route::get('/kontak', [PublicController::class, 'kontak'])->name('public.kontak');
Route::post('/kontak', [KontakMessageController::class, 'store'])->name('kontak.store');

// Public Pengajuan Surat Routes (tambahkan setelah route kontak)
Route::prefix('pengajuan-surat')->name('public.pengajuan-surat.')->group(function () {
    Route::get('/', [App\Http\Controllers\PengajuanSuratController::class, 'index'])->name('index');
    Route::get('/required-fields', [App\Http\Controllers\PengajuanSuratController::class, 'getRequiredFields'])->name('required-fields');
    Route::post('/', [App\Http\Controllers\PengajuanSuratController::class, 'store'])->name('store');
    Route::get('/success/{nomorPengajuan}', [App\Http\Controllers\PengajuanSuratController::class, 'success'])->name('success');
    Route::get('/track', [App\Http\Controllers\PengajuanSuratController::class, 'track'])->name('track');
    Route::post('/check-status', [App\Http\Controllers\PengajuanSuratController::class, 'checkStatus'])->name('check-status');
});


// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Visi Misi routes
    Route::resource('visi-misi', App\Http\Controllers\Admin\VisiMisiController::class);
    Route::post('visi-misi/{visiMisi}/activate', [App\Http\Controllers\Admin\VisiMisiController::class, 'activate'])->name('visi-misi.activate');

    // Demografi routes
    Route::resource('demografi', App\Http\Controllers\Admin\DemografiController::class);
    Route::post('demografi/{demografi}/activate', [App\Http\Controllers\Admin\DemografiController::class, 'activate'])->name('demografi.activate');

    // Perangkat Desa routes
    Route::resource('perangkat-desa', App\Http\Controllers\Admin\PerangkatDesaController::class);
    Route::patch('perangkat-desa/{perangkatDesa}/toggle-active', [App\Http\Controllers\Admin\PerangkatDesaController::class, 'toggleActive'])->name('perangkat-desa.toggle-active');

    // BUMDes routes
    Route::prefix('bumdes')->name('bumdes.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\BumdesController::class, 'index'])->name('index');
        Route::get('/create-or-edit', [App\Http\Controllers\Admin\BumdesController::class, 'createOrEdit'])->name('create-or-edit');
        Route::post('/store-or-update', [App\Http\Controllers\Admin\BumdesController::class, 'storeOrUpdate'])->name('store-or-update');

        // Unit Usaha
        Route::get('/unit-usaha', [App\Http\Controllers\Admin\BumdesController::class, 'unitUsaha'])->name('unit-usaha');
        Route::get('/unit-usaha/create', [App\Http\Controllers\Admin\BumdesController::class, 'createUnitUsaha'])->name('unit-usaha.create');
        Route::post('/unit-usaha', [App\Http\Controllers\Admin\BumdesController::class, 'storeUnitUsaha'])->name('unit-usaha.store');
        Route::get('/unit-usaha/{unitUsaha}/edit', [App\Http\Controllers\Admin\BumdesController::class, 'editUnitUsaha'])->name('unit-usaha.edit');
        Route::put('/unit-usaha/{unitUsaha}', [App\Http\Controllers\Admin\BumdesController::class, 'updateUnitUsaha'])->name('unit-usaha.update');
        Route::delete('/unit-usaha/{unitUsaha}', [App\Http\Controllers\Admin\BumdesController::class, 'destroyUnitUsaha'])->name('unit-usaha.destroy');

        // Tim Manajemen
        Route::get('/tim-manajemen', [App\Http\Controllers\Admin\BumdesController::class, 'timManajemen'])->name('tim-manajemen');
        Route::get('/tim-manajemen/create', [App\Http\Controllers\Admin\BumdesController::class, 'createTimManajemen'])->name('tim-manajemen.create');
        Route::post('/tim-manajemen', [App\Http\Controllers\Admin\BumdesController::class, 'storeTimManajemen'])->name('tim-manajemen.store');
        Route::get('/tim-manajemen/{timManajemen}/edit', [App\Http\Controllers\Admin\BumdesController::class, 'editTimManajemen'])->name('tim-manajemen.edit');
        Route::put('/tim-manajemen/{timManajemen}', [App\Http\Controllers\Admin\BumdesController::class, 'updateTimManajemen'])->name('tim-manajemen.update');
        Route::delete('/tim-manajemen/{timManajemen}', [App\Http\Controllers\Admin\BumdesController::class, 'destroyTimManajemen'])->name('tim-manajemen.destroy');
    });


    // PKK routes
    Route::prefix('pkk')->name('pkk.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PkkController::class, 'index'])->name('index');
        Route::get('/create-or-edit', [App\Http\Controllers\Admin\PkkController::class, 'createOrEdit'])->name('create-or-edit');
        Route::post('/store-or-update', [App\Http\Controllers\Admin\PkkController::class, 'storeOrUpdate'])->name('store-or-update');

        // Program Kerja
        Route::get('/program-kerja', [App\Http\Controllers\Admin\PkkController::class, 'programKerja'])->name('program-kerja');
        Route::get('/program-kerja/create', [App\Http\Controllers\Admin\PkkController::class, 'createProgramKerja'])->name('program-kerja.create');
        Route::post('/program-kerja', [App\Http\Controllers\Admin\PkkController::class, 'storeProgramKerja'])->name('program-kerja.store');
        Route::get('/program-kerja/{programKerja}/edit', [App\Http\Controllers\Admin\PkkController::class, 'editProgramKerja'])->name('program-kerja.edit');
        Route::put('/program-kerja/{programKerja}', [App\Http\Controllers\Admin\PkkController::class, 'updateProgramKerja'])->name('program-kerja.update');
        Route::delete('/program-kerja/{programKerja}', [App\Http\Controllers\Admin\PkkController::class, 'destroyProgramKerja'])->name('program-kerja.destroy');

        // Pengurus
        Route::get('/pengurus', [App\Http\Controllers\Admin\PkkController::class, 'pengurus'])->name('pengurus');
        Route::get('/pengurus/create', [App\Http\Controllers\Admin\PkkController::class, 'createPengurus'])->name('pengurus.create');
        Route::post('/pengurus', [App\Http\Controllers\Admin\PkkController::class, 'storePengurus'])->name('pengurus.store');
        Route::get('/pengurus/{pengurus}/edit', [App\Http\Controllers\Admin\PkkController::class, 'editPengurus'])->name('pengurus.edit');
        Route::put('/pengurus/{pengurus}', [App\Http\Controllers\Admin\PkkController::class, 'updatePengurus'])->name('pengurus.update');
        Route::delete('/pengurus/{pengurus}', [App\Http\Controllers\Admin\PkkController::class, 'destroyPengurus'])->name('pengurus.destroy');

        // Kegiatan
        Route::get('/kegiatan', [App\Http\Controllers\Admin\PkkController::class, 'kegiatan'])->name('kegiatan');
        Route::get('/kegiatan/create', [App\Http\Controllers\Admin\PkkController::class, 'createKegiatan'])->name('kegiatan.create');
        Route::post('/kegiatan', [App\Http\Controllers\Admin\PkkController::class, 'storeKegiatan'])->name('kegiatan.store');
        Route::get('/kegiatan/{kegiatan}/edit', [App\Http\Controllers\Admin\PkkController::class, 'editKegiatan'])->name('kegiatan.edit');
        Route::put('/kegiatan/{kegiatan}', [App\Http\Controllers\Admin\PkkController::class, 'updateKegiatan'])->name('kegiatan.update');
        Route::delete('/kegiatan/{kegiatan}', [App\Http\Controllers\Admin\PkkController::class, 'destroyKegiatan'])->name('kegiatan.destroy');

        // Toggle Active
        Route::post('/toggle-active/{type}/{id}', [App\Http\Controllers\Admin\PkkController::class, 'toggleActive'])->name('toggle-active');
    });

    // Kategori Galeri routes
    Route::resource('kategori-galeri', App\Http\Controllers\Admin\KategoriGaleriController::class);
    Route::patch('kategori-galeri/{kategoriGaleri}/toggle-active', [App\Http\Controllers\Admin\KategoriGaleriController::class, 'toggleActive'])->name('kategori-galeri.toggle-active');

    // Galeri routes
    Route::resource('galeri', App\Http\Controllers\Admin\GaleriController::class);
    Route::patch('galeri/{galeri}/toggle-active', [App\Http\Controllers\Admin\GaleriController::class, 'toggleActive'])->name('galeri.toggle-active');
    Route::patch('galeri/{galeri}/toggle-featured', [App\Http\Controllers\Admin\GaleriController::class, 'toggleFeatured'])->name('galeri.toggle-featured');


    // Kontak management routes
    Route::prefix('kontak')->name('kontak.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\KontakController::class, 'index'])->name('index');
        Route::get('/edit', [App\Http\Controllers\Admin\KontakController::class, 'editKontak'])->name('edit');
        Route::put('/update', [App\Http\Controllers\Admin\KontakController::class, 'updateKontak'])->name('update');

        // Kontak Pejabat
        Route::get('/pejabat', [App\Http\Controllers\Admin\KontakController::class, 'pejabat'])->name('pejabat');
        Route::get('/pejabat/create', [App\Http\Controllers\Admin\KontakController::class, 'createPejabat'])->name('pejabat.create');
        Route::post('/pejabat', [App\Http\Controllers\Admin\KontakController::class, 'storePejabat'])->name('pejabat.store');
        Route::get('/pejabat/{pejabat}/edit', [App\Http\Controllers\Admin\KontakController::class, 'editPejabat'])->name('pejabat.edit');
        Route::put('/pejabat/{pejabat}', [App\Http\Controllers\Admin\KontakController::class, 'updatePejabat'])->name('pejabat.update');
        Route::patch('/pejabat/{pejabat}/toggle-active', [App\Http\Controllers\Admin\KontakController::class, 'toggleActivePejabat'])->name('pejabat.toggle-active');
        Route::delete('/pejabat/{pejabat}', [App\Http\Controllers\Admin\KontakController::class, 'destroyPejabat'])->name('pejabat.destroy');

        // Messages
        Route::get('/messages', [KontakMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{kontakMessage}', [KontakMessageController::class, 'show'])->name('messages.show');
        Route::patch('/messages/{kontakMessage}/toggle-read', [KontakMessageController::class, 'toggleRead'])->name('messages.toggle-read');
        Route::delete('/messages/{kontakMessage}', [KontakMessageController::class, 'destroy'])->name('messages.destroy');
    });

    // Pengajuan Surat routes
    Route::prefix('pengajuan-surat')->name('pengajuan-surat.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PengajuanSuratController::class, 'index'])->name('index');
        Route::get('/{pengajuanSurat}', [App\Http\Controllers\Admin\PengajuanSuratController::class, 'show'])->name('show');
        Route::patch('/{pengajuanSurat}/update-status', [App\Http\Controllers\Admin\PengajuanSuratController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{pengajuanSurat}', [App\Http\Controllers\Admin\PengajuanSuratController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-update-status', [App\Http\Controllers\Admin\PengajuanSuratController::class, 'bulkUpdateStatus'])->name('bulk-update-status');
        Route::get('/export', [App\Http\Controllers\Admin\PengajuanSuratController::class, 'export'])->name('export');
    });

    // Kategori Berita routes
    Route::resource('kategori-berita', App\Http\Controllers\Admin\KategoriBeritaController::class, [
        'parameters' => ['kategori-berita' => 'kategoriBerita']
    ]);
    Route::patch('kategori-berita/{kategoriBerita}/toggle-active', [App\Http\Controllers\Admin\KategoriBeritaController::class, 'toggleActive'])->name('kategori-berita.toggle-active');

    // Berita routes
    Route::resource('berita', App\Http\Controllers\Admin\BeritaController::class);
        Route::patch('kategori-berita/{kategoriBerita}/toggle-active', [
        App\Http\Controllers\Admin\KategoriBeritaController::class,
        'toggleActive'
    ])->name('kategori-berita.toggle-active');
    Route::patch('berita/{berita}/toggle-featured', [App\Http\Controllers\Admin\BeritaController::class, 'toggleFeatured'])->name('berita.toggle-featured');
    Route::patch('berita/{berita}/publish', [App\Http\Controllers\Admin\BeritaController::class, 'publish'])->name('berita.publish');
    Route::patch('berita/{berita}/unpublish', [App\Http\Controllers\Admin\BeritaController::class, 'unpublish'])->name('berita.unpublish');
    Route::patch('berita/{berita}/archive', [App\Http\Controllers\Admin\BeritaController::class, 'archive'])->name('berita.archive');
    Route::post('berita/bulk-action', [App\Http\Controllers\Admin\BeritaController::class, 'bulkAction'])->name('berita.bulk-action');

    // Posyandu routes
    Route::prefix('posyandu')->name('posyandu.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PosyanduController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\PosyanduController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\PosyanduController::class, 'store'])->name('store');
        Route::get('/{posyandu}/edit', [App\Http\Controllers\Admin\PosyanduController::class, 'edit'])->name('edit');
        Route::put('/{posyandu}', [App\Http\Controllers\Admin\PosyanduController::class, 'update'])->name('update');
        Route::delete('/{posyandu}', [App\Http\Controllers\Admin\PosyanduController::class, 'destroy'])->name('destroy');
        Route::patch('/{posyandu}/toggle-active', [App\Http\Controllers\Admin\PosyanduController::class, 'toggleActive'])->name('toggle-active');

        // Tenaga Kesehatan
        Route::get('/tenaga-kesehatan', [App\Http\Controllers\Admin\PosyanduController::class, 'tenagaKesehatan'])->name('tenaga-kesehatan');
        Route::get('/tenaga-kesehatan/create', [App\Http\Controllers\Admin\PosyanduController::class, 'createTenagaKesehatan'])->name('tenaga-kesehatan.create');
        Route::post('/tenaga-kesehatan', [App\Http\Controllers\Admin\PosyanduController::class, 'storeTenagaKesehatan'])->name('tenaga-kesehatan.store');
        Route::get('/tenaga-kesehatan/{tenagaKesehatan}/edit', [App\Http\Controllers\Admin\PosyanduController::class, 'editTenagaKesehatan'])->name('tenaga-kesehatan.edit');
        Route::put('/tenaga-kesehatan/{tenagaKesehatan}', [App\Http\Controllers\Admin\PosyanduController::class, 'updateTenagaKesehatan'])->name('tenaga-kesehatan.update');
        Route::delete('/tenaga-kesehatan/{tenagaKesehatan}', [App\Http\Controllers\Admin\PosyanduController::class, 'destroyTenagaKesehatan'])->name('tenaga-kesehatan.destroy');

        // Kegiatan
        Route::get('/kegiatan', [App\Http\Controllers\Admin\PosyanduController::class, 'kegiatan'])->name('kegiatan');
        Route::get('/kegiatan/create', [App\Http\Controllers\Admin\PosyanduController::class, 'createKegiatan'])->name('kegiatan.create');
        Route::post('/kegiatan', [App\Http\Controllers\Admin\PosyanduController::class, 'storeKegiatan'])->name('kegiatan.store');
        Route::get('/kegiatan/{kegiatan}/edit', [App\Http\Controllers\Admin\PosyanduController::class, 'editKegiatan'])->name('kegiatan.edit');
        Route::put('/kegiatan/{kegiatan}', [App\Http\Controllers\Admin\PosyanduController::class, 'updateKegiatan'])->name('kegiatan.update');
        Route::delete('/kegiatan/{kegiatan}', [App\Http\Controllers\Admin\PosyanduController::class, 'destroyKegiatan'])->name('kegiatan.destroy');

        // Layanan
        Route::get('/layanan', [App\Http\Controllers\Admin\PosyanduController::class, 'layanan'])->name('layanan');
        Route::get('/layanan/create', [App\Http\Controllers\Admin\PosyanduController::class, 'createLayanan'])->name('layanan.create');
        Route::post('/layanan', [App\Http\Controllers\Admin\PosyanduController::class, 'storeLayanan'])->name('layanan.store');
        Route::get('/layanan/{layanan}/edit', [App\Http\Controllers\Admin\PosyanduController::class, 'editLayanan'])->name('layanan.edit');
        Route::put('/layanan/{layanan}', [App\Http\Controllers\Admin\PosyanduController::class, 'updateLayanan'])->name('layanan.update');
        Route::delete('/layanan/{layanan}', [App\Http\Controllers\Admin\PosyanduController::class, 'destroyLayanan'])->name('layanan.destroy');
    });

    // Enhanced Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::patch('/password', [ProfileController::class, 'updatePassword'])->name('update-password');
        Route::delete('/avatar', [ProfileController::class, 'deleteAvatar'])->name('delete-avatar');
        Route::patch('/toggle-active', [ProfileController::class, 'toggleActive'])->name('toggle-active');
        Route::get('/download-data', [ProfileController::class, 'downloadData'])->name('download-data');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

});

// Auth Routes (Laravel Breeze)
require __DIR__.'/auth.php';
