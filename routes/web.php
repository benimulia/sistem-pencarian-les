<?php



use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriBesarController;
use App\Http\Controllers\KategoriUtamaController;
use App\Http\Controllers\TempatKursusController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;



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

// ================== UTAMA ==================
Route::get('/', [UtamaController::class, 'index'])->name('utama.index');

// kategori
Route::get('/kategori/{id}', [UtamaController::class, 'kategori'])->name('utama.kategori');

//search
Route::get('/search', [UtamaController::class, 'search'])->name('utama.search');

//kontak
Route::get('/kontak', function () {
    return view('utama.kontak');
})->name('utama.contact');

//tentang
Route::get('/tentang', function () {
    return view('utama.tentang');
})->name('utama.about');

//tempat kursus
Route::get('/tempatkursus/{id}', [UtamaController::class, 'showTempatKursus'])->name('utama.tempatkursus');



// ================== ADMIN ==================


Auth::routes();

Route::get('/admin/home', [HomeController::class, 'index'])->name('home')->middleware('adminconfirmation', 'auth');

Route::group(['middleware' => ['auth', 'adminconfirmation']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::post('/users/verify', [UserController::class, 'verify'])->name('users.verify');



    // ================== KATEGORI ==================
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/admin/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/admin/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/admin/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('/admin/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('/admin/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // ================== KATEGORI BESAR ==================
    Route::get('/admin/kategoribesar', [KategoriBesarController::class, 'index'])->name('kategoribesar.index');
    Route::get('/admin/kategoribesar/create', [KategoriBesarController::class, 'create'])->name('kategoribesar.create');
    Route::post('/admin/kategoribesar/store', [KategoriBesarController::class, 'store'])->name('kategoribesar.store');
    Route::get('/admin/kategoribesar/edit/{id}', [KategoriBesarController::class, 'edit'])->name('kategoribesar.edit');
    Route::post('/admin/kategoribesar/update/{id}', [KategoriBesarController::class, 'update'])->name('kategoribesar.update');
    Route::get('/admin/kategoribesar/delete/{id}', [KategoriBesarController::class, 'destroy'])->name('kategoribesar.destroy');

    // ================== KATEGORI UTAMA ==================
    Route::get('/admin/kategoriutama', [KategoriUtamaController::class, 'index'])->name('kategoriutama.index');
    Route::get('/admin/kategoriutama/create', [KategoriUtamaController::class, 'create'])->name('kategoriutama.create');
    Route::post('/admin/kategoriutama/store', [KategoriUtamaController::class, 'store'])->name('kategoriutama.store');
    Route::get('/admin/kategoriutama/edit/{id}', [KategoriUtamaController::class, 'edit'])->name('kategoriutama.edit');
    Route::post('/admin/kategoriutama/update/{id}', [KategoriUtamaController::class, 'update'])->name('kategoriutama.update');
    Route::get('/admin/kategoriutama/delete/{id}', [KategoriUtamaController::class, 'destroy'])->name('kategoriutama.destroy');

    // ================== TEMPAT KURSUS ==================
    Route::get('/admin/tempatkursus', [TempatKursusController::class, 'index'])->name('tempatkursus.index');
    Route::get('/admin/tempatkursus/create', [TempatKursusController::class, 'create'])->name('tempatkursus.create');
    Route::post('/admin/tempatkursus/store', [TempatKursusController::class, 'store'])->name('tempatkursus.store');
    Route::get('/admin/tempatkursus/edit/{id}', [TempatKursusController::class, 'edit'])->name('tempatkursus.edit');
    Route::post('/admin/tempatkursus/update/{id}', [TempatKursusController::class, 'update'])->name('tempatkursus.update');
    Route::get('/admin/tempatkursus/delete/{id}', [TempatKursusController::class, 'destroy'])->name('tempatkursus.destroy');

    // ================== PROGRAM ==================
    Route::get('/admin/program', [ProgramController::class, 'index'])->name('program.index');
    Route::get('/admin/program/create', [ProgramController::class, 'create'])->name('program.create');
    Route::post('/admin/program/store', [ProgramController::class, 'store'])->name('program.store');
    Route::get('/admin/program/edit/{id}', [ProgramController::class, 'edit'])->name('program.edit');
    Route::post('/admin/program/update/{id}', [ProgramController::class, 'update'])->name('program.update');
    Route::get('/admin/program/delete/{id}', [ProgramController::class, 'destroy'])->name('program.destroy');
});
