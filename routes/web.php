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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/template', function(){
    return view('layouts.layout_master');
});


// Route::get("/mongolia/mapsAll", "mongolianMapsController@mongolianMapsAll");

Route::get("/mongolia/maps", "mongolianMapsController@mongolianMapsShow");
Route::get("/mongolian/sumd", "mongolianMapsController@mongolianSumd");
// Route::get("/get/name", "mongolianMapsController@getName");

Route::get("/mongolian/province", "mongolianMapsController@showProvince");
//Route::get("/mongolian/allMaps", "mongolianMapsController@allMapsShow");

Route::get("/mongolia/Arkhangai", "mongolianMapsController@arkhangai");
Route::get("/mongolia/Bayan-Ulgii", "mongolianMapsController@BayanUlgii");
Route::get("/mongolia/Bayankhongor", "mongolianMapsController@Bayankhongor");

Route::get("/mongolia/Bulgan", "mongolianMapsController@Bulgan");
Route::get("/mongolia/Darkhan-Uul", "mongolianMapsController@DarkhanUul");
Route::get("/mongolia/Dornod", "mongolianMapsController@Dornod");
Route::get("/mongolia/Dornogovi", "mongolianMapsController@Dornogovi");
Route::get("/mongolia/Dundgovi", "mongolianMapsController@Dundgovi");
Route::get("/mongolia/Govi-Altai", "mongolianMapsController@GoviAltai");
Route::get("/mongolia/Govisumber", "mongolianMapsController@Govisumber");
Route::get("/mongolia/Khentii", "mongolianMapsController@Khentii");
Route::get("/mongolia/Khovd", "mongolianMapsController@Khovd");
Route::get("/mongolia/Khuvsgul", "mongolianMapsController@Khuvsgul");
Route::get("/mongolia/Orkhon", "mongolianMapsController@Orkhon");
Route::get("/mongolia/Selenge", "mongolianMapsController@Selenge");
Route::get("/mongolia/Sukhbaatar", "mongolianMapsController@Sukhbaatar");
Route::get("/mongolia/Tuv", "mongolianMapsController@Tuv");
Route::get("/mongolia/Ulaanbaatar", "mongolianMapsController@Ulaanbaatar");
Route::get("/mongolia/Umnugovi", "mongolianMapsController@Umnugovi");
Route::get("/mongolia/Uvs", "mongolianMapsController@Uvs");
Route::get("/mongolia/Uvurkhangai", "mongolianMapsController@Uvurkhangai");
Route::get("/mongolia/Zavkhan", "mongolianMapsController@Zavkhan");

//Gol neriin buteegdhuun gargaj ireh
Route::get("/showSubController", "ShowSubController@showSubView");

// START gazriin zurgiin sumdiin ungu uurchluh heseg
Route::post("/get/sums/reserve/count", "SumAndFoodReserveController@getSumsReserveDays");
// END gazriin zurgiin sumdiin ungu uurchluh heseg


//FoodReserve begin
Route::get("/foodReserve", "FoodReserveController@foodReserveShow");
Route::post('foodReserve/insert', "FoodReserveController@store");
Route::post('foodReserve/delete', "FoodReserveController@delete");
//FoodReserve end

// forms start
Route::get("/sector/show", "SectorController@sectoreShow");
Route::post("/getSector", "SectorController@getSectorData");
Route::post("/sector/insert", "SectorController@store");
Route::post("/sector/edit", "SectorController@update");
Route::post("/sector/delete", "SectorController@delete");

Route::get("/province/show", "ProvinceController@provinceShow");
Route::post("/getProvince", "ProvinceController@getProvinceData");
Route::post("/province/insert", "ProvinceController@store");
Route::post("/province/edit", "ProvinceController@update");
Route::post("/province/delete", "ProvinceController@delete");
Route::post("/get/prov/by/bus", "ProvinceController@getProvsByBus");

Route::get("/sym/show", "SymController@symShow");
Route::post("/getSym", "SymController@getSymData");
Route::post("/sym/insert", "SymController@store");
Route::post("/sym/edit", "SymController@update");
Route::post("/sym/delete", "SymController@delete");
Route::post("/sym/get/by/provID", "SymController@getSymByProvinceID");
Route::post("/declare/danger/by/sum", "DangerController@declareDangerBySum");
Route::post("/declare/danger/by/province", "DangerController@declareDangerByProvs");
Route::post("/declare/danger/by/sector", "DangerController@declareDangerBySector");

Route::get("/org/show", "OrganizationController@orgShow");
Route::post("/getOrg", "OrganizationController@getOrgData");
Route::post("/org/insert", "OrganizationController@store");
Route::post("/org/edit", "OrganizationController@update");
Route::post("/org/delete", "OrganizationController@delete");

Route::get("/pop/show", "PopulationController@popShow");
Route::post("/getPop", "PopulationController@getPopData");
Route::post("/pop/insert", "PopulationController@store");
Route::post("/pop/edit", "PopulationController@update");
Route::post("/pop/delete", "PopulationController@delete");

//rightPanel begin
Route::get("/get/getAimagInfo", "Sides@getAimagInfo");
Route::get("/get/getSymInfo", "Sides@getSymInfo");

//rightPanel end

Route::get("/cattle/show", "CattleController@cattleShow");
Route::post("/getCattle", "CattleController@getCattleData");
Route::post("/cattle/insert", "CattleController@store");
Route::post("/cattle/edit", "CattleController@update");
Route::post("/cattle/delete", "CattleController@delete");

Route::get("/cattleQntt/show", "CattleQnttController@cattleQnttShow");
Route::post("/cattleQntt/insert", "CattleQnttController@store");
Route::post("/cattleQntt/delete", "CattleQnttController@delete");

Route::get("/axax/show", "AxaxController@axaxShow");
Route::post("/getAxax", "AxaxController@getAxaxData");
Route::post("/axax/insert", "AxaxController@store");
Route::post("/axax/edit", "AxaxController@update");
Route::post("/axax/delete", "AxaxController@delete");

Route::get("/foodProducts/show", "FoodProductsController@foodProductsShow");
Route::post("/getFoodProducts", "FoodProductsController@getFoodProductsData");
Route::post("/foodProducts/insert", "FoodProductsController@store");
Route::post("/foodProducts/edit", "FoodProductsController@update");
Route::post("/foodProducts/delete", "FoodProductsController@delete");

Route::get("/subProducts/show", "SubProductsController@subProductsShow");
Route::post("/getSubProducts", "SubProductsController@getSubProductsData");
Route::post("/subProducts/insert", "SubProductsController@store");
Route::post("/subProducts/edit", "SubProductsController@update");
Route::post("/subProducts/delete", "SubProductsController@delete");

Route::get("/status/show", "StatusController@statusShow");
Route::post("/getStatus", "StatusController@getStatusData");
Route::post("/status/insert", "StatusController@store");
Route::post("/status/edit", "StatusController@update");
Route::post("/status/delete", "StatusController@delete");

Route::get("/level/show", "LevelController@levelShow");
Route::post("/getLevel", "LevelController@getLevelData");
Route::post("/level/insert", "LevelController@store");
Route::post("/level/edit", "LevelController@update");
Route::post("/level/delete", "LevelController@delete");

// forms end

//Survey start
Route::get("/survey/list", "SurveyController@surveyListShow");

Route::get("/Survey/drinkingWater", "SrvyDrinkingWaterSourceController@drinkingWaterShow");
Route::post("/getDrinkingWater", "SrvyDrinkingWaterSourceController@getDrinkingWaterData");
Route::post("/drinkingWater/insert", "SrvyDrinkingWaterSourceController@store");
Route::post("/drinkingWater/edit", "SrvyDrinkingWaterSourceController@update");
Route::post("/drinkingWater/delete", "SrvyDrinkingWaterSourceController@delete");

Route::get("/Survey/foodTradeCenter", "SrvyFoodTradeCenterController@foodTradeCenterShow");
Route::post("/getFoodTradeCenter", "SrvyFoodTradeCenterController@getFoodTradeCenterData");
Route::post("/foodTradeCenter/insert", "SrvyFoodTradeCenterController@store");
Route::post("/foodTradeCenter/edit", "SrvyFoodTradeCenterController@update");
Route::post("/foodTradeCenter/delete", "SrvyFoodTradeCenterController@delete");
//Survey end


// START ADMIN HESEG
Route::get('/admins', 'AdminController@showAdmin');
Route::post('/show/admins', 'AdminController@getAdmins');
// END ADMIN HESEG



// START DADAA FILE manager
Route::get('/dada/file/manager/home/{type}', 'dadaaFileManagerController@dadaaFileManagerShow');
Route::post('/dada/file/manager/new/folder', 'dadaaFileManagerController@createFolder');
Route::get('/dada/file/manager/edit/folder', 'dadaaFileManagerController@editFolder');
Route::post('/dada/file/manager/delete/folder', 'dadaaFileManagerController@deleteFolder');
Route::post('/dada/file/manager/get/left/folder', 'dadaaFileManagerController@getLeftFolders');
Route::post('/dada/file/manager/get/right/folder', 'dadaaFileManagerController@getRightFolders');
Route::post('/dada/file/manager/upload/image', 'dadaaFileManagerController@resizeImagePost');
Route::post('/dada/file/manager/delete/image', 'dadaaFileManagerController@deleteFile');
// END DADAA FILE MANAGER


//test
Route::get("/test/get", "mongolianMapsController@getBaliarSda");
Route::get("/test/get/{id}", "PopulationController@getStandardPopByProvID");
Route::get("/test/map/sum/days", "SumAndFoodReserveController@getSumsReserveDays");
//test end



// NORM START
Route::get("/norm/show", 'NormController@show');
Route::post("/get/norms", 'NormController@getNormsByNormID');
Route::post("/norm/new", 'NormController@store');
Route::post("/norm/update", 'NormController@update');
Route::post("/norm/delete", 'NormController@destroy');
// NORM END



// ADMIN START
Route::get('/show/users', "UserController@showUsers");
Route::post('/get/users', "UserController@getUsers");
Route::post('/delete/users', "UserController@deleteUsers");
Route::post('/change/password/users', "UserController@changePassword");
// ADMIN END
