<?php
use Illuminate\Support\Facades\Route;
use Modules\Qrcode\Http\Controllers\QrController;
use Modules\Qrcode\Http\Controllers\ShotlinkController;
use Modules\Qrcode\Http\Controllers\RedirectController;
use Modules\Qrcode\Http\Controllers\LocaleController;
use Modules\Qrcode\Http\Controllers\LinkController;
use Modules\Qrcode\Http\Controllers\StatController;
use Modules\Qrcode\Http\Controllers\QAController;
use Modules\Qrcode\Http\Controllers\CampaignController;
use Modules\Qrcode\Http\Controllers\CampaignOptionController;
use Modules\Qrcode\Http\Controllers\SettingController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your aaplication. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::middleware(['web'])->group(function () {

Route::group(['middleware' => ['web', 'auth'],'namespace' => 'Modules\Qrcode\Http\Controllers'], function()
{
Route::prefix('/stats/{id}')->group(function () {

    Route::get('/overview', [StatController::class,'index'])->name('stats.overview');
    Route::get('/referrers', [StatController::class,'referrers'])->name('stats.referrers');
    Route::get('/countries', [StatController::class,'countries'])->name('stats.countries');
    Route::get('/cities', [LinkController::class,'cities'])->name('stats.cities');
    Route::get('/languages', [StatController::class,'languages'])->name('stats.languages');
    Route::get('/browsers', [StatController::class,'browsers'])->name('stats.browsers');
    Route::get('/platforms', [StatController::class,'platforms'])->name('stats.platforms');
    Route::get('/devices', [StatController::class,'devices'])->name('stats.devices');


    Route::prefix('/export')->group(function () {
        Route::get('/referrers', 'StatController@exportReferrers')->name('stats.export.referrers');
        Route::get('/countries', 'StatController@exportCountries')->name('stats.export.countries');
        Route::get('/cities', 'StatController@exportCities')->name('stats.export.cities');
        Route::get('/languages', 'StatController@exportLanguages')->name('stats.export.languages');
        Route::get('/browsers', 'StatController@exportBrowsers')->name('stats.export.browsers');
        Route::get('/platforms', 'StatController@exportPlatforms')->name('stats.export.platforms');
        Route::get('/devices', 'StatController@exportDevices')->name('stats.export.devices');
    });

    Route::post('/password', 'StatController@validatePassword')->name('stats.password');
});





    // Route::group(['middleware' => 'auth'], function () {
//Question answer
Route::get('/qa', [QAController::class,'index'])->name('qa');
Route::get('qa/create', [QAController::class,'create'])->name('create');
Route::post('qa/store', [QAController::class,'store'])->name('store');
Route::get('qa/edit/{id}', [QAController::class,'edit'])->name('edit');
Route::post('qa/update', [QAController::class,'update'])->name('update');
Route::post('qa/destroy', [QAController::class,'destroy'])->name('destroy');
Route::post('changeWhatsappStatus', [QAController::class,'changeWhatsappStatus'])->name('changeWhatsappStatus');
Route::post('/qr', [CampaignController::class,'qrmodal'])->name('modal');



// Campaign Route
Route::resource('/campaign',CampaignController::class);
Route::post('/month-show',[CampaignController::class,'MonthShow'])->name('month-show');

Route::get('/campaign/{id}/history',[CampaignController::class,'campaign_history'])->name('campaign-history');

Route::post('/campaignHistoryDelete',[CampaignController::class,'campaign_history_delete'])->name('campaign-history-delete');

// campation option
Route::resource('/campaign-option',CampaignOptionController::class);

Route::post('/parent-change-value',[CampaignOptionController::class,'parentValue'])->name('parent-change-value');

Route::post('parent-change-value/remove', [CampaignOptionController::class,'addmoredelete'])->name('remove');
Route::post('campaign-option-status', [CampaignOptionController::class,'CampaignStatus'])->name('campaign-option-status');




// Link routes
Route::get('/links', [LinkController::class,'index'])->name('links');
Route::get('/links/{id}/edit', [LinkController::class,'edit'])->middleware('verified')->name('links.edit');
Route::get('/links/export', [LinkController::class,'export'])->middleware('verified')->name('links.export');
Route::get('/links/new', [LinkController::class,'store'])->name('links.new');
Route::get('/links/{id}/edit', [LinkController::class,'update']);
// Route::get('/links/{id}/destroy', [LinkController::class,'destroy']);
Route::post('/links/delete', [LinkController::class,'destroy'])->name('destroy');



Route::get('qrcode', [QrController::class,'index'])->name('Qr.code');
Route::post('generate-qr',[QrController::class,'Generate'])->name('generate-qr');


Route::get('short-link', [ShotlinkController::class,'shortlink'])->name('short-link');
Route::post('/shorten', [ShotlinkController::class,'createLink'])->name('guest'); 

//whatsapp setting route
Route::resource('/setting',SettingController::class);
Route::post('/setting/delete',[SettingController::class,'delete'])->name('delete');
Route::post('/setting/status',[SettingController::class,'changeSettingStatus'])->name('changeSettingStatus');




// Route::get('/setting', [SettingController::class,'index'])->name('setting');
// Route::get('/createSetting', [SettingController::class,'index'])->name('createSetting');


Route::get('/locale', [LocaleController::class,'updateLocale'])->name('locale');

Route::get('/{id}/+', [RedirectController::class,'index'])->name('link.preview');
Route::get('/{id}', [RedirectController::class,'index'])->name('link.redirect');
Route::get('/{id}/password', [RedirectController::class,'validatePassword']);
Route::get('/{id}/consent', [RedirectController::class,'validateConsent']);

Route::get('/route-cache', function() {

     Artisan::call('config:cache');
     Artisan::call('cache:clear');
     Artisan::call('route:clear');
    return 'Routes cache cleared';
});



// }
});