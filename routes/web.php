<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');
Route::get('/index', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::get('/classe', function () {
     return view('classe');
});

Route::get('/evolucao', function () {
    return view('evolucao');
});

Route::get('/rank', function () {
    return view('rank');
});

Route::get('/screen', function () {
    return view('screen');
});

Route::get('/contact', function () {
    return view('contact');
});

Auth::routes();


//Rotas autenticadas
Route::middleware(['web', 'auth'])->group(function () 
{
    //home panel
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

   
    Route::get('/nStorage', [App\Http\Controllers\StorageController::class, 'getStorage'])->name('nStorage');
    Route::post('/setSale', [App\Http\Controllers\StorageController::class, 'setSale'])->name('setSale');
    //Rotas Leilão
    Route::get('/saleArmia', [App\Http\Controllers\SaleCityController::class, 'indexArmia'])->name('saleArmia');
    Route::get('/saleAzran', [App\Http\Controllers\SaleCityController::class, 'indexAzran'])->name('saleAzran');
    Route::get('/saleErion', [App\Http\Controllers\SaleCityController::class, 'indexErion'])->name('saleErion');
    Route::get('/saleNipplehein', [App\Http\Controllers\SaleCityController::class, 'indexNipplehein'])->name('saleNipplehein');
    Route::get('/saleNoatum', [App\Http\Controllers\SaleCityController::class, 'indexNoatum'])->name('saleNoatum');
    Route::post('/cSale', [App\Http\Controllers\SaleCityController::class, 'cancel'])->name('cSale');
    Route::post('/bSale', [App\Http\Controllers\SaleCityController::class, 'buy'])->name('bSale');
    //Rotas personagem
    Route::get('/listCharacter', [App\Http\Controllers\CharacterController::class, 'listCharacter'])->name('listCharacter');
    Route::get('/rCharacter', [App\Http\Controllers\CharacterController::class, 'index'])->name('rCharacter');
    //Rotas Premium Neil
    Route::get('/neil', [App\Http\Controllers\NeilController::class, 'index'])->name('neil');
    Route::post('/buyNeil', [App\Http\Controllers\NeilController::class, 'buyNeil'])->name('buyNeil');
    //Rotas Guild
    Route::get('/guild', [App\Http\Controllers\GuildController::class, 'index'])->name('guild');
    Route::get('/hGuild', [App\Http\Controllers\GuildController::class, 'hGuild'])->name('hGuild');
    Route::post('/ghDonate', [App\Http\Controllers\GuildController::class, 'Donate'])->name('ghDonate');
    Route::post('/ghInOut', [App\Http\Controllers\GuildController::class, 'memberInOut'])->name('ghInOut');
    Route::post('/gRecruit', [App\Http\Controllers\GuildController::class, 'Recruit'])->name('gRecruit');
    Route::post('/ghTake', [App\Http\Controllers\GuildController::class, 'Take'])->name('ghTake');
    Route::post('/ghImpost', [App\Http\Controllers\GuildController::class, 'Impost'])->name('ghImpost');
    Route::post('/ghTax', [App\Http\Controllers\GuildController::class, 'Tax'])->name('ghTax');
    Route::post('/guildMark', [App\Http\Controllers\GuildController::class, 'GuildMark'])->name('guildMark');


});

//Rotas autenticas Admin
Route::middleware(['web', 'auth', 'auth.admin.user'])->group(function () 
{
    //noticia
    Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
    Route::post('/cNews', [App\Http\Controllers\NewsController::class, 'create'])->name('cNews');
    Route::post('/uNews', [App\Http\Controllers\NewsController::class, 'update'])->name('uNews');
    Route::post('/dNews', [App\Http\Controllers\NewsController::class, 'destroy'])->name('dNews');
    //Premium Neil
    Route::get('/aNeil', [App\Http\Controllers\NeilController::class, 'aIndex'])->name('aNeil');
    Route::post('/cNeil', [App\Http\Controllers\NeilController::class, 'create'])->name('cNeil');
    Route::post('/uNeil', [App\Http\Controllers\NeilController::class, 'update'])->name('uNeil');
    Route::post('/dNeil', [App\Http\Controllers\NeilController::class, 'destroy'])->name('dNeil');
});


//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
