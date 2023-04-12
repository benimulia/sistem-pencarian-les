<?php



use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtamaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TempatKursusController;
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

Route::get('/', [UtamaController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/admin/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    // ================== KATEGORI ==================
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/admin/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/admin/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/admin/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('/admin/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('/admin/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        // ================== TEMPAT KURSUS ==================
        Route::get('/admin/tempatkursus', [TempatKursusController::class, 'index'])->name('tempatkursus.index');
        Route::get('/admin/tempatkursus/create', [TempatKursusController::class, 'create'])->name('tempatkursus.create');
        Route::post('/admin/tempatkursus/store', [TempatKursusController::class, 'store'])->name('tempatkursus.store');
        Route::get('/admin/tempatkursus/edit/{id}', [TempatKursusController::class, 'edit'])->name('tempatkursus.edit');
        Route::post('/admin/tempatkursus/update/{id}', [TempatKursusController::class, 'update'])->name('tempatkursus.update');
        Route::get('/admin/tempatkursus/delete/{id}', [TempatKursusController::class, 'destroy'])->name('tempatkursus.destroy');

});