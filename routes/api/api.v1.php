<?php

use Illuminate\Support\Facades\Route;

// Country routes...
Route::get('/{locale}/countries', 'CountryController@index');
Route::get('/{locale}/countries/{country}', 'CountryController@show');
Route::get('/{locale}/countries/{country}/provinces', 'CountryController@provinces');
Route::get('/{locale}/countries/{country}/states', 'CountryController@states');
Route::get('/{locale}/countries/{country}/regions', 'CountryController@regions');
Route::get('/{locale}/countries/{country}/local_government_areas', 'CountryController@localGovernmentAreas');
Route::get('/{locale}/countries/{country}/cities', 'CountryController@cities');
Route::get('/{locale}/countries/{country}/villages', 'CountryController@villages');


// Region routes...
Route::get('/{locale}/regions', 'RegionController@index');
Route::get('/{locale}/regions/{region}', 'RegionController@show');
Route::get('/{locale}/regions/{region}/countries', 'RegionController@countries');
Route::get('/{locale}/regions/{region}/provinces', 'RegionController@provinces');
Route::get('/{locale}/regions/{region}/states', 'RegionController@states');
Route::get('/{locale}/regions/{region}/local_government_areas', 'RegionController@localGovernmentAreas');
Route::get('/{locale}/regions/{region}/cities', 'RegionController@cities');
Route::get('/{locale}/regions/{region}/villages', 'RegionController@villages');


// Region routes...
Route::get('/{locale}/provinces', 'ProvinceController@index');
Route::get('/{locale}/provinces/{province}', 'ProvinceController@show');
Route::get('/{locale}/provinces/{province}/regions', 'ProvinceController@regions');
Route::get('/{locale}/provinces/{province}/countries', 'ProvinceController@countries');
Route::get('/{locale}/provinces/{province}/local_government_areas', 'ProvinceController@localGovernmentAreas');
Route::get('/{locale}/provinces/{province}/cities', 'ProvinceController@cities');
Route::get('/{locale}/provinces/{province}/villages', 'ProvinceController@villages');


// State routes...
Route::get('/{locale}/states', 'ProvinceController@stateIndex');
Route::get('/{locale}/states/{state}', 'ProvinceController@states');
Route::get('/{locale}/states/{state}/regions', 'ProvinceController@regions');
Route::get('/{locale}/states/{state}/countries', 'ProvinceController@countries');
Route::get('/{locale}/states/{state}/local_government_areas', 'ProvinceController@localGovernmentAreas');
Route::get('/{locale}/states/{state}/cities', 'ProvinceController@cities');
Route::get('/{locale}/states/{state}/villages', 'ProvinceController@villages');


// Local government area routes...
Route::get('/{locale}/local_government_areas', 'LocalGovernmentAreaController@index');
Route::get('/{locale}/local_government_areas/{local_government_area}', 'LocalGovernmentAreaController@show');
Route::get('/{locale}/local_government_areas/{local_government_area}/regions', 'LocalGovernmentAreaController@regions');
Route::get('/{locale}/local_government_areas/{local_government_area}/countries', 'LocalGovernmentAreaController@countries');
Route::get('/{locale}/local_government_areas/{local_government_area}/provinces', 'LocalGovernmentAreaController@provinces');
Route::get('/{locale}/local_government_areas/{local_government_area}/states', 'LocalGovernmentAreaController@states');
Route::get('/{locale}/local_government_areas/{local_government_area}/cities', 'LocalGovernmentAreaController@cities');
Route::get('/{locale}/local_government_areas/{local_government_area}/villages', 'LocalGovernmentAreaController@villages');


// City routes...
Route::get('/{locale}/cities', 'CityController@index');
Route::get('/{locale}/cities/{city}', 'CityController@show');
Route::get('/{locale}/cities/{city}/regions', 'CityController@regions');
Route::get('/{locale}/cities/{city}/countries', 'CityController@countries');
Route::get('/{locale}/cities/{city}/provinces', 'CityController@provinces');
Route::get('/{locale}/cities/{city}/states', 'CityController@states');
Route::get('/{locale}/cities/{city}/local_government_areas', 'CityController@localGovernmentAreas');
Route::get('/{locale}/cities/{city}/villages', 'CityController@villages');


// Village routes...
Route::get('/{locale}/villages', 'VillageController@index');
Route::get('/{locale}/villages/{village}', 'VillageController@show');
Route::get('/{locale}/villages/{village}/regions', 'VillageController@regions');
Route::get('/{locale}/villages/{village}/countries', 'VillageController@countries');
Route::get('/{locale}/villages/{village}/provinces', 'VillageController@provinces');
Route::get('/{locale}/villages/{village}/states', 'VillageController@states');
Route::get('/{locale}/villages/{village}/cities', 'VillageController@cities');
Route::get('/{locale}/villages/{village}/local_government_areas', 'VillageController@localGovernmentAreas');
